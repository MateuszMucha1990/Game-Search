<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RequestLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   //kod przed
        $currentDate= Carbon::now();
        $timeStart = microtime(true);

        Log::info('------------' );
        Log::info($currentDate. ' :BEFORE: ' . $timeStart );

        $response = $next($request);

        //kod po
        $timeEnd = microtime(true);


        Log::info($currentDate. ' :AFTER: ' . $timeEnd );
        Log::info($currentDate. ' :RESULT: ' . ($timeEnd - $timeStart) );

        return $response;
    }
}
