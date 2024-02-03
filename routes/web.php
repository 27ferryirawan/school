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
Route::get('/home', [App\Http\Controllers\AdminHomeController::class, 'index'])->name('home');
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
    Route::get('/guru-pembelajaran/{guru_pembelajaran_id}/detailSort', [App\Http\Controllers\GuruPembelajaranContoller::class, 'detailSortIndex'])->name('guru-pembelajaran.detailSortIndex');
    Route::get('/guru-pembelajaran/{guru_pembelajaran_id}/detailSortTugas', [App\Http\Controllers\GuruPembelajaranContoller::class, 'detailSortIndexTugas'])->name('guru-pembelajaran.detailSortIndexTugas');
    Route::get('/guru-pembelajaran/{guru_pembelajaran_id}/detailSortUjian', [App\Http\Controllers\GuruPembelajaranContoller::class, 'detailSortIndexUjian'])->name('guru-pembelajaran.detailSortIndexUjian');
    Route::get('/guru-pembelajaran/{guru_pembelajaran_id}/detailSortNilai', [App\Http\Controllers\GuruPembelajaranContoller::class, 'detailSortIndexNilai'])->name('guru-pembelajaran.detailSortIndexNilai');

    Route::get('/guru-pembelajaran/{guru_pembelajaran_id}/detail/materi', [App\Http\Controllers\GuruPembelajaranContoller::class, 'materiAddIndex'])->name('guru-pembelajaran.materi');
    Route::post('/guru-pembelajaran/detail/addMateri', [App\Http\Controllers\GuruPembelajaranContoller::class, 'addMateri'])->name('guru-pembelajaran.addMateri');
    Route::post('/guru-pembelajaran/detail/deleteMateri', [App\Http\Controllers\GuruPembelajaranContoller::class, 'deleteMateri'])->name('guru-pembelajaran.deleteMateri');
    Route::post('/guru-pembelajaran/detail/updateMateri', [App\Http\Controllers\GuruPembelajaranContoller::class, 'updateMateri'])->name('guru-pembelajaran.updateMateri');
    Route::post('/guru-pembelajaran/detail/addKomentar', [App\Http\Controllers\GuruPembelajaranContoller::class, 'addKomentar'])->name('guru-pembelajaran.addKomentar');
    Route::get('/guru-pembelajaran/{guru_pembelajaran_id}/detail/materi-detail/{materi_id}', [App\Http\Controllers\GuruPembelajaranContoller::class, 'materiDetailIndex'])->name('guru-pembelajaran.materiDetail');

    Route::get('/guru-pembelajaran/{guru_pembelajaran_id}/detail/tugas', [App\Http\Controllers\GuruPembelajaranContoller::class, 'tugasAddIndex'])->name('guru-pembelajaran.tugas');
    Route::post('/guru-pembelajaran/detail/addTugas', [App\Http\Controllers\GuruPembelajaranContoller::class, 'addTugas'])->name('guru-pembelajaran.addTugas');
    Route::get('/guru-pembelajaran/{guru_pembelajaran_id}/detail/tugas-detail/{tugas_id}', [App\Http\Controllers\GuruPembelajaranContoller::class, 'tugasDetailIndex'])->name('guru-pembelajaran.tugasDetail');
    Route::post('/guru-pembelajaran/detail/updateTugas', [App\Http\Controllers\GuruPembelajaranContoller::class, 'updateTugas'])->name('guru-pembelajaran.updateTugas');
    Route::post('/guru-pembelajaran/detail/deleteTugas', [App\Http\Controllers\GuruPembelajaranContoller::class, 'deleteTugas'])->name('guru-pembelajaran.deleteTugas');
    Route::get('/guru-pembelajaran/{guru_pembelajaran_id}/detail/tugas-detail/{tugas_id}/jawaban/{siswa_id}', [App\Http\Controllers\GuruPembelajaranContoller::class, 'tugasDetailIndexJawaban'])->name('guru-pembelajaran.tugasJawaban');
    Route::post('/guru-pembelajaran/detail/updateTugasNilai', [App\Http\Controllers\GuruPembelajaranContoller::class, 'updateTugasNilai'])->name('guru-pembelajaran.updateTugasNilai');
    Route::post('/guru-pembelajaran/detail/getNextPrevTugasJawaban', [App\Http\Controllers\GuruPembelajaranContoller::class, 'getNextPrevTugasJawaban'])->name('guru-pembelajaran.getNextPrevTugasJawaban');
    
    Route::post('/guru-pembelajaran/detail/addDiskusi', [App\Http\Controllers\GuruPembelajaranContoller::class, 'addDiskusi'])->name('guru-pembelajaran.addDiskusi');

    Route::get('/guru-pembelajaran/{guru_pembelajaran_id}/detail/ujian', [App\Http\Controllers\GuruPembelajaranContoller::class, 'ujianAddIndex'])->name('guru-pembelajaran.ujian');
    Route::post('/guru-pembelajaran/detail/addUjian', [App\Http\Controllers\GuruPembelajaranContoller::class, 'addUjian'])->name('guru-pembelajaran.addUjian');
    Route::get('/guru-pembelajaran/{guru_pembelajaran_id}/detail/ujian-detail/{ujian_id}', [App\Http\Controllers\GuruPembelajaranContoller::class, 'ujianDetailIndex'])->name('guru-pembelajaran.ujianDetail');
    Route::post('/guru-pembelajaran/detail/updateUjian', [App\Http\Controllers\GuruPembelajaranContoller::class, 'updateUjian'])->name('guru-pembelajaran.updateUjian');
    Route::get('/guru-pembelajaran/{guru_pembelajaran_id}/detail/ujian-detail/{ujian_id}/soal/', [App\Http\Controllers\GuruPembelajaranContoller::class, 'ujianAddIndexSoal'])->name('guru-pembelajaran.soalUjian');
    Route::post('/guru-pembelajaran/detail/addUjianSoal', [App\Http\Controllers\GuruPembelajaranContoller::class, 'addUjianSoal'])->name('guru-pembelajaran.addUjianSoal');
    Route::get('/guru-pembelajaran/{guru_pembelajaran_id}/detail/ujian-detail/{ujian_id}/soal/{soal_id}', [App\Http\Controllers\GuruPembelajaranContoller::class, 'ujianDetailIndexSoal'])->name('guru-pembelajaran.ujianDetailSoal');
    Route::post('/guru-pembelajaran/detail/updateUjianSoal', [App\Http\Controllers\GuruPembelajaranContoller::class, 'updateUjianSoal'])->name('guru-pembelajaran.updateUjianSoal');
    Route::post('/guru-pembelajaran/detail/deleteUjian', [App\Http\Controllers\GuruPembelajaranContoller::class, 'deleteUjian'])->name('guru-pembelajaran.deleteUjian');
    Route::post('/guru-pembelajaran/detail/deleteUjianSoal', [App\Http\Controllers\GuruPembelajaranContoller::class, 'deleteUjianSoal'])->name('guru-pembelajaran.deleteUjianSoal');
    Route::get('/guru-pembelajaran/{guru_pembelajaran_id}/detail/ujian-detail/{ujian_id}/ujian-jawaban/{siswa_id}', [App\Http\Controllers\GuruPembelajaranContoller::class, 'ujianDetailIndexJawaban'])->name('guru-pembelajaran.ujianJawaban');

    Route::get('/guru-pembelajaran/{guru_pembelajaran_id}/detail/ujian-detail/{ujian_id}/ujian-jawaban/{siswa_id}/soal/{soal_id}', [App\Http\Controllers\GuruPembelajaranContoller::class, 'ujianDetailIndexJawabanSiswa'])->name('guru-pembelajaran.ujianJawabanSiswa');
    Route::post('/guru-pembelajaran/detail/updateNilaiUjian', [App\Http\Controllers\GuruPembelajaranContoller::class, 'updateUjianNilai'])->name('guru-pembelajaran.updateUjianNilai');

    Route::get('/guru-siswa', [App\Http\Controllers\GuruSiswaController::class, 'index'])->name('guru-siswa');
    Route::get('/guru-siswa/sort', [App\Http\Controllers\GuruSiswaController::class, 'sort'])->name('guru-siswa.sort');
    Route::get('/guru-siswa/add', [App\Http\Controllers\GuruSiswaController::class, 'addIndex'])->name('guru-siswa.add');
    Route::post('/guru-siswa/bulk-update', [App\Http\Controllers\GuruSiswaController::class, 'bulkUpdate'])->name('guru-siswa.bulkUpdate');
    Route::post('/guru-siswa/bulk-delete', [App\Http\Controllers\GuruSiswaController::class, 'bulkDelete'])->name('guru-siswa.bulkDelete');
    Route::post('/guru-siswa/addSiswa', [App\Http\Controllers\GuruSiswaController::class, 'addSiswa'])->name('guru-siswa.addSiswa');

    Route::get('/guru-nilai', [App\Http\Controllers\GuruSiswaNilaiController::class, 'index'])->name('guru-nilai');
    Route::get('/guru-nilai/sort', [App\Http\Controllers\GuruSiswaNilaiController::class, 'sort'])->name('guru-nilai.sort');
    Route::post('/guru-pembelajaran/nilai-bulk-update', [App\Http\Controllers\GuruPembelajaranContoller::class, 'nilaiBulkUpdate'])->name('guru-pembelajaran.nilaiBulkUpdate');
    
    
});

Route::middleware('is_siswa')->group(function () {
    Route::get('/siswa-pembelajaran', [App\Http\Controllers\SiswaPembelajaranContoller::class, 'index'])->name('siswa-pembelajaran');    
    Route::get('/siswa-pembelajaran/{mata_pelajaran_id}/detail', [App\Http\Controllers\SiswaPembelajaranContoller::class, 'detailIndex'])->name('siswa-pembelajaran.detail');
    Route::get('/siswa-pembelajaran/{mata_pelajaran_id}/detailSort', [App\Http\Controllers\SiswaPembelajaranContoller::class, 'detailSortIndex'])->name('siswa-pembelajaran.detailSortIndex');
    Route::get('/siswa-pembelajaran/{mata_pelajaran_id}/detailSortTugas', [App\Http\Controllers\SiswaPembelajaranContoller::class, 'detailSortIndexTugas'])->name('siswa-pembelajaran.detailSortIndexTugas');
    Route::get('/siswa-pembelajaran/{mata_pelajaran_id}/detailSortUjian', [App\Http\Controllers\SiswaPembelajaranContoller::class, 'detailSortIndexUjian'])->name('siswa-pembelajaran.detailSortIndexUjian');
    Route::get('/siswa-pembelajaran/{mata_pelajaran_id}/detailSortNilai', [App\Http\Controllers\SiswaPembelajaranContoller::class, 'detailSortIndexNilai'])->name('siswa-pembelajaran.detailSortIndexNilai');

    Route::post('/siswa-pembelajaran/detail/addDiskusi', [App\Http\Controllers\SiswaPembelajaranContoller::class, 'addDiskusi'])->name('siswa-pembelajaran.addDiskusi');
    
    Route::get('/siswa-pembelajaran/{mata_pelajaran_id}/detail/materi-detail/{materi_id}', [App\Http\Controllers\SiswaPembelajaranContoller::class, 'materiDetailIndex'])->name('siswa-pembelajaran.materiDetail');
    Route::post('/siswa-pembelajaran/detail/addKomentar', [App\Http\Controllers\SiswaPembelajaranContoller::class, 'addKomentar'])->name('siswa-pembelajaran.addKomentar');

    Route::get('/siswa-pembelajaran/{mata_pelajaran_id}/detail/tugas-detail/{tugas_id}', [App\Http\Controllers\SiswaPembelajaranContoller::class, 'tugasDetailIndex'])->name('siswa-pembelajaran.tugasDetail');
    Route::post('/siswa-pembelajaran/detail/updateInsertTugasJawaban', [App\Http\Controllers\SiswaPembelajaranContoller::class, 'updateInsertTugasJawaban'])->name('siswa-pembelajaran.updateInsertTugasJawaban');
    Route::get('/siswa-pembelajaran/{mata_pelajaran_id}/detail/ujian-detail/{ujian_id}', [App\Http\Controllers\SiswaPembelajaranContoller::class, 'ujianDetailIndex'])->name('siswa-pembelajaran.ujianDetail');

    Route::get('/siswa-pembelajaran/{mata_pelajaran_id}/detail/ujian-detail/{ujian_id}/soal-list', [App\Http\Controllers\SiswaPembelajaranContoller::class, 'ujianDetailIndexList'])->name('siswa-pembelajaran.ujianDetailIndexList');

    Route::get('/siswa-pembelajaran/{mata_pelajaran_id}/detail/ujian-detail/{ujian_id}/soal-list/soal/{soal_id}', [App\Http\Controllers\SiswaPembelajaranContoller::class, 'ujianDetailIndexSoal'])->name('siswa-pembelajaran.ujianDetailSoal');

    Route::post('/siswa-pembelajaran/detail/updateInsertUjianJawaban', [App\Http\Controllers\SiswaPembelajaranContoller::class, 'updateUjianJawaban'])->name('siswa-pembelajaran.updateUjianJawaban');

    Route::post('/siswa-pembelajaran/detail/finishUjian', [App\Http\Controllers\SiswaPembelajaranContoller::class, 'updateFinishUjianJawaban'])->name('siswa-pembelajaran.updateFinishUjianJawaban');

    
});

Route::get('/tentang-kita', [App\Http\Controllers\TentangKitaController::class, 'index'])->name('tentang-kita');

Route::get('/guru_profile', [App\Http\Controllers\GuruProfileController::class, 'index'])->name('guru-profile');
Route::get('/siswa_profile', [App\Http\Controllers\SiswaProfileController::class, 'index'])->name('siswa-profile');
Route::get('/admin_profile', [App\Http\Controllers\AdminProfileController::class, 'index'])->name('admin-profile');
Route::post('/admin-edit-profile', [App\Http\Controllers\AdminProfileController::class, 'editProfile'])->name('admin-edit-profile');
Route::post('/siswa-edit-profile', [App\Http\Controllers\SiswaProfileController::class, 'editProfile'])->name('siswa-edit-profile');
Route::post('/guru-edit-profile', [App\Http\Controllers\GuruProfileController::class, 'editProfile'])->name('guru-edit-profile');
