<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Models\Web\Visitor as Visit;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Visitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role_id != '3') {
            $tipe = 'User';
        } else {
            $tipe = 'Visitor';
        }

        $agent = new Agent();

        $referal = request()->headers->get('referer');
        $ip_address = request()->ip();
        $url = url()->full();
        $date = date("Y-m-d");
        $os = $agent->platform();
        $device = $agent->device();
        $browser = $agent->browser();
        $country = 'kosong';
        $country_code = 'kosong';

        if ($visitors = Visit::whereDate('dt', now())->first()) {
            $visitors->count = $visitors->count + 1;
            $visitors->save();
        } else {
            $visitors = new Visit();
            $visitors->dt = now();
            $visitors->tipe = $tipe;
            $visitors->year = Carbon::now()->year;
            $visitors->month = Carbon::now()->month;
            $visitors->date = Carbon::now()->day;
            $visitors->day = Carbon::now()->dayOfWeek;
            $visitors->count = "1";
            $visitors->save();
        }

        return $next($request);
    }
}
