<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;

Route::get('/', function () {
    return redirect()->route('registration');
});

Route::get('/registration',[FrontendController::class,'registration'])->name('registration');
Route::post('/registration',[FrontendController::class,'registrationProcess'])->name('registrationProcess');

Route::get('/search',[FrontendController::class,'search'])->name('search');
Route::post('/search',[FrontendController::class,'searchProcess'])->name('searchProcess');
