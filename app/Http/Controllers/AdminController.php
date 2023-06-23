<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function create(Request $request){
        
        DB::table('users')->insert(['user_type' => 'admin', 'name' => $request->fullname, 'email' => $request->email, 'password' => Hash::make($request->password)]);
        return Redirect::back()->with('error_code', 5);
    }

    public function getAllAdmins(){
        $admin = User::whereNotIn('user_type' , ['registered', 'guest'])->get();
        return view('manageAdmin', compact("admin"));
    }

    public function delete(Request $request){

        if (Auth::user()->user_type == 'super_admin') {

            $testAdmin = User::find($request->adminId);

            if ($testAdmin->user_type == 'super_admin') {
                return Redirect::back()->with('error_code', 12);
            }
            
            DB::table('users')->delete($request->adminId);
            return Redirect::back()->with('error_code', 6);
               
        }else {
            return Redirect::back()->with('error_code', 11);
        }

        
    }
}
