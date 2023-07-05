<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.users',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $levels = Level::all();
        return view('admin.users.create',compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255','min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone'=>['required', 'string', 'max:255'],
            'role'=>['required', 'string', 'max:255'],
        ]);
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'phone'=>$request['phone'],
            'role'=>$request['role'],
            'level'=>$request['level'],
            'section_id'=>$request['section_id'],
            'status'=>'debloc',
        ]);
        return back()->with('success','Compte créé avec succès');
    }

    /**
     * Display the specified resource.
     */
  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($name)
    {
        $user = User::where('name',$name)->first();
        $levels = Level::all();
        return view('admin.users.edit',compact('user','levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $user)
    {
       
        if(isset($request->password)){
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['string', 'min:8', 'confirmed'],
                'phone'=>['required', 'string', 'max:255'],
                'role'=>['required', 'string', 'max:255'],
            ]);
            $user_edit = User::find($user);
            $user_edit->name = $request->name;
            $user_edit->password = $request->password;
            $user_edit->email = $request->email;
            $user_edit->phone = $request->phone;
            $user_edit->role = $request->role;
            $user_edit->level = $request->level;
            $user_edit->section_id = $request->section_id;
            $user_edit->save();
        }else{
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone'=>['required', 'string', 'max:255'],
                'role'=>['required', 'string', 'max:255'],
            ]);
            $user_edit = User::find($user);
            $user_edit->name = $request->name;
            $user_edit->email = $request->email;
            $user_edit->phone = $request->phone;
            $user_edit->role = $request->role;
            $user_edit->level = $request->level;
            $user_edit->section_id = $request->section_id;
            $user_edit->save();
        }

        return redirect()->route('users.edit',$user_edit->name)->with('success','le compte a été modifier');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return back()->with('supprimer','le compte a été supprimer'); 
    }
}
