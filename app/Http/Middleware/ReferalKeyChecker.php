<?php

namespace App\Http\Middleware;

use App\Model\ReferalLinks;
use Closure;

class ReferalKeyChecker
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
        if($request->has('ref')){
            $data = ReferalLinks::where('referal_code',$request->get('ref'))->where('status',0)->first();
            if(empty($data)){
                return redirect('404');
            }
            session(['ref-user'=>$data['user_id']]);
            return $next($request);
        }
        return $next($request);
    }
}
