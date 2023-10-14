<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('admin', \App\Http\Controllers\V1\AdminController::class);
Route::apiResource('admin', \App\Http\Controllers\API\V1\AdminController::class);
Route::apiResource('patient', \App\Http\Controllers\API\V1\PatientController::class);
Route::apiResource('doctor', \App\Http\Controllers\API\V1\DoctorController::class);
Route::apiResource('profession', \App\Http\Controllers\API\V1\ProfessionController::class);
Route::apiResource('call_history', \App\Http\Controllers\API\V1\CallHistoryController::class);
Route::apiResource('disease', \App\Http\Controllers\API\V1\DiseaseController::class);
Route::apiResource('symptom', \App\Http\Controllers\API\V1\SymptomController::class);
Route::apiResource('first_aid', \App\Http\Controllers\API\V1\FirstAidController::class);
