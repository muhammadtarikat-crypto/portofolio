<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

Route::view('/', 'home');

Route::get('/welcome', function (): View {
    $connectionName = config('database.default');
    $databaseName = config("database.connections.{$connectionName}.database");
    $isDatabaseConnected = false;

    try {
        DB::connection($connectionName)->getPdo();
        $isDatabaseConnected = true;
    } catch (PDOException $exception) {
        report($exception);
    }

    return view('welcome', [
        'databaseName' => $databaseName,
        'isDatabaseConnected' => $isDatabaseConnected,
        'laravelVersion' => app()->version(),
    ]);
})->name('welcome');
