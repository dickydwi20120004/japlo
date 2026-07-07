<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,driver',
        ];

        $messages = [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'phone.required' => 'Nomor telepon harus diisi',
            'phone.unique' => 'Nomor telepon sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'role.required' => 'Pilih role (Penumpang/Driver)',
        ];

        // Add driver-specific validation
        if ($request->role === 'driver') {
            $rules['vehicle_type'] = 'required|in:motor,mobil';
            $rules['vehicle_brand'] = 'required|string|max:100';
            $rules['license_plate'] = 'required|string|max:20';
            $rules['license_number'] = 'required|string|max:50';
            $rules['address'] = 'nullable|string|max:500';

            $messages['vehicle_type.required'] = 'Jenis kendaraan harus dipilih';
            $messages['vehicle_brand.required'] = 'Merk kendaraan harus diisi';
            $messages['license_plate.required'] = 'Nomor plat harus diisi';
            $messages['license_number.required'] = 'Nomor SIM harus diisi';
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Create driver profile if role is driver
        if ($request->role === 'driver') {
            $user->driver()->create([
                'vehicle_type' => $request->vehicle_type,
                'vehicle_brand' => $request->vehicle_brand,
                'license_plate' => $request->license_plate,
                'license_number' => $request->license_number,
                'address' => $request->address,
                'is_available' => false, // Default not available
                'rating' => 0,
                'total_rides' => 0,
                'total_earnings' => 0,
            ]);
        }

        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('success', 'Registrasi berhasil! Selamat datang di JAPLO.');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'))
                ->with('success', 'Login berhasil!');
        }

        return redirect()->back()
            ->with('error', 'Email atau password salah!')
            ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Logout berhasil!');
    }
}
