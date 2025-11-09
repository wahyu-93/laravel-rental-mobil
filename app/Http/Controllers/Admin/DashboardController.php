<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $totalCars = Car::count();
        $rentedCars = Car::where('status', 'rented')->count();

        $totalCustomers = User::whereDoesntHave('roles', function($query){
            $query->where('name', 'admin');
        })->count();

        $totalRentals = Rental::count();
        $totalRevenue = Rental::where('status', 'approved')->sum('total_fee');
        $totalLateFees = Rental::where('status', 'approved')->sum('late_fee');

        $pendingRentals = Rental::where('status', 'pending')->count();
        $approvedRentals = Rental::where('status', 'approved')->count();
        $rejectRentals = Rental::where('status', 'reject')->count();

        $populerCars = Car::withCount('rentals')
                        ->orderBy('rentals_count','desc')
                        ->limit(5)
                        ->get()
                        ->map(function($car){
                            return [
                                'car_name' => $car->brand ?: ($car->model ?: "Mobil #{$car->id}"),
                                'rental_count' => $car->rentals_count,
                            ];
                        });

        return inertia('Admin/Dashboard/Index',[
            'totalCars' => $totalCars,
            'rentedCars' => $rentedCars,
            'totalCustomers' => $totalCustomers,
            'rentalStats' => [
                'total_rentals' => $totalRentals,
                'total_revenue' => $totalRevenue,
                'total_late_fee' => $totalLateFees,
                'status_counts' => [
                    'pending'   => $pendingRentals,
                    'approved'  => $approvedRentals,
                    'rejected'  => $rejectRentals,
                ],
                'popular_cars'  => $populerCars,
            ]
        ]);

    }
}
