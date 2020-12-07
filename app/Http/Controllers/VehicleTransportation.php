<?php

namespace App\Http\Controllers;

use App\Models\Transportation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VehicleTransportation extends Controller
{
    private $statuses = [
        'ordered' => 'Paslauga užsakyta',
        'transporting' => 'Automobilis transportuojamas',
        'done' => 'Automobilis aikštelėje'
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $transportations = Auth::user()->transportations()->orderBy('created_at', 'desc')->get();
        return view('transportations.index', ['transportations' => $transportations, 'statuses' => $this->statuses]);
    }

    public function create()
    {
        return view('transportations.create');
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

        return redirect('/transportations')->with('success', 'Transportavimo paslauga užsakyta');
    }

    public function destroy($id)
    {
        $transportation = Transportation::findOrFail($id);

        // TODO: cant delete as other or not vadybnininkas

        $transportation->delete();

        if (auth()->user()->isWorker()) {
            return redirect('/transportations/list')->with('success', 'Transportavimo paslauga atšaukta');
        }

        return redirect('/transportations')->with('success', 'Transportavimo paslauga atšaukta');
    }

    public function list()
    {
        $transportations = Transportation::with('user')->orderBy('created_at', 'desc')->get();
        return view('transportations.list', ['transportations' => $transportations, 'statuses' => $this->statuses]);
    }

    public function edit($id)
    {
        $transportation = Transportation::with('user')->findOrFail($id);
        return view('transportations.edit', ['transportation' => $transportation, 'statuses' => $this->statuses]);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'required' => 'Būtina pasirinkti statusą',
            'in' => 'Statusas gali būti: paslauga užsakyta, automobilis transportuojamas arba automobilis aikštelėje'
        ];

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:ordered,transporting,done'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }

        $transportation = Transportation::findOrFail($id);
        $transportation->status = $request->input('status');
        $transportation->save();

        return redirect()
            ->route('transportations.list')
            ->with('success', 'Paslaugos statusas pakeistas');
    }

}
