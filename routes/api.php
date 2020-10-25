<?php

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// show new api = http://localhost/Bulletin/public/api/show_news
Route::get('show_news',function(){
    $data = News::get();
    return Response::json($data);
});

//insert api = http://localhost/Bulletin/public/api/insert_news
Route::post('insert_news',function(Request $request){
    $insert_data = [
        'user_id'=> $request->user_id,
        'title' => $request->title,
        'photo' => $request->photo,
        'content' =>$request->content
    ];
    News::create($insert_data);
    return 'Insert Success!';
});

//update api =  http://localhost/Bulletin/public/api/update_news
Route::post('update_news',function(Request $request){
    $id = $request->id;
    $update_data = [
        'user_id' => $request->user_id,
        'title' => $request->title,
        'photo' => $request->photo,
        'content' =>$request->content
    ];
    News::findOrFail($id)->update($update_data);
    return 'Update Success';
});

//delete api = http://localhost/Bulletin/public/api/delete_news
Route::post('delete_news',function(Request $request){
    $id = $request->id;
    News::findOrFail($id)->delete();
    return 'Delete Success';
});