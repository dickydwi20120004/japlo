<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\MarketOrder;
use App\Models\MarketOrderItem;
use App\Models\Tariff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tariff = Tariff::getActive('belanja_pasar');

        $myOrders = MarketOrder::where('user_id', auth()->id())
            ->with('items')
            ->latest()
            ->limit(5)
            ->get();

        $markets = [
            ['name' => 'Pasar Tanjung Uban',    'area' => 'Bintan Utara'],
            ['name' => 'Pasar Seri Kuala Lobam', 'area' => 'Seri Kuala Lobam'],
            ['name' => 'Pasar Teluk Sebong',     'area' => 'Teluk Sebong'],
            ['name' => 'Pasar Kijang',           'area' => 'Bintan Timur'],
        ];

        return view('customer.services.pasar', compact('tariff', 'myOrders', 'markets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'market_name'       => 'required|string|max:100',
            'delivery_address'  => 'required|string|min:5',
            'notes'             => 'nullable|string|max:500',
            'distance'          => 'required|numeric|min:0.5',
            'payment_method'    => 'required|in:cash,transfer,ewallet',
            'items'             => 'required|array|min:1',
            'items.*.name'      => 'required|string|max:100',
            'items.*.quantity'  => 'required|integer|min:1',
            'items.*.unit'      => 'required|string|max:20',
            'items.*.estimated_price' => 'nullable|numeric|min:0',
            'items.*.description'     => 'nullable|string|max:200',
        ]);

        DB::transaction(function () use ($request, &$order) {
            $tariff      = Tariff::getActive('belanja_pasar');
            $deliveryFee = $tariff
                ? $tariff->calculate((float) $request->distance)
                : (8000 + ($request->distance * 3000));
            $serviceFee  = 2000;

            $estimatedTotal = collect($request->items)
                ->sum(fn($i) => ($i['estimated_price'] ?? 0) * $i['quantity']);

            $order = MarketOrder::create([
                'user_id'          => auth()->id(),
                'order_number'     => MarketOrder::generateOrderNumber(),
                'market_name'      => $request->market_name,
                'delivery_address' => $request->delivery_address,
                'notes'            => $request->notes,
                'estimated_price'  => $estimatedTotal,
                'delivery_fee'     => $deliveryFee,
                'service_fee'      => $serviceFee,
                'total'            => $estimatedTotal + $deliveryFee + $serviceFee,
                'payment_method'   => $request->payment_method,
                'status'           => 'pending',
            ]);

            foreach ($request->items as $item) {
                MarketOrderItem::create([
                    'market_order_id' => $order->id,
                    'item_name'       => $item['name'],
                    'description'     => $item['description'] ?? null,
                    'quantity'        => $item['quantity'],
                    'unit'            => $item['unit'],
                    'estimated_price' => $item['estimated_price'] ?? null,
                ]);
            }
        });

        return redirect()
            ->route('customer.pasar.show', $order)
            ->with('success', 'Pesanan belanja pasar berhasil dibuat! No: ' . $order->order_number);
    }

    public function show(MarketOrder $marketOrder)
    {
        abort_if($marketOrder->user_id !== auth()->id(), 403);
        $marketOrder->load('items', 'driver');

        return view('customer.services.pasar_detail', compact('marketOrder'));
    }
}
