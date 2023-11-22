<?php

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

Auth::routes();
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');
Route::get('/', [App\Http\Controllers\AdminHomeController::class, 'index'])->name('/');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin-siswa', [App\Http\Controllers\AdminSiswaController::class, 'index'])->name('admin-siswa');
Route::get('/admin-siswa/add', [App\Http\Controllers\AdminSiswaController::class, 'addIndex'])->name('admin-siswa.add');
Route::get('/admin-siswa/sort', [App\Http\Controllers\AdminSiswaController::class, 'sort'])->name('admin-siswa.sort');
Route::post('/admin-siswa/bulk-update', [App\Http\Controllers\AdminSiswaController::class, 'bulkUpdate'])->name('admin-siswa.bulkUpdate');
Route::post('/admin-siswa/bulk-delete', [App\Http\Controllers\AdminSiswaController::class, 'bulkDelete'])->name('admin-siswa.bulkDelete');

Route::get('/reservation', [App\Http\Controllers\ReservationController::class, 'index'])->name('reservation');
Route::get('/manager-reservation', [App\Http\Controllers\ManagerReservationController::class, 'index'])->name('manager-reservation');
Route::post('/manager-reservation/updateReservationStatus', [App\Http\Controllers\ManagerReservationController::class, 'updateReservationStatus'])->name('update-reservation-status');
Route::get('/manager-reservation/exportReservation', [App\Http\Controllers\ManagerReservationController::class, 'exportReservation'])->name('export-reservation');
Route::post('/manager-reservation/searchReservation', [App\Http\Controllers\ManagerReservationController::class, 'searchReservation'])->name('search-reservation');

Route::post('/reservation/insertPayment', [App\Http\Controllers\ReservationController::class, 'insertPayment'])->name('insert-payment');
Route::post('/reservation/updateTable', [App\Http\Controllers\ReservationController::class, 'updateTable'])->name('update-table');
Route::get('/reservation/getTableDetailData', [App\Http\Controllers\ReservationController::class, 'getTableDetailData'])->name('get-table-detail-data');
Route::get('/about-us', [App\Http\Controllers\AboutUsController::class, 'index'])->name('about-us');
Route::get('/coffee', [App\Http\Controllers\CoffeeController::class, 'index'])->name('coffee');
Route::get('/bakery', [App\Http\Controllers\BakeryController::class, 'index'])->name('bakery');
Route::get('/menu', [App\Http\Controllers\MenuController::class, 'index'])->name('menu');
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::post('/edit-profile', [App\Http\Controllers\ProfileController::class, 'editProfile'])->name('edit-profile');
