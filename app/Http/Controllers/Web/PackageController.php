<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PackageDelivery;
use App\Models\Tariff;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tariffMotor = Tariff::getActive('paket_motor');
        $tariffMobil = Tariff::getActive('paket_mobil');
        $packageTypes = PackageDelivery::getPackageTypes();

        $myDeliveries = PackageDelivery::where('user_id', auth()->id())
            ->latest()
            ->limit(5)
            ->get();

        return view('customer.services.paket', compact(
            'tariffMotor', 'tariffMobil', 'packageTypes', 'myDeliveries'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sender_name'         => 'required|string|max:100',
            'sender_phone'        => 'required|string|max:20',
            'pickup_address'      => 'required|string|min:5',
            'recipient_name'      => 'required|string|max:100',
            'recipient_phone'     => 'required|string|max:20',
            'destination_address' => 'required|string|min:5',
            'package_type'        => 'required|in:dokumen,paket_kecil,paket_sedang,paket_besar',
            'package_description' => 'nullable|string|max:300',
            'weight'              => 'nullable|numeric|min:0.1',
            'special_notes'       => 'nullable|string|max:300',
            'fragile'             => 'nullable|boolean',
            'distance'            => 'required|numeric|min:0.5',
            'vehicle_type'        => 'required|in:motor,mobil',
            'payment_method'      => 'required|in:cash,transfer,ewallet',
        ]);

        $serviceType = 'paket_' . $request->vehicle_type;
        $tariff      = Tariff::getActive($serviceType);
        $price       = $tariff
            ? $tariff->calculate((float) $request->distance)
            : PackageDelivery::calculatePrice($request->distance, $request->vehicle_type);

        $delivery = PackageDelivery::create([
            'user_id'             => auth()->id(),
            'delivery_number'     => PackageDelivery::generateDeliveryNumber(),
            'sender_name'         => $request->sender_name,
            'sender_phone'        => $request->sender_phone,
            'pickup_address'      => $request->pickup_address,
            'recipient_name'      => $request->recipient_name,
            'recipient_phone'     => $request->recipient_phone,
            'destination_address' => $request->destination_address,
            'package_type'        => $request->package_type,
            'package_description' => $request->package_description,
            'weight'              => $request->weight,
            'special_notes'       => $request->special_notes,
            'fragile'             => $request->boolean('fragile'),
            'distance'            => $request->distance,
            'price'               => $price,
            'payment_method'      => $request->payment_method,
            'status'              => 'pending',
        ]);

        return redirect()
            ->route('customer.paket.show', $delivery)
            ->with('success', 'Pengiriman paket berhasil dibuat! No: ' . $delivery->delivery_number);
    }

    public function show(PackageDelivery $delivery)
    {
        abort_if($delivery->user_id !== auth()->id(), 403);

        return view('customer.services.paket_detail', compact('delivery'));
    }
}
