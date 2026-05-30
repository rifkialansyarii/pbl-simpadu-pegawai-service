<?php

use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (ExpiredException $e, Request $request) {
            if ($request->is('api/*')) {

                $isDebug = config('app.debug');

                $response = [
                    'success' => false,
                    'code' => 401,
                    'message' => 'Token is expired',
                ];

                if ($isDebug) {
                    $response['errors'] = $e->getMessage();
                    $response['trace'] = $e->getTrace();
                }

                return response()->json($response, 401);
            }
        });
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (SignatureInvalidException $e, Request $request) {
            if ($request->is('api/*')) {

                $isDebug = config('app.debug');

                $response = [
                    'success' => false,
                    'code' => 401,
                    'message' => 'You are not logged in',
                ];

                if ($isDebug) {
                    $response['errors'] = $e->getMessage();
                    $response['trace'] = $e->getTrace();
                }

                return response()->json($response, 401);
            }
        });
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('api/*')) {

                $isDebug = config('app.debug');

                $response = [
                    'success' => false,
                    'code' => 401,
                    'message' => 'You are not logged in',
                ];

                if ($isDebug) {
                    $response['errors'] = $e->getMessage();
                    $response['trace'] = $e->getTrace();
                }

                return response()->json($response, 401);
            }
        });
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('*')) {

                $isDebug = config('app.debug');

                $response = [
                    'success' => false,
                    'code' => 404,
                    'message' => 'Resource not found',
                ];

                if ($isDebug) {
                    $response['errors'] = $e->getMessage();
                    $response['trace'] = $e->getTrace();
                }

                return response()->json($response, 404);
            }
        });
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (AccessDeniedHttpException $e, Request $request) {
            if ($request->is('api/*')) {

                $isDebug = config('app.debug');

                $response = [
                    'success' => false,
                    'code' => 403,
                    'message' => 'Forbidden',
                ];

                if ($isDebug) {
                    $response['errors'] = $e->getMessage();
                    $response['trace'] = $e->getTrace();
                }

                return response()->json($response, 403);
            }
        });
    })

    ->create();
