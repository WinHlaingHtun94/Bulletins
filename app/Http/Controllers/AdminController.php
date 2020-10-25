<?php

namespace App\Http\Controllers;

use App\User;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    function index(){
        return view('admin.home');
    }
    function  admin_profile(){
        $id = Auth()-> user()->id;
        $data = User::find($id);
        return view('admin.admin_profile')->with('data',$data);
    }
    function contact(){
        $result = Contact::orderBy('id','desc')->get();
        return view('admin.contact')->with('data',$result);
    }
    function manage_premium(){
        $data = User::get();
        return view('admin.manage_premium_user')->with('data',$data);
    }
    function user_account(){
        return view('admin.user_account');
    }

    // delete contact page
    function delete_contact_page($id){
        Contact::findOrFail($id)->delete();
        return back()->with('delete','Delete contact success!');
    }

    // update contact page
    function update_contact_page($id){
        $data = Contact::findOrFail($id);
        return view('admin.update_contact_page')->with('data',$data);
    }

    // contact update
    function contact_update(Request $request){
        $id = $request->contact_id;
        $validator = Validator::make($request->all(), [
            'contact_name' => 'required',
            'contact_email' => 'required',
            'contact_message' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(url('update_contact_page/'.$id))
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'name' => $request->contact_name,
            'email'=> $request->contact_email,
            'message'=>$request->contact_message
        ];
        Contact::findOrFail($id)->update($data);
        return redirect()->route('contact')->with('update_success','Update Contact Successfully!');
    }

    // delete user info
    function delete_user_info($id){
        User::findOrFail($id)->delete();
        return back()->with('delete_user_info','Delete Success!');
    }

    // update user info
    function update_user_info($id){
        $data = User::findOrFail($id);
        return view('admin.update_premium_user')->with('data',$data);
    }

    // update premium user info
    function update_premium_user_info(Request $request){
        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'Admin' => 'required',
            'Premium' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(url('update_user_info/'.$id))
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'isAdmin' => $request->Admin,
            'isPremium' => $request->Premium
        ];
        $isAdmin = $request->Admin;
        $isPremium = $request->Premium;
        if(($isAdmin==0 || $isAdmin==1) && ($isPremium==0 || $isPremium==1)){
            User::findOrFail($id)->Update($data);
            return redirect()->route('manage_premium')->with('update_premium_user_success',"Update Success!");
        }else{
            return back()->with('validation_error','1 or 0 must be fill in isAdmin and isPremium fields!');
        }      
    }

    //update admin profile
    function update_admin_profile(Request $request){
        $id = $request->user_id;
        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'user_email' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin_profile')
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'name' => $request->user_name,
            'email'=> $request->user_email
        ];
        User::findOrFail($id)->update($data);
        return back()->with('success','Update Admin Profile Success!');

    }

    //admin profile password change
    function admin_profile_password_change(Request $request){
        $id = Auth()->user()->id;
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;
        $data = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin_profile')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        if(!Hash::check($old_password,$data->password)){
            return back()->with('check','Old Password does not match!');
        }else if(!(strlen($new_password) >= 8) && !(strlen($confirm_password) >= 8) ){
            return back()->with('pass_length','New password length must be at least 8');
        }else if(!($new_password == $confirm_password)){
            return back()->with('pass_check','New password and confirm password must be same');
        }else{
            $password_data = [
                'password' => Hash::make($new_password)
            ];
            User::findOrFail($id)->update($password_data);
            return back()->with('change_success','Change Admin Password Success!');
        }

    }
}
