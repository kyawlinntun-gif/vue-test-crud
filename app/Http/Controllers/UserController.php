<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response([
            'users' => $users
        ]); 
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3|max:20',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits_between:7,9',
            'address' => 'required|string|min:5|max:25'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        return response([]);
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $user = User::findOrFail($id);
        return response([
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer',
            'name' => 'required|string|min:3|max:20',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'phone' => 'required|digits_between:7,9',
            'address' => 'required|string|min:5|max:25'
        ]);
        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        return response([
            'user' => $request->all()
        ]);
    }

    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->delete();

        return response([
            'user' => $request->id
        ]);
    }

}
