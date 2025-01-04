<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Country;
use App\Models\Province;
use App\Models\City;
use App\Models\Subdistrict;
use App\Models\CardType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AuthControllerCustomer extends Controller
{
    public function getProvinces(Request $request)
    {
        if ($request->ajax()) {
            $countryId = $request->country_id;

            // Query provinces berdasarkan country
            $provinces = Province::where('country', $countryId)->get(['id', 'province']);

            if ($provinces->isEmpty()) {
                return response()->json(['error' => 'No provinces found for this country'], 404);
            }

            return response()->json($provinces);
        }

        return response()->json(['error' => 'Invalid Request'], 400);
    }

    public function getCities(Request $request)
    {
        // Debugging untuk memastikan parameter diterima
        if (!$request->has('province_id')) {
            return response()->json(['error' => 'Province ID is required'], 400);
        }

        $provinceId = $request->province_id;

        // Ambil data city berdasarkan province ID
        $cities = City::where('province', $provinceId)->get(['id', 'city']);

        // Jika data kosong
        if ($cities->isEmpty()) {
            return response()->json(['error' => 'No cities found for this province'], 404);
        }

        return response()->json($cities);
    }

    public function getSubdistricts(Request $request)
    {
        if ($request->ajax()) {
            $cityId = $request->city_id;

            // Query subdistricts berdasarkan city
            $subdistricts = Subdistrict::where('city', $cityId)->get(['id', 'subdistrict']);

            if ($subdistricts->isEmpty()) {
                return response()->json(['error' => 'No subdistricts found for this city'], 404);
            }

            return response()->json($subdistricts);
        }

        return response()->json(['error' => 'Invalid Request'], 400);
    }


    /**
     * Tampilkan halaman registrasi customer.
     */
    public function registration(): View
    {
    $countries = Country::all();
    $provinces = Province::all();
    $cities = City::all();
    $subdistricts = Subdistrict::all();
    $card_types = CardType::all();
    return view('auth.registrationCustomer', compact('countries','provinces','cities','subdistricts','card_types'));
    }

    /**
     * Proses registrasi customer.
     */
    public function postRegistration(Request $request): RedirectResponse
    {
        // Validasi Input
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users|unique:customers',
            'password' => 'required|min:6',
            'contact' => ['required', 'numeric'],
            'country' => 'required',
            'province' => 'required',
            'city' => 'required',
            'subdistrict' => 'required',
            'card_type' => 'required',
            'card_number' => ['required', 'numeric'],
            'card_expired' => 'required',
            'cvv' => ['required', 'numeric', 'digits:4'],
        ]);

        DB::beginTransaction(); // Mulai Transaction

        try {


            // Simpan ke Tabel Customer
            $customer = Customer::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'contact' => $validatedData['contact'],
                'country' => $validatedData['country'],
                'province' => $validatedData['province'],
                'city' => $validatedData['city'],
                'subdistrict' => $validatedData['subdistrict'],
                'card_type' => $validatedData['card_type'],
                'card_number' => $validatedData['card_number'],
                'card_expired' => $validatedData['card_expired'],
                'cvv' => $validatedData['cvv'],
            ]);

                        // Simpan ke Tabel User
            $user = User::create([
                'user' => $customer->id,
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'role_id' => 3, // Set role ke "customer"
                'path' => "",
            ]);

            DB::commit(); // Commit Transaction

            return redirect('dashboard')->with('success', 'Great! You have Successfully registered');
        } catch (\Throwable $e) {
            DB::rollBack(); // Rollback jika ada kesalahan

            // Simpan error ke log
            Log::error('Registration Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return back()->withErrors(['error' => 'Something went wrong. Please try again.'])->withInput();
        }
    }
}
