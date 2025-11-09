<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Contact\CreateContactController;
use App\Http\Controllers\Contact\DeleteContactController;
use App\Http\Controllers\Contact\GetAllContactsController;
use App\Http\Controllers\Contact\UpdateContactAvatarController;
use App\Http\Controllers\Contact\UpdateContactController;
use App\Http\Controllers\User\GetUserController;
use Illuminate\Support\Facades\Route;


Route::post('/login', LoginController::class);

Route::post('/logout', LoginController::class);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', GetUserController::class);
    Route::post('/contacts', CreateContactController::class);
    Route::get('/contacts', GetAllContactsController::class);
    Route::patch('/contacts/{id}/avatar', UpdateContactAvatarController::class);
    Route::patch('/contacts/{id}', UpdateContactController::class);
    Route::delete('/contacts/{id}', DeleteContactController::class);
});
