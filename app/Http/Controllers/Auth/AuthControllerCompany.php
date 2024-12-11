<?php

namespace App\Http\Controllers\Auth;

use App\Charts\UsersByRoleChart;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Models\User;

class AuthControllerCompany extends Controller
{
    public function registration(): View
    {
        return view('auth.registrationCompany');
    }


    public function postRegistration(Request $request): RedirectResponse
{
    // Validasi Input
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users|unique:companies',
        'password' => 'required|min:6',
        'address' => 'required',
        'logo' => 'required|image|file|max:1024',
        'bank' => 'required',
        'norek' => 'required'
    ]);

    try {
        // Mulai Transaction
        DB::beginTransaction();

        // Simpan File Logo
        $data = $request->all();
        if ($request->file('logo')) {
            $data['logo'] = $request->file('logo')->store('company-logo', 'public');
        }

        // Simpan ke Tabel User
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => 2, // Set role ke "company"
            'path' => $data['logo']
        ]);

        // Simpan ke Tabel Company
        $company = Company::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'logo' => $data['logo'],
            'bank' => $data['bank'],
            'norek' => $data['norek']
        ]);

        // Commit Transaction
        DB::commit();

        return redirect("dashboard")->withSuccess('Great! You have Successfully registered');
    } catch (\Exception $e) {
        // Rollback jika ada kesalahan
        DB::rollBack();
        return back()->withError('Something went wrong: ' . $e->getMessage());
    }
}

}
