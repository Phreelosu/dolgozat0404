<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller {

    /**
     * Store a newly created city in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // Validate the request data
        $validatedData = $request->validate([
            'city' => 'required|string|unique:cities|max:255',
        ]);

        // Create a new city instance
        $city = new City();
        $city->city = $request->city;

        // Save the city to the database
        $city->save();

        // Return a response indicating success
        return response()->json(['message' => 'City created successfully', 'city' => $city], 201);
    }

}
