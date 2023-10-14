<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('dashboard', function (){
	return view('dashboard');
})->name('dashboard');
Route::resource('admin', \App\Http\Controllers\AdminController::class);
Route::resource('patient', \App\Http\Controllers\PatientController::class);
Route::resource('doctor', \App\Http\Controllers\DoctorController::class);
Route::resource('profession', \App\Http\Controllers\ProfessionController::class);
Route::resource('call_history', \App\Http\Controllers\CallHistoryController::class);
Route::resource('disease', \App\Http\Controllers\DiseaseController::class);
Route::resource('symptom', \App\Http\Controllers\SymptomController::class);
