<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = [
            'user' => 'Vartotojas',
            'worker' => 'Vadybininkas',
            'admin' => 'Administratorius'
        ];
        return view('users.index', ['users' => $users, 'roles' => $roles]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id)
            ->makeHidden(['email_verified_at', 'created_at', 'updated_at']);
        session()->flashInput($user->toArray());
        return view('users.edit', ['id' => $user->id]);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'required' => 'Šis laukelis yra reikalingas',
            'in' => 'Rolė gali būti: vartotojas, vadybininkas arba administratorius'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'role' => 'required|in:user,worker,admin'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }

        $user = User::findOrFail($id);
        $user->fill($request->except('_token', 'created_at', 'updated_at', '_method'));
        $user->role = $request->input('role');
        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'Vartotojas sėkmingai atnaujintas');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);



        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Vartotojas sėkmingai pašalintas');
    }
}
