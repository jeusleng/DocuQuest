<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::get('/document-request/edit/{documentRequest}', [DocumentRequestController::class, 'edit'])->name('document-request.edit');
Route::put('/document-request/update/{documentRequest}', [DocumentRequestController::class, 'update'])->name('document-request.update');

Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// Route::get('/profile', 'ProfileController@index')->name('profile.index');
// Route::put('/profile/update', 'ProfileController@update')->name('profile.update');

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('auth:users', 'admin');
Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');

Route::get('/admin/pending', [AdminController::class, 'showPending'])->name('admin.pending');

Route::get('/admin/view-pending/{id}', [AdminController::class, 'editPending'])->name('admin.edit-pending');
Route::post('admin/edit-pending/{id}', [AdminController::class, 'updatePending'])->name('admin.update-pending');

Route::get('/admin/declined', [AdminController::class, 'showDeclined'])->name('admin.declined');

Route::get('/admin/approved', [AdminController::class, 'showApproved'])->name('admin.approved');
Route::get('/admin/completed-reqs', [AdminController::class, 'showCompletedReqs'])->name('admin.completed-reqs');

Route::post('/document-request/upload-receipt/{documentRequest}', [DocumentRequestController::class, 'uploadReceipt'])
    ->name('document-request.uploadReceipt');

Route::get('/admin/upcoming', [AdminController::class, 'showUpcoming'])->name('admin.upcoming');
Route::get('/admin/completed', [AdminController::class, 'showCompleted'])->name('admin.completed');

Route::get('/acknowledgment-receipt/{documentRequest}', [DocumentRequestController::class, 'viewAcknowledgmentReceipt'])->name('viewAcknowledgmentReceipt');
Route::get('/id-picture/{documentRequest}', [DocumentRequestController::class, 'viewIDPicture'])->name('viewIDPicture');

Route::get('/fetch-existing-appointments', [DocumentRequestController::class, 'fetchExistingAppointments'])->name('fetchExistingAppointments');

Route::get('/admin/display-users', [AdminController::class, 'displayUsers'])->name('admin.display-users');
Route::get('/admin/display-alumni', [AdminController::class, 'displayAlumni'])->name('admin.display-alumni');

Route::get('/admin/view-user{userId}', [AdminController::class, 'viewUser'])->name('admin.view-user');

Route::post('/admin/update-status/{userId}', [AdminController::class, 'updateStatus'])->name('admin.update-status');

Route::get('/admin/reports', [AdminController::class, 'generateReports'])->name('admin.reports');

Route::get('/get-existing-appointments', [AdminController::class, 'getExistingAppointments'])->name('getExistingAppointments');