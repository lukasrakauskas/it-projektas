<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('vehicles.index', ['vehicles' => $vehicles]);
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => 'Šis laukelis yra reikalingas.',
            'regex' => 'Įveskite tinkamus valstybinius numerius, pavyzdžiui, ABC123.',
            'in' => 'Galimi miestai: Vilnius, Kaunas, Klaipėda.'
        ];

        $validator = Validator::make($request->all(), [
            'license_plate' => 'required|regex:/([A-PR-VZ]){3}([0-9]){3}/u',
            'brand' => 'required',
            'model' => 'required',
            'city' => 'required|in:Vilnius,Kaunas,Klaipėda'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }


        $locations = [
            'Kaunas' => [
                'latitude' => 54.898521,
                'longitude' => 23.903597,
            ],
            'Vilnius' => [
                'latitude' => 54.687157,
                'longitude' => 25.279652,
            ],
            'Klaipėda' => [
                'latitude' => 55.703297,
                'longitude' => 21.144279,
            ],
        ];

        $change = mt_rand(-5, -5) / 10;
        $city = $request->input('city');

        $vehicle = array_merge($request->except('_token'), [
            'latitude' => $locations[$city]['latitude'] + $change,
            'longitude' => $locations[$city]['longitude'] + $change,
        ]);

        Vehicle::create($vehicle);

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Automobilis sėkmingai pridėtas');
    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id)
            ->makeHidden(['created_at', 'updated_at']);
        session()->flashInput($vehicle->toArray());
        return view('vehicles.edit', ['id' => $vehicle->id]);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'required' => 'Šis laukelis yra reikalingas.',
            'regex' => 'Įveskite tinkamus valstybinius numerius, pavyzdžiui, ABC123.',
            'in' => 'Galimi miestai: Vilnius, Kaunas, Klaipėda.'
        ];

        $validator = Validator::make($request->all(), [
            'license_plate' => 'required|regex:/([A-PR-VZ]){3}([0-9]){3}/u',
            'brand' => 'required',
            'model' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }

        $vehicle = Vehicle::findOrFail($id);
        $vehicle->fill($request->except('_token', 'created_at', 'updated_at', 'city'));
        $vehicle->save();

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Automobilis sėkmingai atnaujintas');
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Automobilis pašalintas');
    }
}
