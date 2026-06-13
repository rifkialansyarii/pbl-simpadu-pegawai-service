<?php

namespace App\Providers;

use App\Models\ClassSession;
use App\Models\User;
use Auth;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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

                $key = env('JWT_SECRET');

                JWT::$leeway = 60;
                $jwtTokenDecode = JWT::decode($jwtToken, new Key($key, 'HS256'));

                $user = new User();
                $user->id = $jwtTokenDecode->user_id;
                $user->detail_id = $jwtTokenDecode->detail_id;
                $user->role = $jwtTokenDecode->role_name;

                if ($user->role === 'mahasiswa') {
                    $user->class_id = $jwtTokenDecode->kelas_id;
                }

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

        Gate::define('manage-grades', function (User $user, string $classId) {

            $classSession = ClassSession::where('class_id', $classId)
                ->where('lecturer_id', $user->detail_id)
                ->exists();
            if (!$classSession) {
                return false;
            }

            return true;

        });
    }
}
