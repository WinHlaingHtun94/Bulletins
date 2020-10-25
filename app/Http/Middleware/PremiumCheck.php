<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class PremiumCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $request->id;
        $news_user_ID = DB::table('news')
                      -> where('id','=',$id)
                      -> select('user_id')
                      -> get();
        // dd($news_user_ID['0']->user_id);
        if(auth()->user()->isPremium == 1 || auth()->user()->id == $news_user_ID['0']->user_id || auth()->user()->isAdmin == 1){
            return $next($request);
        }else{
            return redirect()->route('user_homepage')->with('Premium_check','You are not Premium User');
        }
        
    }
}
