<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| These routes are loaded by the RouteServiceProvider
| and assigned the "api" middleware group.
|--------------------------------------------------------------------------
*/

Route::get('/hello', function () {
    return response()->json([
        'status' => true,
        'message' => 'Hello from Laravel API',
    ]);
});

/*
|--------------------------------------------------------------------------
| Example POST API
|--------------------------------------------------------------------------
*/

Route::post('/test', function (Request $request) {
    return response()->json([
        'received' => $request->all(),
    ]);
});
