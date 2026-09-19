<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ExpoRegistration;
use App\Models\MitraRegistration;
use Illuminate\Http\Request;

class ExpoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $existing = ExpoRegistration::where('user_id', auth()->id())
            ->latest()->first();

        $businessTypes = MitraRegistration::getBusinessTypes();

        $expoInfo = [
            'name'     => 'Mini Expo JAPLO 2026',
            'location' => 'Tanjung Uban, Bintan',
            'date'     => 'November 2026',
            'booths'   => [
                ['size' => 2, 'price' => 300000,  'label' => '2m² – Stand Kecil'],
                ['size' => 4, 'price' => 500000,  'label' => '4m² – Stand Sedang'],
                ['size' => 6, 'price' => 750000,  'label' => '6m² – Stand Besar'],
                ['size' => 9, 'price' => 1000000, 'label' => '9m² – Stand Premium'],
            ],
        ];

        return view('customer.services.daftar_expo', compact(
            'existing', 'businessTypes', 'expoInfo'
        ));
    }

    public function store(Request $request)
    {
        $existing = ExpoRegistration::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'approved', 'paid'])
            ->first();

        if ($existing) {
            return back()->with('error', 'Anda sudah memiliki pendaftaran expo yang aktif.');
        }

        $request->validate([
            'expo_name'           => 'required|string|max:150',
            'business_name'       => 'required|string|max:150',
            'owner_name'          => 'required|string|max:100',
            'phone'               => 'required|string|max:20',
            'email'               => 'required|email|max:100',
            'business_type'       => 'required|string',
            'product_description' => 'required|string|min:20|max:500',
            'booth_size'          => 'required|integer|in:2,4,6,9',
            'special_request'     => 'nullable|string|max:300',
            'ktp_photo'           => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'business_photo'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $boothPrices = [2 => 300000, 4 => 500000, 6 => 750000, 9 => 1000000];
        $boothPrice  = $boothPrices[$request->booth_size] ?? 300000;

        $data = [
            'user_id'             => auth()->id(),
            'expo_name'           => $request->expo_name,
            'business_name'       => $request->business_name,
            'owner_name'          => $request->owner_name,
            'phone'               => $request->phone,
            'email'               => $request->email,
            'business_type'       => $request->business_type,
            'product_description' => $request->product_description,
            'booth_size'          => $request->booth_size,
            'booth_price'         => $boothPrice,
            'special_request'     => $request->special_request,
            'status'              => 'pending',
        ];

        if ($request->hasFile('ktp_photo')) {
            $data['ktp_photo'] = $request->file('ktp_photo')->store('expo/ktp', 'public');
        }
        if ($request->hasFile('business_photo')) {
            $data['business_photo'] = $request->file('business_photo')->store('expo/business', 'public');
        }

        ExpoRegistration::create($data);

        return redirect()
            ->route('customer.expo.status')
            ->with('success', 'Pendaftaran expo berhasil dikirim! Admin akan memverifikasi segera.');
    }

    public function status()
    {
        $registration = ExpoRegistration::where('user_id', auth()->id())
            ->latest()->first();

        return view('customer.services.expo_status', compact('registration'));
    }
}
