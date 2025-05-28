<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Cargar dotenv manualmente si APP_ENV=testing
$env = $_SERVER['APP_ENV'] ?? $_ENV['APP_ENV'] ?? null;

if ($env === 'testing') {
    if (file_exists(dirname(__DIR__) . '/.env.testing')) {
        Dotenv\Dotenv::createImmutable(dirname(__DIR__), '.env.testing')->safeLoad();
    }
} else {
    if (file_exists(dirname(__DIR__) . '/.env')) {
        Dotenv\Dotenv::createImmutable(dirname(__DIR__))->safeLoad();
    }
}

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
