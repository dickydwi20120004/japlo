<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show checkout page
     */
    public function checkout(Request $request)
    {
        // Get cart data from session or localStorage
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong');
        }

        // Calculate totals
        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
        
        $shipping = 10000; // Fixed shipping
        $tax = $subtotal * 0.1; // 10% tax
        $total = $subtotal + $shipping + $tax;

        // Order ID
        $orderId = 'ORDER-' . time() . '-' . auth()->id();

        return view('payment.checkout', compact('cart', 'subtotal', 'shipping', 'tax', 'total', 'orderId'));
    }

    /**
     * Process payment
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'orderId' => 'required|string',
            'paymentMethod' => 'required|in:credit_card,bank_transfer,ewallet,cod',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'postalCode' => 'required|string',
        ]);

        try {
            // Create Order in database
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => Order::generateOrderNumber(),
                'pickup_address' => 'JAPLO Distribution Center',
                'pickup_latitude' => -6.1751,
                'pickup_longitude' => 106.8650,
                'destination_address' => $request->address,
                'destination_latitude' => -6.1751,
                'destination_longitude' => 106.8650,
                'distance' => rand(2, 15),
                'estimated_time' => rand(30, 120),
                'price' => 0, // Will be calculated
                'status' => 'pending',
                'payment_method' => $request->paymentMethod,
                'payment_status' => 'pending',
                'customer_notes' => $request->input('notes', ''),
            ]);

            // Get cart from session (in real app, would be from request)
            $cart = Session::get('cart', []);

            // Add order items
            $subtotal = 0;
            foreach ($cart as $item) {
                $itemSubtotal = $item['price'] * $item['quantity'];
                $subtotal += $itemSubtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'item_name' => $item['name'],
                    'item_type' => 'food', // atau product, health, etc
                    'item_id' => $item['id'] ?? null,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $itemSubtotal,
                ]);
            }

            // Calculate totals
            $shipping = 10000;
            $tax = $subtotal * 0.1;
            $total = $subtotal + $shipping + $tax;

            // Update order price
            $order->update(['price' => $total]);

            // Create Payment record
            $payment = Payment::create([
                'order_id' => $order->id,
                'user_id' => auth()->id(),
                'transaction_id' => Payment::generateTransactionId(),
                'payment_method' => $request->paymentMethod,
                'payment_status' => 'pending',
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'tax' => $tax,
                'total_amount' => $total,
                'customer_name' => $request->firstName . ' ' . $request->lastName,
                'customer_email' => $request->email,
                'customer_phone' => $request->phone,
                'shipping_address' => $request->address,
                'city' => $request->city,
                'province' => $request->province,
                'postal_code' => $request->postalCode,
            ]);

            // Simulate payment processing
            $success = $this->simulatePaymentProcess($request->paymentMethod);

            if ($success) {
                // Mark payment as success
                $payment->markAsSuccess();
                $order->update(['status' => 'confirmed']);

                // Clear cart
                Session::forget('cart');

                return redirect()->route('payment.success', ['orderId' => $order->order_number])
                    ->with('success', 'Pembayaran berhasil diproses!');
            } else {
                // Mark payment as failed
                $payment->markAsFailed();

                return redirect()->route('payment.failed', ['orderId' => $order->order_number])
                    ->with('error', 'Pembayaran gagal, silakan coba lagi!');
            }

        } catch (\Exception $e) {
            \Log::error('Payment Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Payment success page
     */
    public function paymentSuccess($orderId)
    {
        $order = Order::where('order_number', $orderId)
            ->where('user_id', auth()->id())
            ->with('items', 'payment')
            ->firstOrFail();

        $payment = $order->payment;

        return view('payment.success', compact('order', 'payment'));
    }

    /**
     * Payment failed page
     */
    public function paymentFailed($orderId)
    {
        $order = Order::where('order_number', $orderId)
            ->where('user_id', auth()->id())
            ->with('payment')
            ->firstOrFail();

        $payment = $order->payment;

        return view('payment.failed', compact('order', 'payment'));
    }

    /**
     * Simulate payment processing
     */
    private function simulatePaymentProcess($paymentMethod)
    {
        // Simulate processing delay
        usleep(500000); // 0.5 second

        // 95% success rate for demo
        return rand(1, 100) <= 95;
    }
}
