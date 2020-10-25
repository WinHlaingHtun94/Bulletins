<?php

namespace App\Http\Controllers;

use App\News;
use App\User;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function index(){
        $result = News::orderBy('id','desc')->get();
        // dd($result->toArray());        
       return view("user.home")->with('data',$result);
    }
    function contact_page(){
        return view("user.contact");
    }
    function user_profile(){
        $id = auth()->user()->id;
        $user_data = User::findOrFail($id);
        return view("user.user_profile")->with('data',$user_data);
    }
    function insert_news(Request $request){
        // dd($request->all());

        // News::create($request->all());
        // return 'success';
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'photo' => 'required',
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('user_profile')
                        ->withErrors($validator)
                        ->withInput();
        }

        $file = $request->file("photo");
        $filename = uniqid()."_" .$file->getClientOriginalName();
        $file->move(public_path().'/photos/',$filename);
        $data = [
            'user_id' => $request->user_id,
            'title' => $request->title,
            'photo' => $filename,
            'content' => $request->content

        ];
        News::create($data);
        return back()->with('success','Insert Success');
    }

    //insert contact
    function insert_contact(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('contact_page')
                        ->withErrors($validator)
                        ->withInput();
        }
        $datas = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];
        Contact::create($datas);
        return back()->with('success','Contact success!');
    }
    // look content
    function look_content($id){
        // $result = News::findOrFail($id);
        // dd($result->toArray());
        $result = DB::table('news')
                  ->join('users','users.id','=','news.user_id')
                  ->where('news.id','=',$id)
                  ->select('users.*','news.*')
                  ->get();
        return view('user.look_content')->with('data',$result);
    }
    // delete info
    function delete_info($id){
        News::findOrFail($id)->delete();
        return redirect()->route('user_homepage')->with('delete','Delete Success!');
    }
    // edit info
    function edit_info(Request $request){
        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'photo' => 'required',
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(url('look_content/'.$id))
                        ->withErrors($validator)
                        ->withInput();
        }
        $file = $request->file('photo');
        $fileName = uniqid().'_'.$file->getClientOriginalName();
        $file->move(public_path().'/photos/',$fileName);
        $id = $request->id;
        $data = [
            'title' => $request->title,
            'photo' => $fileName,
            'content' => $request->content
        ];
        News::findOrFail($id)->update($data);
        return back()->with('update','Update Success!');

    }
    // update account
    function update_account(Request $request){
        $id = $request->id;
        $data = [
            'name' => $request->name,
            'email' => $request->email
        ];
        User::findOrFail($id)->update($data);
        return back()->with('update','Update Account Success!');
    }

    // change password
    function change_password(Request $request){

        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $id = Auth()->user()->id;
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;
        
       
        $data = User::findOrFail($id);
        if(!Hash::check($old_password,$data->password)){
            return back()->with('password','Old password does not match!');
        }else if($new_password !== $confirm_password){
            return back()->with('password','New password and Confirm password does not match!');
        }else if(!(strlen($new_password) >= 6 && strlen($confirm_password) >= 6)){
            return back()->with('password','Password length must be at least 6!');
        }else{
            $hash_make_password = Hash::make($new_password);
            $item = [
                'password' => $hash_make_password
            ];
            User::findOrFail($id)->Update($item);
            return back()->with('Pass_change','Change password completed!');
        }
        
    }
}
