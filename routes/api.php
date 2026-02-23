<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\LibrarianController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\BrowseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckUser;
use Laravel\Sanctum\Sanctum;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);

Route::get('browse', [BrowseController::class, 'browse']);

// todo: add group controllers for middleware and prefix
Route::post('admin/book/add', [LibrarianController::class, 'add'])->middleware(['auth:sanctum', CheckAdmin::class]);
Route::post('admin/book/edit/{id}', [LibrarianController::class, 'edit'])->middleware(['auth:sanctum', CheckAdmin::class]);
Route::post('admin/book/delete/{id}', [LibrarianController::class, 'delete'])->middleware(['auth:sanctum', CheckAdmin::class]);


Route::post('review/add/', [UserController::class, 'add'])->middleware(['auth:sanctum', CheckUser::class]);
Route::post('review/edit/{id}', [UserController::class, 'edit'])->middleware(['auth:sanctum', CheckUser::class]);
Route::post('review/delete/{id}', [UserController::class, 'delete'])->middleware(['auth:sanctum', CheckUser::class]);

