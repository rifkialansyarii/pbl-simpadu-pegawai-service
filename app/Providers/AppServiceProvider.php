<?php

namespace App\Providers;

use App\Models\User;
use Auth;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
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

                if (!$jwtToken) {
                    return null;
                }

                try {
                    $key = env('JWT_SECRET');
                    $jwtTokenDecode = JWT::decode($jwtToken, new Key($key, 'HS256'));

                    $user = new User();
                    $user->id = $jwtTokenDecode->detail_id;
                    $user->role = $jwtTokenDecode->role_name;

                    if ($user->role === 'mahasiswa') {
                        $user->class_id = $jwtTokenDecode->class_id;
                    }

                    return $user;
                } catch (Exception $e) {
                    return null;
                }

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
