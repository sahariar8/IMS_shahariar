<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $notification = array(
            'message'=>'Admin LogOut Successfully',
            'alert-type'=> 'success'
        );

        return redirect('/login')->with($notification);
    }

    public function profile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile',compact('adminData'));  
    }

    public function edit(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.adminProfile_edit',compact('adminData'));
    }
    
    public function store(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;

        if($request->file('image')){
            $file = $request->file('image');
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $fileName);
            $data->image = $fileName;
        }

        $data->save();
        $notification = array(
            'message'=>'Admin Profile Updated Successfully',
            'alert-type'=> 'success'
        );

        return redirect()->route('admin.profile')->with($notification);   

    }

    public function changePassword(){

        return view('admin.admin_change_password');
    }

    public function updatePassword(Request $request){
       $validateData = $request->validate([
            'oldPassword'=>'required',
            'newPassword'=> 'required',
            'confirmPassword'=> 'required|same:newPassword',
       ]);
      $hashedPassword = Auth::user()->password;
      if(Hash::check($request->oldPassword, $hashedPassword)){
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->newPassword);
            $users->save();

            session()->flash('message','Password Updated Successfully');
            return redirect()->back();
      }else{
            session()->flash('message','Old Password is not matched');
            return redirect()->back();
      }
    }
}
