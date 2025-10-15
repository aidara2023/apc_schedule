<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

Route::apiResource('users', UserController::class);
Route::apiResource('roles', RoleController::class);


