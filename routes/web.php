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
// Route::get('/home', [App\Http\Controllers\AdminHomeController::class, 'index'])->name('home');
Route::middleware('is_admin')->group(function () {
    Route::get('/admin-siswa/{siswa_guru_nilai}/{kelas_id}', [App\Http\Controllers\AdminSiswaController::class, 'index'])->name('admin-siswa');
    Route::get('/admin-siswa/sort', [App\Http\Controllers\AdminSiswaController::class, 'sort'])->name('admin-siswa.sort');
    Route::get('/admin-siswa/{siswa_guru_nilai}/{kelas_id}/add', [App\Http\Controllers\AdminSiswaController::class, 'addIndex'])->name('admin-siswa.add');
    Route::post('/admin-siswa/bulk-update', [App\Http\Controllers\AdminSiswaController::class, 'bulkUpdate'])->name('admin-siswa.bulkUpdate');
    Route::post('/admin-siswa/bulk-delete', [App\Http\Controllers\AdminSiswaController::class, 'bulkDelete'])->name('admin-siswa.bulkDelete');
    Route::post('/admin-siswa/addSiswa', [App\Http\Controllers\AdminSiswaController::class, 'addSiswa'])->name('admin-siswa.addSiswa');

    Route::get('/admin-kelas/list/{siswa_guru_nilai}', [App\Http\Controllers\AdminKelasController::class, 'indexList'])->name('admin-kelas.list');
    Route::get('/admin-mata-pelajaran/list/{siswa_guru_nilai}/{kelas_id}', [App\Http\Controllers\AdminMataPelajaranController::class, 'indexList'])->name('admin-mata-pelajaran.list');

    Route::get('/admin-guru/{siswa_guru_nilai}/{kelas_id}/{mata_pelajaran_id}', [App\Http\Controllers\AdminGuruController::class, 'index'])->name('admin-guru');
    Route::get('/admin-guru/sort', [App\Http\Controllers\AdminGuruController::class, 'sort'])->name('admin-guru.sort');
    Route::get('/admin-guru/{siswa_guru_nilai}/{kelas_id}/{mata_pelajaran_id}/add', [App\Http\Controllers\AdminGuruController::class, 'addIndex'])->name('admin-guru.add');
    Route::post('/admin-guru/bulk-update', [App\Http\Controllers\AdminGuruController::class, 'bulkUpdate'])->name('admin-guru.bulkUpdate');
    Route::post('/admin-guru/bulk-delete', [App\Http\Controllers\AdminGuruController::class, 'bulkDelete'])->name('admin-guru.bulkDelete');
    Route::post('/admin-guru/addGuru', [App\Http\Controllers\AdminGuruController::class, 'addGuru'])->name('admin-guru.addGuru');

    Route::get('/admin-nilai/{siswa_guru_nilai}/{kelas_id}/{mata_pelajaran_id}', [App\Http\Controllers\AdminSiswaNilaiController::class, 'index'])->name('admin-nilai');
    Route::get('/admin-nilai/sort', [App\Http\Controllers\AdminSiswaNilaiController::class, 'sort'])->name('admin-nilai.sort');
    Route::post('/admin-nilai/bulk-update', [App\Http\Controllers\AdminSiswaNilaiController::class, 'bulkUpdate'])->name('admin-nilai.bulkUpdate');
});

Route::middleware('is_guru')->group(function () {
    Route::get('/guru-pembelajaran', [App\Http\Controllers\GuruPembelajaranContoller::class, 'index'])->name('guru-pembelajaran');
    Route::post('/guru-pembelajaran/addPembelajaran', [App\Http\Controllers\GuruPembelajaranContoller::class, 'addGuruPembelajaran'])->name('guru-pembelajaran.add');
    Route::get('/guru-pembelajaran/{guru_pembelajaran_id}/detail', [App\Http\Controllers\GuruPembelajaranContoller::class, 'detailIndex'])->name('guru-pembelajaran.detail');

    Route::get('/guru-pembelajaran/{guru_pembelajaran_id}/detail/materi', [App\Http\Controllers\GuruPembelajaranContoller::class, 'materiAddIndex'])->name('guru-pembelajaran.materi');
    Route::post('/guru-pembelajaran/detail/addMateri', [App\Http\Controllers\GuruPembelajaranContoller::class, 'addMateri'])->name('guru-pembelajaran.addMateri');
    Route::post('/guru-pembelajaran/detail/deleteMateri', [App\Http\Controllers\GuruPembelajaranContoller::class, 'deleteMateri'])->name('guru-pembelajaran.deleteMateri');
    Route::post('/guru-pembelajaran/detail/updateMateri', [App\Http\Controllers\GuruPembelajaranContoller::class, 'updateMateri'])->name('guru-pembelajaran.updateMateri');
    Route::post('/guru-pembelajaran/detail/addKomentar', [App\Http\Controllers\GuruPembelajaranContoller::class, 'addKomentar'])->name('guru-pembelajaran.addKomentar');
    Route::get('/guru-pembelajaran/{guru_pembelajaran_id}/detail/materi-detail/{materi_id}', [App\Http\Controllers\GuruPembelajaranContoller::class, 'materiDetailIndex'])->name('guru-pembelajaran.materiDetail');


    


    Route::get('/guru-ujian', [App\Http\Controllers\GuruUjianController::class, 'index'])->name('guru-ujian');
    Route::get('/guru-ujian/add', [App\Http\Controllers\GuruUjianController::class, 'addIndex'])->name('guru-ujian.add');

    Route::get('/tentang-kita', [App\Http\Controllers\TentangKitaController::class, 'index'])->name('tentang-kita');
});


//OLD
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
