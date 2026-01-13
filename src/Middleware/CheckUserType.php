<?php
namespace Shope\Core\Middleware;

use Closure;
use Illuminate\Http\Request;
use Shope\Core\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $type
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $type)
    {
        
        $userType = Auth::type();

        if(!$userType)
            return ResponseError("Unauthorized: User type not found", 401);

        if ($userType !== $type) {
            return ResponseError("Unauthorized: Only {$type} users are allowed", 403);
        }

        return $next($request);
    }
}
