<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function layout (){
        //$userEmail = session('user_email');

        return view('users');
    }

    public function index()
    {
        // Retrieve all categories
        $users = User::all();

        return response()->json($users);
    }

    public function show($id)
    {
        // Retrieve a specific category
        $user = User::findOrFail($id);

        return response()->json($user);
    }

    public function store(Request $request)
    {
        // Validate the request
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        // Create a new category
        //$user = User::create($request->all());
        // Create a new user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);


        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required'
        ]);

        // Update the specified category
        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json($user, 200);
    }


}
