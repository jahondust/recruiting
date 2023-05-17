<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(base_path('routes/groups/auth.php'));

Route::middleware('auth:api')->group(base_path('routes/groups/vacancy.php'));
Route::middleware('auth:api')->group(base_path('routes/groups/resume.php'));

Route::middleware('auth:api')
    ->prefix('admin')
    ->group(base_path('routes/groups/admin.php'));
