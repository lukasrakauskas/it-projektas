<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RoadsideAssistance extends Controller
{
    private function distance($lat1, $lon1, $lat2, $lon2)
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $km = $dist * 60 * 1.1515 * 1.609344;
            return $km;
        }
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $messages = [
            'required' => 'Jūsų vieta reikalinga tam, kad galėtume priskirti artimiausią techninės pagalbos automobilį',
        ];

        $validator = Validator::make($request->all(), [
            'lat' => 'bail|required|numeric',
            'lng' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return redirect('/')->withErrors($validator);
        }

        $lat = $request->input('lat');
        $lng = $request->input('lng');

        if (Auth::user()->vehicle()->exists()) {
            $vehicle = Auth::user()->vehicle()->first();
            $distance = $this->distance($lat, $lng, $vehicle->latitude, $vehicle->longitude);
            return view('roadside-assistance', ['vehicle' => $vehicle, 'distance' => $distance]);
        }

        $vehicle = Vehicle::where('available', true)->get()->reduce(function ($currentVehicle, $item) use ($lat, $lng) {
            if ($currentVehicle == null)
                return $item;

            $distanceCurrent = $this->distance($lat, $lng, $currentVehicle->latitude, $currentVehicle->longitude);
            $distance = $this->distance($lat, $lng, $item->latitude, $item->longitude);

            return $distance < $distanceCurrent ? $item : $currentVehicle;
        });

        // TODO: jei nera automobiliu grazinti atitinkamai kazka

        $vehicle->available = false;
        $vehicle->user()->associate(Auth::user());
        $vehicle->save();

        $distance = $this->distance($lat, $lng, $vehicle->latitude, $vehicle->longitude);

        return view('roadside-assistance', ['vehicle' => $vehicle, 'distance' => $distance]);
    }

    public function cancel()
    {
        if (Auth::user()->vehicle()->exists()) {
            $vehicle = Auth::user()->vehicle()->first();
            $vehicle->user()->dissociate();
            $vehicle->available = true;
            $vehicle->save();
        }

        return redirect()->to('/')->with('status', "Techninė pagalba atšaukta");
    }
}
