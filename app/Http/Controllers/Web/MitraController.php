<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\MitraRegistration;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $existing = MitraRegistration::where('user_id', auth()->id())
            ->latest()->first();

        $businessTypes   = MitraRegistration::getBusinessTypes();
        $membershipTiers = MitraRegistration::getMembershipTiers();

        return view('customer.services.daftar_mitra', compact(
            'existing', 'businessTypes', 'membershipTiers'
        ));
    }

    public function store(Request $request)
    {
        // Cek sudah pernah daftar
        $existing = MitraRegistration::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existing) {
            return back()->with('error', 'Anda sudah memiliki pendaftaran mitra yang aktif.');
        }

        $request->validate([
            'business_name'        => 'required|string|max:150',
            'owner_name'           => 'required|string|max:100',
            'phone'                => 'required|string|max:20',
            'email'                => 'required|email|max:100',
            'address'              => 'required|string|min:10',
            'business_type'        => 'required|in:' . implode(',', array_keys(MitraRegistration::getBusinessTypes())),
            'business_description' => 'nullable|string|max:500',
            'membership_tier'      => 'required|in:' . implode(',', array_keys(MitraRegistration::getMembershipTiers())),
            'ktp_photo'            => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'business_photo'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'user_id'              => auth()->id(),
            'business_name'        => $request->business_name,
            'owner_name'           => $request->owner_name,
            'phone'                => $request->phone,
            'email'                => $request->email,
            'address'              => $request->address,
            'business_type'        => $request->business_type,
            'business_description' => $request->business_description,
            'membership_tier'      => $request->membership_tier,
            'status'               => 'pending',
        ];

        if ($request->hasFile('ktp_photo')) {
            $data['ktp_photo'] = $request->file('ktp_photo')->store('mitra/ktp', 'public');
        }
        if ($request->hasFile('business_photo')) {
            $data['business_photo'] = $request->file('business_photo')->store('mitra/business', 'public');
        }

        MitraRegistration::create($data);

        return redirect()
            ->route('customer.mitra.status')
            ->with('success', 'Pendaftaran mitra berhasil dikirim! Admin akan memverifikasi dalam 1–2 hari kerja.');
    }

    public function status()
    {
        $registration = MitraRegistration::where('user_id', auth()->id())
            ->latest()->first();

        $membershipTiers = MitraRegistration::getMembershipTiers();

        return view('customer.services.mitra_status', compact('registration', 'membershipTiers'));
    }
}
