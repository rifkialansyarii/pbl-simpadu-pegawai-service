<?php

namespace App\Providers;

use App\Models\User;
use Auth;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    private function customAuthJwt()
    {
        Auth::viaRequest(
            'custom-auth-jwt',
            function (Request $request) {
                $jwtToken = $request->bearerToken();
                $key = env('JWT_SECRET');
                

                $jwtTokenDecode = JWT::decode($jwtToken, new Key($key, 'HS256'));

                $user = new User();
                $user->id = $jwtTokenDecode->id;
                $user->role = $jwtTokenDecode->role;

                return $user;
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->customAuthJwt();
    }
}
