<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //if auth user is admin then do below
        if(Auth::user()->role_id == 1) {

            //set variable data with variables
            $data = [
                'users' => User::all()
            ];

            //return view users.index with variable data
            return view('users.index')->with($data);
        }
        //if auth user is not admin redirect to games.index
        else{
            return redirect(route('games.index'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //if auth user is the same as user->id then return view users.edit with variable user
        if($user->id == Auth::id()) {
            return view('users.edit' , compact('user'));
        }
        //if auth user is not the same as the user->id then redirect to users.edit form him self
        else{
            return redirect(route('users.edit', Auth::id()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        //make f_name, l_name and email required
        $this->validate($request, [
            'f_name' => 'required',
            'l_name' => 'required',
            'email' => 'required',
        ]);

        //update user
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->email = $request->email;
        $user->password = hash::make($request->password);
        //save user
        $user->save();

        //return redirect to users.edit from itself with message
        return redirect(route('users.edit', Auth::id()))->with('success', 'User updated with success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user

     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //delete user
        $user->delete();

        //return redirect to users.index with message
        return redirect(route('users.index'))->with('success', 'User deleted');
    }
}
