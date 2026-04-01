<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\MessageController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::post('/commission', [CommissionController::class, 'store']);
Route::post('/commission/{id}/accept', [CommissionController::class, 'accept']);
Route::post('/commission/{id}/pay', [CommissionController::class, 'pay']);
Route::post('/commission/{id}/complete', [CommissionController::class, 'complete']);


Route::post('/milestone', [MilestoneController::class, 'store']);
Route::post('/milestone/{id}/approve', [MilestoneController::class, 'approve']);
Route::post('/milestone/{id}/reject', [MilestoneController::class, 'reject']);

// MESSAGE
Route::post('/message', [MessageController::class, 'send']);
