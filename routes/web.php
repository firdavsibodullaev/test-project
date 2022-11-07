<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware("auth")->group(function () {
    Route::get("", [PostController::class, "index"])->name("index");
    Route::get("show/{post}", [PostController::class, "show"])->name("show");
    Route::get("edit/{post}", [PostController::class, "edit"])->name("edit");
    Route::put("{post}", [PostController::class, "update"])->name("update");
    Route::delete("{post}", [PostController::class, "destroy"])->name("delete");
});

Auth::routes();
