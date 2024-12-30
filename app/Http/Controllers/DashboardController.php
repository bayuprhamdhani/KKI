<?php

namespace App\Http\Controllers;

use App\Charts\UsersByRoleChart;
use App\Models\Selling;
use App\Models\User;
use App\Models\Subdistrict;
use App\Models\Service;
use App\Models\City;
use App\Models\Car;
use App\Models\Country;
use App\Models\Province;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function filterCars(Request $request)
    {
        $city = $request->input('city');
        $pick_up = $request->input('pick_up');
        $drop_off = $request->input('drop_off');
    
        // Query mobil berdasarkan kota
        $cars = Car::join('companies', 'companies.id', '=', 'cars.company')
                   ->where('companies.address', 'LIKE', "%{$city}%");
    
        // Jika ada tanggal pick-up dan drop-off, tambahkan filter ketersediaan mobil
        if ($pick_up && $drop_off) {
            $cars = $cars->whereDoesntHave('transactions', function ($query) use ($pick_up, $drop_off) {
                $query->where(function ($subQuery) use ($pick_up, $drop_off) {
                    $subQuery->whereBetween('pick_up', [$pick_up, $drop_off])
                             ->orWhereBetween('drop_off', [$pick_up, $drop_off])
                             ->orWhere(function ($subSubQuery) use ($pick_up, $drop_off) {
                                 $subSubQuery->where('pick_up', '<', $pick_up)
                                             ->where('drop_off', '>', $drop_off);
                             });
                });
            });
        }
    
        // Ambil hasil filter mobil
        $cars = $cars->select('cars.*', 'companies.address', 'companies.name as company', 'companies.logo')->get();
    
        // Kode untuk menghasilkan HTML untuk mobil yang difilter
        $html = '';
        if ($cars->isEmpty()) {
            $html = '<div class="col-12 text-center py-5">
                        <h4>No cars available for this city and date range.</h4>
                     </div>';
        } else {
            foreach ($cars as $car) {
                $transmisiText = $car->transmisi == 1 ? 'Manual' : ($car->transmisi == 2 ? 'Matic' : 'Error');
    
                $categoryColorClass = $car->status == 1 ? 'bg-success text-white' : 
                                      ($car->status == 2 ? 'bg-danger text-white' : 'bg-dark text-white');
    
                $statusText = $car->status == 1 ? 'Available' : ($car->status == 2 ? 'Unavailable' : 'Error');
    
                $html .= '
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img src="' . asset('storage/' . $car->pict) . '" alt="' . $car->name . '" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title fw-bold">' . $car->name . '</h5>
                                <h5 class="card-title fw-bold">' . number_format($car->price, 0, ',', '.') . '</h5>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="card-text text-muted">Transmisi : ' . $transmisiText . '</p>
                                <p class="card-text text-muted">Chair : ' . $car->qty . '</p>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <img src="' . asset('storage/' . $car->logo) . '" class="card-img-top" style="width: 35px; height: 35px; object-fit: cover;">
                                    <h5 class="card-title fw-bold mt-1">' . $car->company . '</h5>
                                </div>
                                <div>
                                    <a href="' . route('registerTransaction', ['id' => $car->id]) . '" class="btn btn-sm btn-warning mb-1">ORDER</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }
    
        return response()->json(['html' => $html]);
    }
    


    /**
     * Display a listing of the resource.
     */
    public function index(UsersByRoleChart $userChart)
    {
        $cities = City::All();
        $cars = Car::join('companies', 'companies.id', '=', 'cars.company')
           ->select('cars.*', 'companies.address', 'companies.name as company', 'companies.logo')
           ->get();
        $provinces = Province::All();
        $countries = Country::All();
        $subdistricts = Subdistrict::All();
        $services = Service::All();
        $user = User::count();
        $sellings = Selling::count();
        return view('dashboard', compact('cars', 'user', 'sellings','services','cities','provinces','countries','subdistricts'), ['chart' => $userChart->build()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
