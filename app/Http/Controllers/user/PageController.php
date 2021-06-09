<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Session;
use Auth;
use Illuminate\Support\Facades\Hash;
class PageController extends Controller
{
     public function passwordEdit($id)
    {
        $user=DB::table('users')->where('id',$id)->first();
        return view('user.profile.password-change',compact('user'));
        
    }
    public function passwordUpdate(Request $request, $id)
    {
        $user=DB::table('users')
        ->where('id',$id)
        ->update(
            [
                'password'=> Hash::make($request->n_password),
            ]
        );
        session()->flash("success","Information Update Successfully");
        return redirect(url('profile'));
    }
}
