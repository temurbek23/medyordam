<?php

use Illuminate\Support\Facades\Route;

Route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect()->route("dashboard");
    }
    return view('login');
})->name('login');

Route::post('/sign-in', [\App\Http\Controllers\AuthController::class, 'login'])->name('sign');


Route::get('logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect()->route("login");
})->name("logout");


Route::resource('admin', \App\Http\Controllers\AdminController::class);
Route::resource('patient', \App\Http\Controllers\PatientController::class);
Route::resource('doctor', \App\Http\Controllers\DoctorController::class);
Route::resource('profession', \App\Http\Controllers\ProfessionController::class);
Route::resource('call_history', \App\Http\Controllers\CallHistoryController::class);
Route::resource('disease', \App\Http\Controllers\DiseaseController::class);
Route::resource('symptom', \App\Http\Controllers\SymptomController::class);
Route::resource('first_aid', \App\Http\Controllers\FirstAidController::class);
