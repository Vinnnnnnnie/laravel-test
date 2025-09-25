<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;
use App\Models\Garage;

class BikeController extends Controller
{
    public function index() {
        $bikes = Bike::with('garage')->orderBy('created_at', 'desc')->paginate(10);
        return view('bikes.index', ['bikes' => $bikes]);
    }

    public function show(Bike $bike) {
        $bike->load('garage');
        return view('bikes.show', ['bike' => $bike]);
    }

    public function create() {
        $garages = Garage::all();
        return view('bikes.create', ['garages' => $garages]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'colour' => 'required|string|max:100',
            'engine_size' => 'required|integer|min:50|max:2000',
            'MOT' => 'sometimes',
            'taxed' => 'sometimes',
            'insured' => 'sometimes',
            'garage_id' => 'required|exists:garages,id'
        ]);

        Bike::create($validated);

        return redirect('/bikes')->with('success', 'Bike added successfully!');
    }

    public function destroy(Bike $bike) {
        $bike->delete();
        return redirect()->route('bikes.index')->with('success', 'Bike deleted successfully!');
    }
    public function edit($id) {
        $bike = Bike::findOrFail($id);
        return view('bikes.edit', ['bike' => $bike]);
    }

    
}
