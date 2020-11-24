<?php

namespace App\Http\Controllers;

use App\Models\Transportation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VehicleTransportation extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $transportations = Auth::user()->transportations()->orderBy('created_at', 'desc')->get();
        return view('transportations/index', ['transportations' => $transportations]);
    }

    public function create()
    {
        return view('transportations/create');
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => 'Būtina pasirinkti miestą',
        ];

        $validator = Validator::make($request->all(), ['city' => 'required'], $messages);

        if ($validator->fails()) {
            return redirect('/transportations/create')->withErrors($validator);
        }

        Auth::user()->transportations()->create([
            'city' => $request->input('city')
        ]);

        return redirect('/transportations')->with('status', 'Transportavimo paslauga užsakyta');
    }

    public function destroy($id)
    {
        $transportation = Transportation::findOrFail($id);
        $transportation->delete();

        return redirect('/transportations')->with('status', 'Transportavimo paslauga atšaukta');
    }

}
