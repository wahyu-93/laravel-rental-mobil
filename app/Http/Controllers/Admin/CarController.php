<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Car\StoreRequest;
use App\Models\Car;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::latest()->paginate(10);

        return inertia('Admin/Cars/Index',[
            'cars' => $cars,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return inertia('Admin/Cars/Create',[
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $car = $request->all();

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image->storeAs('cars', $image->hashName(), 'public');
            $car['image'] = $image->hashName();
        };

        Car::create($car);

        return redirect()->route('admin.cars.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $car = Car::where('slug', $slug)->firstOrFail();
        $categories = Category::all();

        return inertia('Admin/Cars/Edit',[
            'cars'  => $car,
            'categories' => $categories,
        ]);
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
        $car = Car::findOrFail($id);

        if($car->image){
            Storage::disk('local')->delete('public/cars/' . basename($car->image));
        };

        $car->delete();
        return redirect()->route('admin.cars.edit');
    }
}
