<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
      $users = User::all();
      return view('users.index')->with('users',$users);


    }

    public function makeAdmin(User $user)
    {
        $user->role = "admin";

        $user->save();

        session()->flash('success','User made Admin Successfully');

        return redirect()->back();
    }

    public function edit()
    {
        return view('users.edit')->with('user',auth()->user());
    }

    public function update(Request $request)
    {
     $user = auth()->user();

     $user->update([
         'name'=>$request->name,
         'about'=>$request->about


     ]);

    session()->flash('success','user updated successfully');
    return redirect()->back();

    }
}
