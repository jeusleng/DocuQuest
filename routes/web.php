<?php

namespace App\Http\Controllers;
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

//UNCOMMENT TO GENERATE ADMIN
// USERNAME - ADMIN, PASSWORD - ADMIN
// CAN CHANGE DEFAULT USERNAME AND PASSWORD ON USERCONTROLLER GENERATEADMIN FUNCTION
Route::get('/generate', [UserController::Class, 'generateAdmin']);

Route::get('/', [UserController::Class, 'goLogin']);

Route::get('/registration', [UserController::Class, 'goRegistration']);

Route::post('/login', [UserController::Class, 'Login']);

Route::post('/register', [UserController::Class, 'Register']);

Route::get('/logout', [UserController::Class, 'Logout']);

Route::get('/home', [HomeController::Class, 'GetHome']);

Route::get('/insert-documents', [DocumentController::Class, 'insertDocuments']);

Route::get('/document-request', [DocumentRequestController::class, 'showRequestForm']);
Route::post('/document-request/store', [DocumentRequestController::class, 'storeRequest'])->name('document-request.store');

Route::get('/document-request/history', [DocumentRequestController::class, 'showRequestHistory'])->name('document-request.history');

Route::delete('/document-request/cancel/{documentRequest}', [DocumentRequestController::class, 'cancelRequest'])
    ->name('document-request.cancel');

