<?php

namespace App\Http\Controllers\Auth;

use App\Charts\UsersByRoleChart;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Country;
use App\Models\Province;
use App\Models\City;
use App\Models\Subdistrict;
use App\Models\Bank;
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
        $countries = Country::all();
        $provinces = Province::all();
        $cities = City::all();
        $banks = Bank::all();
        $subdistricts = Subdistrict::all();
        return view('auth.registrationCompany', compact('countries', 'provinces','cities','subdistricts', 'banks'));
    }


    public function postRegistration(Request $request): RedirectResponse
{
    // Validasi Input
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users|unique:companies',
        'password' => 'required|min:6|confirmed',
        'password_confirmation' => 'required',
        'country' => 'required',
        'province' => 'required',
        'city' => 'required',
        'subdistrict' => 'required',
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

        // Simpan ke Tabel Company
        $company = Company::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'country' => $data['country'],
            'province' => $data['province'],
            'city' => $data['city'],
            'subdistrict' => $data['subdistrict'],
            'status' => 1,
            'logo' => $data['logo'],
            'bank' => $data['bank'],
            'norek' => $data['norek']
        ]);

        // Simpan ke Tabel User
        $user = User::create([
            'user' => $company->id,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => 2, // Set role ke "company"
            'path' => $data['logo']
        ]);

        // Commit Transaction
        DB::commit();

        return redirect("login")->withSuccess('Great! You have Successfully registered');
    } catch (\Exception $e) {
        // Rollback jika ada kesalahan
        DB::rollBack();
        return back()->withError('Something went wrong: ' . $e->getMessage());
    }
}

}
