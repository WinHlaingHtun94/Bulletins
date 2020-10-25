<?php

use App\Http\Controllers\AdminController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout','Auth\LoginController@logout')->name('logout');
// Route::get('success',function(){
//     return view('test.success');
// });
// //Data base insert
// Route::post('insert',function(Request $request){
//     $name=$request->name;
//     $title=$request->title;
//     $photo=$request->photo;
//     $content=$request->content;
//    // dd($name.'  '.$title.'   '.$photo.'   '.$content);
//     DB::insert("insert into news(name,title,photo,content)value(?,?,?,?)",[$name,$title,$photo,$content]);
//     return 'Success insert';
// })->name('insert');

// //Data base read all
// Route::get('read',function(){
//     $result = DB::select('select * from news');
//     //dd($result);
//     return view('raw.list')->with('data',$result);
// })->name('read');

// //Data base read each
// Route::get('read_each/{id}',function($id){
//     $results = DB::select('select * from news where id=?',[$id]);
//     return view('raw.list')->with('datas',$results);
// })->name('read_each');

// //Data base delete
// Route::get('delete/{id}',function($id){
//     DB::delete('delete from news where id=?',[$id]);
//     return 'Delete Success';
// });

// //Data base update
// Route::get('update/{id}',function($id){
//     $result=DB::select('select * from news where id=?',[$id]);
//     // dd($result);
//     return view('raw.update')->with('data',$result);
// });

// Route::post('updates',function(Request $request){
//     $id = $request->id;
//     $name = $request->name;
//     $title = $request->title;
//     $photo = $request->photo;
//     $content = $request->content;

//     // dd($name.'  '.$title.'  '.$photo.'   '.$content);
//     DB::update('update news set name=? ,title=? ,photo=? ,content=? where id=?',[$name,$title,$photo,$content,$id]);
//     return 'Update Success';
// });


// start bulletin project
Route::group(['middleware'=>['auth']],function(){
    // user
        Route::get('user_homepage','UserController@index')->name('user_homepage');
        Route::get('contact_page','UserController@contact_page')->name('contact_page');
        Route::get('user_profile','UserController@user_profile')->name('user_profile');
        Route::get('look_content/{id}','UserController@look_content')->name('look_content');
        Route::get('delete_info/{id}','UserController@delete_info')->name('delete_info')->middleware('checkPremium');
        Route::post('edit_info','UserController@edit_info')->name('edit_info')->middleware('checkPremium');
        Route::post('update_account','UserController@update_account')->name('update_account');
        Route::post('change_password','UserController@change_password')->name('change_password');
        // insert news
        Route::post('insert_news','UserController@insert_news')->name('insert_news');
        // insert contact
        Route::post('insert_contact','UserController@insert_contact')->name('insert_contact');
    // end of user
    // admin
        Route::group(['middleware'=> ['checkAdmin']],function(){
            Route::get('admin_page','AdminController@index')->name('admin_page');
            Route::get('admin_profile','AdminController@admin_profile')->name('admin_profile');
            Route::get('contact','AdminController@contact')->name('contact');
            Route::get('manage_premium','AdminController@manage_premium')->name('manage_premium');
            Route::get('user_account','AdminController@user_account')->name('user_account');
            Route::get('delete_contact_page/{id}','AdminController@delete_contact_page')->name('delete_contact_page');
            Route::get('update_contact_page/{id}','AdminController@update_contact_page')->name('update_contact_page');
            Route::post('contact_update/{id}','AdminController@contact_update')->name('contact_update');
            Route::get('delete_user_info/{id}','AdminController@delete_user_info')->name('delete_user_info');
            Route::get('update_user_info/{id}','AdminContro                                                                                                                                                                                                                    ller@update_user_info')->name('update_user_info');
            Route::post('update_premium_user_info','AdminController@update_premium_user_info')->name('update_premium_user_info');
            Route::post('update_admin_profile','AdminController@update_admin_profile')->name('update_admin_profile');
            Route::post('admin_profile_password_change','AdminController@admin_profile_password_change')->name('admin_profile_password_change');

        });
    // end of admin
});
