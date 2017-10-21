<?php

namespace Modules\Api\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Api\Traits\ApiResponse;

class isAdmin
{

    use ApiResponse;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($header = $request->header('X-Auth-Key')) {
            if ($header == 'Zioj23D92j2kGf9D') {
                return $next($request);
            }
        }
        $message = 'Restricted route';
        return $this->unauthorized($message);
    }
}
