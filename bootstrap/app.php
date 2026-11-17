<?php

use App\Http\Middleware\AdminrMiddleware;
use App\Http\Middleware\CountVisitor;
use App\Http\Middleware\SecurityHeaders;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
        $middleware->append(SecurityHeaders::class);
        $middleware->append(CountVisitor::class);
        $middleware->alias([
            'auth' => Authenticate::class,
            'CountVisitor' => CountVisitor::class,
            'admin' => AdminrMiddleware::class,
            // 'user' => UserMiddleware::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
