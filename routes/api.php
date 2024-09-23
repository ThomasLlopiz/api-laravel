<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\estudianteController;

Route::get('/estudiantes', [estudianteController::class, 'index']);

Route::get('/estudiantes/{id}', [estudianteController::class, 'show']);

Route::post('/estudiantes', [estudianteController::class, 'store']);

Route::delete('/estudiantes/{id}', [estudianteController::class, 'destroy']);

Route::put('/estudiantes/{id}', [estudianteController::class, 'update']);
Route::patch('/estudiantes/{id}', [estudianteController::class, 'updatePartial']);


