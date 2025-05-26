<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\StaffMitra;
use App\Models\StaffPerusahaan;
use App\Models\KaryawanPerusahaan;

class AuthController extends Controller
{
    public function viewLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;

        // Coba login sebagai StaffMitra
        $staffMitra = StaffMitra::where('email', $email)->first();
        if ($staffMitra && Hash::check($password, $staffMitra->password)) {
            Auth::guard('web')->login($staffMitra);

            return redirect()->route('dashboard.staff');
        }

        // Coba login sebagai StaffPerusahaan
        $staffPerusahaan = StaffPerusahaan::where('email', $email)->first();
        if ($staffPerusahaan && Hash::check($password, $staffPerusahaan->password)) {
            Auth::guard('web')->login($staffPerusahaan);

            return redirect()->route('dashboard.perusahaan');
        }

        // Coba login sebagai KaryawanPerusahaan
        $karyawan = KaryawanPerusahaan::where('email', $email)->first();
        if ($karyawan && Hash::check($password, $karyawan->password)) {
            Auth::guard('web')->login($karyawan);
            
            return redirect()->route('karyawanperusahaan');
        }

        return response()->json([
            'message' => 'Email atau password salah.'
        ], 401);
    }

    public function viewRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8|confirmed',
            'code' => 'required|string|min:8|confirmed',
        ]);

        $code = Code::where('code', $validated['code'])->first();
        $idCode = $code->id;

        if($code->status == 'USED') {
            return redirect()->back()->withErrors(['code' => 'Code already used']);
        }

        if (!$code) {
            return redirect()->back()->withErrors(['code' => 'Invalid code']);
        }
        
        $checkDuplicateAcc = $this->checkDuplicateAcc($validated['email']);
        
        if ($checkDuplicateAcc) {
            return redirect()->back()->withErrors(['email' => 'Email already exists']);
        }

        if($code->code_type == 'STAFF') {
            $staffMitra = new StaffMitra();
            $staffMitra->name = $validated['name'];
            $staffMitra->email = $validated['email'];
            $staffMitra->password = Hash::make($validated['password']);
            $staffMitra->id_code = $idCode;
            $staffMitra->save();
        }else if($code->code_type == 'EMPLOYEE') {
            return redirect()->route('employee.register', ['data' => $validated]);
        }
    }

    public function checkDuplicateAcc($email)
    {
        $checkDuplicateAcc = StaffMitra::where('email', $email)->first();

        if ($checkDuplicateAcc) {
            return true;
        }

        $checkDuplicateAcc = StaffPerusahaan::where('email', $email)->first();

        if ($checkDuplicateAcc) {
            return true;
        }

        $checkDuplicateAcc = KaryawanPerusahaan::where('email', $email)->first();

        if ($checkDuplicateAcc) {
            return true;
        }

        return false;
    }
}
