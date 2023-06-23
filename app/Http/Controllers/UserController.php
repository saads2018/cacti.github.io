<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateUser(Request $request, $id)
    {
    if($request->profilepicture!=null){
    $request->validate([
    'email' => 'unique:users,email,'.$id, 
    'cust_phone_number' => 'unique:users,cust_phone_number,'.$id,
    'profilepicture'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:1000',
    ]);    
    $request->profilepicture->store('images/profilepic', 'public');
    User::where('id',$id)->update(array('name'=>$request->name,'email'=>$request->email,'cust_phone_number'=>$request->cust_phone_number,
    'cust_address'=>$request->cust_address, 'profilepicture'=>$request->profilepicture->hashname()));
    }
    else{
        $request->validate([
            'email' => 'unique:users,email,'.$id, 
            'cust_phone_number' => 'unique:users,cust_phone_number,'.$id,
        ]); 
    User::where('id',$id)->update(array('name'=>$request->name,'email'=>$request->email,'cust_phone_number'=>$request->cust_phone_number,
    'cust_address'=>$request->cust_address,));
    }
    return redirect('/userProfile');
    }

    public function updateAdmin(Request $request, $id)
    {
    if($request->profilepicfile!=null){
    $request->validate([
    'email' => 'unique:users,email,'.$id, 
    'cust_phone_number' => 'unique:users,cust_phone_number,'.$id,
    ]);
        
    $request->profilepicfile->store('images/profilepic', 'public');
    User::where('id',$id)->update(array('name'=>$request->name,'email'=>$request->email,'cust_phone_number'=>$request->customer_phone_number,
    'cust_address'=>$request->cust_address, 'profilepicture'=>$request->profilepicfile->hashname()));
    }
    
    else{
        $request->validate([
            'email' => 'unique:users,email,'.$id, 
            'cust_phone_number' => 'unique:users,cust_phone_number,'.$id,
        ]); 
    User::where('id',$id)->update(array('name'=>$request->name,'email'=>$request->email,'cust_phone_number'=>$request->customer_phone_number,
    'cust_address'=>$request->cust_address,));
    }
    return redirect('/adminProfile');
    }

    public function updateUserProfile(Request $request, $id)
    {
        if($id!=null){
            $request->file->store('images/profilepic', 'public');
        }
        return redirect('/userProfile');
    }

    public function changePassword(Request $request){

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $getpassword = $request->get('new-password');
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect('/userProfile');

    }

    public function changeAdminPassword(Request $request){

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect('/adminProfile');

    }

    public function resetEmailPassword(Request $request, $id)
    {
        if($id!=null){
            User::where('id',$id)->update(array('email'=>$request->email,'password'=>$request->password,));
            }
            return redirect('/userProfile');
    }
}