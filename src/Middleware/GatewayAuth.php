<?php

namespace Shope\Core\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Auth\AuthenticationException;

class GatewayAuth
{
    public function handle(Request $request, Closure $next)
    {

        if (config("shope-core.require_api_credentials") === false)
            return $next($request);

        $key = $request->header('x-api-key');
        $secret = $request->header('x-api-secret');
        $clientIp = $request->ip(); // Get request IP

        if (!$key || !$secret) {
            throw new AuthenticationException('Unauthorized. Missing key or secret.');
        }

        $cache_key = "api_key_{$key}";

        $apiKeyModel = config('shope-core.models.api_key');
        // dd($apiKeyModel);
        if (!class_exists($apiKeyModel)) {
            throw new \RuntimeException("Model class [$apiKeyModel] does not exist.");
        }

        $apiKey = Cache::rememberForever($cache_key, function () use ($key, $apiKeyModel) {
            return $apiKeyModel::select("id", "key", "secret", "whitelist")
                ->where('key', $key)
                ->where('is_active', 1)
                ->first();
        });

        $hashedInput = hash_hmac('sha256', $secret, config("shope-core.secret_pepper"));

        if (!$apiKey || $hashedInput !== $apiKey->secret) {
            throw new AuthenticationException('Unauthorized. Invalid key or secret.');
        }

        // Validate IP whitelist
        if (config("shope-core.enable_ip_whitelist") == true &&  !$apiKey->isIpAllowed($clientIp)) {
            throw new AuthenticationException('Forbidden. IP not allowed.');
        }

        return $next($request);
    }
}
