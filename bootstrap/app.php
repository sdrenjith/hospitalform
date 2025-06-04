<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminOnly;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\AddQueuedCookiesToResponse;
use App\Http\Middleware\StartSession;
use App\Http\Middleware\ShareErrorsFromSession;
use App\Http\Middleware\VerifyCsrfToken;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth' => Authenticate::class,
            'admin' => AdminOnly::class,
            // Add other middleware aliases as needed
        ]);
        // You can also add global and group middleware here if needed
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
