<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
      return view('user.index')->with('users',User::all());
    }

    public function makeAdmin(User $user){
      $user->role="admin";
      $user->save();
      return redirect(route('users.index'))->with('status','user made admin successfully!');
    }

    public function edit(){
      return view('user.edit')->with('user',auth()->user());
    }
    public function update(Request $request){
      $user=auth()->user();
      $user->update([
        'name'=>$request->name,
        'email'=>$request->email,
        'about'=>$request->about
      ]);
      return redirect(route('users.index'))->with('status','user updated !');
    }
}
