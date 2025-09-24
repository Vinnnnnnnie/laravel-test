<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;
class BikeController extends Controller
{
    public function index() {
        $bikes = Bike::orderBy('created_at', 'desc')->get();
        return view('bikes.index', ['bikes' => $bikes]);
    }

    public function show($id) {
        $bike = Bike::findOrFail($id);
        return view('bikes.show', ['bike' => $bike]);
    }

    public function create() {
        return view('bikes.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'color' => 'required|string|max:100',
            'engine_size' => 'required|integer|min:50|max:2000',
            'MOT' => 'required|date',
            'taxed' => 'required|boolean',
            'insured' => 'required|boolean',
        ]);

        Bike::create($validated);

        return redirect('/bikes')->with('success', 'Bike added successfully!');
    }

    public function edit($id) {
        $bike = Bike::findOrFail($id);
        return view('bikes.edit', ['bike' => $bike]);
    }

    
}
