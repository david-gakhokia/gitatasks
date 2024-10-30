<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });


Route::prefix('news')
    ->controller(NewsController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::get('create', 'create');
        Route::post('/', 'store');
        Route::get('{id}', 'show');
        Route::get('{id}/edit', 'edit');
        Route::put('{id}', 'update');
        Route::delete('{id}', 'destroy');
});
