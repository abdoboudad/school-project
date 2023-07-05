<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
    public function profile($name){
        $user = User::where('name',$name)->first();
        return view('admin.users.profile',compact('user'));
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'oldpass' => 'required',
            'newpass' => 'required|min:8|different:oldpass',
            'confirmepass' => 'required|same:newpass',
        ]);
        $user = Auth::user();
        if(!Hash::check($request->oldpass,$user->password)){
            return redirect()->back()->withErrors(['oldpass'=>'the old password is incorrect.']);
        }
        $user->password = Hash::make($request->newpass);
        $user->save();
        return redirect()->back()->with('success', 'Password updated successfully.');
  
    }
    public function status(Request $request,$id){
            $user = User::find($id);
            if($user->status === 'debloc'){
                $user->status = 'bloc';
                $user->save();
            }else{
                $user->status = 'debloc';
                $user->save();
            }
            return redirect()->back()->with('success','le compte a été '.$user->status);

    }
}
