<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/notifikasi', function () {
    return view('notifikasi');
});

Route::get('/news', 'BlogController@index')->name('list.blog');
Route::get('/news/cari', 'BlogController@cari')->name('cari.blog');
Route::get('/news/{slug}', 'BlogController@show')->name('show.blog');
Route::get('/news/categories/{category:slug}', 'BlogController@showByCategory')->name('showByCategory.blog');


Route::get('/pollings', 'PollingController@index')->name('polling.list');
Route::get('/pollings/cari', 'PollingController@cari')->name('polling.cari');
Route::get('/polling/{polling:slug}/show', 'PollingController@show')->name('polling.show');

Route::get('/option/{id}', 'SurveiController@getOptions')->name('list.options');
Route::get('/option/{id}/answers', 'SurveiController@getOptionsAnswers')->name('answers.options');

Route::get('/survei/{polling:slug}/statistic', 'SurveiController@statistic')->name('survei.statistic');
Route::get('/survei/{slug}/successed', 'SurveiController@success')->name('survei.sukses');
Route::get('/survei/{slug}', 'SurveiController@index')->name('survei.show');
Route::post('/survei/{polling:slug}/save', 'SurveiController@store')->name('survei.store');

Route::get('/thankyou', 'GuestController@thankyou')->name('thankyou');

Route::get('/registerlomba', function () {
    return view('registerlomba');
});
Route::get('/lomba', function () {
    return view('lomba');
});
Route::get('/lombadetail', function () {
    return view('lombadetail');
});
Route::get('/', 'GuestController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profil', 'HomeController@profile')->name('users.profile');
Route::post('/profil/update/masyarakat', 'HomeController@updateProfile')->name('users.updateProfile');
Route::post('/profil/update/opd', 'HomeController@updateOPDProfile')->name('users.updateOPDProfile');
Route::post('/profil/update', 'HomeController@updateSuperProfile')->name('users.updateSuperProfile');

Route::get('/pengaturan', 'HomeController@settings')->name('users.settings');
Route::post('/pengaturan/update', 'HomeController@updateSettings')->name('users.updateSettings');


Route::post('get-data-keg-prg', 'HomeController@getDataKegPrg');

/**
 * Lomba
 */
Route::get('/lomba', 'GuestController@listLomba')->name('list.lomba');
Route::get('/lomba/{id}/detail', 'GuestController@detailLomba')->name('detail.lomba');
Route::get('/lomba/{id}/download', 'GuestController@downloadMekanisme')->name('download.mekanisme');
Route::get('/lomba/{id}/registrasi', 'HomeController@registrasiLomba')->name('registrasi.lomba');
Route::post('/lomba/{id}/register', 'HomeController@registerLomba')->name('register.lomba');

/**
 * FAQ, Pengaduan, Dokumen,
 * Lomba, Penelitian
 */
Route::get('/faq', 'GuestController@listFaq');
Route::get('/pengaduan', 'GuestController@listPengaduan');
Route::get('/dokumen', 'GuestController@listDokumen');
Route::get('/dokumen/{id}/download', 'GuestController@downloadDokumen')->name('download.dokumen');
Route::get('/penelitian', 'GuestController@listPenelitian');
Route::get('/penelitian/{id}/download', 'GuestController@downloadPenelitian')->name('download.penelitian');
Route::get('/inovasi', 'GuestController@listInovasi');
Route::post('/pengaduan/post', 'GuestController@postPengaduan')->name('post.pengaduan');

/**
 * Route Super Admin
 */
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('role:super admin')->group(function () {

    /**
     * CRUD User
     */
    Route::get('/user', 'UserController@index')->name('users');
    Route::post('/user/{id}/update', 'UserController@update')->name('update.user');
    Route::post('/user/create', 'UserController@store')->name('create.user');
    Route::get('/user/{id}/delete', 'UserController@destroy')->name('delete.user');
    Route::get('/profile', 'UserController@profile')->name('profile');

    /**
     * CRUD Account
     * 
     */
    Route::get('/account', 'AccountController@index')->name('list.account');
    Route::post('/account/{id}/update', 'AccountController@update')->name('update.account');
    Route::post('/account/create', 'AccountController@store')->name('create.account');
    Route::get('/account/{id}/delete', 'AccountController@destroy')->name('delete.account');
    Route::post('/account/import', 'AccountController@import')->name('import.account');


    /**
     * CRUD POST
     */
    Route::get('/posts', 'PostController@index')->name('list.posts');
    Route::get('/posts/{id}/edit', 'PostController@edit')->name('edit.post');
    Route::post('/posts/{id}/update', 'PostController@update')->name('update.post');
    Route::get('/posts/{id}/delete', 'PostController@destroy')->name('delete.post');
    Route::get('/posts/create', 'PostController@create')->name('create.post');
    Route::post('/posts/store', 'PostController@store')->name('store.post');

    /**
     * CRUD Categories
     */
    Route::get('/categories', 'CategoryController@index')->name('list.category');
    Route::post('/categories/create', 'CategoryController@store')->name('create.category');
    Route::get('/categories/getpostcategory/{id}', 'CategoryController@getPostCategory')->name('getPostCategory');
    Route::get('/categories/edit/{category:slug}', 'CategoryController@edit')->name('edit.category');
    Route::post('/categories/edit/{category:id}', 'CategoryController@update')->name('update.category');
    Route::get('/categories/delete/{category:id}', 'CategoryController@destroy')->name('delete.category');

    /**
     * CRUD POLLING
     */
    Route::get('/polling', 'PollingController@index')->name('list.polling');
    Route::get('/option/{id}', 'PollingController@getOptions')->name('list.options');
    Route::get('/option/{id}/answers', 'PollingController@getOptionsAnswers')->name('answers.options');
    Route::get('/polling/create', 'PollingController@create')->name('polling.create');
    Route::post('/polling/create', 'PollingController@store')->name('polling.store');
    Route::get('/polling/{slug}/statistic', 'PollingController@statistics')->name('polling.statistics');
    Route::get('/polling/{slug}/export', 'PollingController@export')->name('polling.reponse.export');
    Route::get('/polling/{polling:slug}/edit', 'PollingController@edit')->name('polling.edit');
    Route::post('/polling/{polling:slug}/update', 'PollingController@update')->name('polling.update');
    Route::get('/polling/{polling:slug}/delete', 'PollingController@destroy')->name('polling.delete');

    /**
     * CRUD QUESTION
     */
    Route::post('/question/create', 'QuestionController@create')->name('question.create');
    Route::post('/question/{id}/update', 'QuestionController@edit')->name('question.edit');
    Route::get('/question/{id}/destroy', 'QuestionController@destroy')->name('question.destroy');
    Route::post('/questionoption/{id}/update', 'QuestionController@updateOption')->name('question.update.option');
    Route::get('/questionoption/{id}/delete', 'QuestionController@destroyOption')->name('question.delete.option');
    // Route::post('/polling/create', 'PollingController@store')->name('polling.store');
    // Route::get('/polling/{polling:slug}/edit', 'PollingController@edit')->name('polling.edit');
    // Route::post('/polling/{polling:slug}/update', 'PollingController@update')->name('polling.update');
    // Route::get('/polling/{polling:slug}/delete', 'PollingController@destroy')->name('polling.delete');

    /**
     * CRUD OPD
     */
    Route::get('/opd', 'OpdController@index')->name('list.opd');
    Route::post('/opd/{id}/update', 'OpdController@update')->name('update.opd');
    Route::post('/opd/create', 'OpdController@store')->name('create.opd');
    Route::get('/opd/{id}/delete', 'OpdController@destroy')->name('delete.opd');
    Route::get('/opd/sync', 'OpdController@sync')->name('sync.opd');

    /**
     * CRUD FAQ
     */
    Route::get('/faq', 'FAQController@index')->name('list.faq');
    Route::get('/faq/create', 'FAQController@create')->name('create.faq');
    Route::post('/faq/store', 'FAQController@store')->name('store.faq');
    Route::get('/faq/{id}/edit', 'FAQController@edit')->name('edit.faq');
    Route::post('/faq/{id}/update', 'FAQController@update')->name('update.faq');
    Route::get('/faq/{id}/destroy', 'FAQController@destroy')->name('delete.faq');

    /**
     * CRUD Role & Permission
     */
    Route::get('/role', 'UserController@listRole')->name('list.role');
    Route::post('/role/create', 'UserController@createRole')->name('create.role');
    Route::get('/role/{id}/edit', 'UserController@editRole')->name('edit.role');
    Route::post('/role/{id}/update', 'UserController@updateRole')->name('update.role');
    Route::get('/role/{id}/delete', 'UserController@deleteRole')->name('delete.role');

    Route::get('/permission', 'UserController@listPermission')->name('list.permission');
    Route::post('/permission/create', 'UserController@createPermission')->name('create.permission');
    Route::post('/permission/{id}/update', 'UserController@updatePermission')->name('update.permission');
    Route::get('/permission/{id}/delete', 'UserController@deletePermission')->name('delete.permission');

    /**
     * CRUD Inovasi
     */
    Route::get('/inovasi', 'InovasiController@index')->name('list.inovasi');
    Route::get('/inovasi/create', 'InovasiController@create')->name('create.inovasi');
    Route::post('/inovasi/store', 'InovasiController@store')->name('store.inovasi');
    Route::get('/inovasi/{id}/edit', 'InovasiController@edit')->name('edit.inovasi');
    Route::post('/inovasi/{id}/update', 'InovasiController@update')->name('update.inovasi');
    Route::get('/inovasi/{id}/delete', 'InovasiController@destroy')->name('delete.inovasi');
    Route::post('/inovasi/{id}/reward', 'InovasiController@reward')->name('reward.inovasi');
    Route::get('/inovasi/{id}/delete/reward', 'InovasiController@deleteReward')->name('delete.reward.inovasi');
    Route::get('/inovasi/{id}/indikator', 'InovasiController@listIndikator')->name('edit.indikator.inovasi');
    Route::post('/inovasi/{id_inovasi}/indikator/{id_indikator}', 'InovasiController@updateIndikator')->name('update.indikator.inovasi');
    Route::post('/inovasi/upload/dokumen/{id_inovasi}/indikator/{id_indikator}', 'InovasiController@uploadDokumenIndikator')->name('upload.dokumen.indikator.inovasi');
    Route::get('/inovasi/filedokumen/{id}/download', 'InovasiController@download')->name('download.file.indikator');
    Route::get('/inovasi/filedokumen/{id}/delete', 'InovasiController@delete')->name('delete.file.indikator');
    Route::get('/inovasi/export', 'InovasiController@export')->name('export.inovasi');
    Route::get('/inovasi/{id}/download/pdf', 'InovasiController@downloadPDF')->name('download.pdf');
    Route::get('/inovasi/{id}/download/excel', 'InovasiController@downloadXLS')->name('download.xls');

    /**
     * CRUD Penelitian
     */
    Route::get('/penelitian', 'PenelitianController@index')->name('list.penelitian');
    Route::get('/penelitian/create', 'PenelitianController@create')->name('create.penelitian');
    Route::post('/penelitian/store', 'PenelitianController@store')->name('store.penelitian');
    Route::get('/penelitian/{id}/edit', 'PenelitianController@edit')->name('edit.penelitian');
    Route::post('/penelitian/{id}/update', 'PenelitianController@update')->name('update.penelitian');
    Route::get('/penelitian/{id}/delete', 'PenelitianController@destroy')->name('delete.penelitian');
    Route::get('/penelitian/{id}/download', 'PenelitianController@download')->name('download.penelitian');

    /**
     * CRUD KKN
     */
    Route::get('/kkn', 'KknController@index')->name('list.kkn');
    Route::get('/kkn/create', 'KknController@create')->name('create.kkn');
    Route::post('/kkn/store', 'KknController@store')->name('store.kkn');
    Route::get('/kkn/{id}/edit', 'KknController@edit')->name('edit.kkn');
    Route::post('/kkn/{id}/update', 'KknController@update')->name('update.kkn');
    Route::get('/kkn/{id}/delete', 'KknController@destroy')->name('delete.kkn');

    /**
     * CRUD Indikator
     */
    Route::get('/indikator', 'IndikatorController@index')->name('list.indikator');
    Route::get('/indikator/create', 'IndikatorController@create')->name('create.indikator');
    Route::post('/indikator/store', 'IndikatorController@store')->name('store.indikator');
    Route::get('/indikator/{id}/edit', 'IndikatorController@edit')->name('edit.indikator');
    Route::post('/indikator/{id}/update', 'IndikatorController@update')->name('update.indikator');
    Route::get('/indikator/{id}/delete', 'IndikatorController@destroy')->name('delete.indikator');

    Route::post('/indikator/{id}/store/nilai', 'IndikatorController@storeNilai')->name('store.nilai.indikator');
    Route::post('/indikator/{id}/update/nilai', 'IndikatorController@updateNilai')->name('update.nilai.indikator');
    Route::get('/indikator/{id}/delete/nilai', 'IndikatorController@deleteNilai')->name('delete.nilai.indikator');

    Route::get('/kkn/{id}/download', 'KknController@download')->name('download.kkn');

    /**
     * CRUD Jenis Dokumen
     */
    Route::get('/jenis/dokumen', 'JenisDokumenController@index')->name('list.jenisdokumen');
    Route::post('/jenis/dokumen/store', 'JenisDokumenController@store')->name('store.jenisdokumen');
    Route::post('/jenis/dokumen/{id}/update', 'JenisDokumenController@update')->name('update.jenisdokumen');
    Route::get('/jenis/dokumen/{id}/destroy', 'JenisDokumenController@destroy')->name('delete.jenisdokumen');

    /**
     * CRUD Dokumen
     */
    Route::get('/dokumen', 'DokumenController@index')->name('list.dokumen');
    Route::get('/dokumen/create', 'DokumenController@create')->name('create.dokumen');
    Route::post('/dokumen/store', 'DokumenController@store')->name('store.dokumen');
    Route::get('/dokumen/{id}/edit', 'DokumenController@edit')->name('edit.dokumen');
    Route::post('/dokumen/{id}/update', 'DokumenController@update')->name('update.dokumen');
    Route::get('/dokumen/{id}/destroy', 'DokumenController@destroy')->name('delete.dokumen');
    Route::get('/dokumen/{id}/download', 'DokumenController@download')->name('download.dokumen');

    /**
     * CRUD API Token
     */
    Route::get('/tokenapi', 'ApiTokenController@index')->name('list.apitoken');
    Route::post('/tokenapi/store', 'ApiTokenController@store')->name('store.apitoken');
    Route::post('/tokenapi/{id}/update', 'ApiTokenController@update')->name('update.apitoken');
    Route::get('/tokenapi/{id}/destroy', 'ApiTokenController@destroy')->name('delete.apitoken');

    /**
     * CRUD Pengaduan
     */
    Route::get('/pengaduan', 'PengaduanController@index')->name('list.pengaduan');
    Route::post('/pengaduan/new', 'PengaduanController@new')->name('new.pengaduan');
    Route::get('/pengaduan/{id}/respons', 'PengaduanController@show')->name('show.pengaduan');
    Route::post('/pengaduan/{id}/post', 'PengaduanController@store')->name('store.pengaduan');
    Route::post('/pengaduan/{id}/update', 'PengaduanController@update')->name('update.pengaduan');
    Route::get('/pengaduan/{id}/destroy', 'PengaduanController@destroy')->name('destroy.pengaduan');
    Route::get('/pengaduan/{id}/delete', 'PengaduanController@delete')->name('delete.respon');

    /**
     * CRUD Sumber Dana
     */
    Route::get('/sumberdana', 'SumberDanaController@index')->name('list.sumberdana');
    Route::get('/sumberdana/sync', 'SumberDanaController@sync')->name('sync.sumberdana');
    Route::post('/sumberdana/{id}/update', 'SumberDanaController@update')->name('update.sumberdana');
    Route::get('/sumberdana/{id}/destroy', 'SumberDanaController@destroy')->name('delete.sumberdana');

    /**
     * CRUD Jenis Lomba
     */
    Route::get('/jenislomba', 'JenisLombaController@index')->name('list.jenislomba');
    Route::post('/jenislomba/store', 'JenisLombaController@store')->name('store.jenislomba');
    Route::post('/jenislomba/{id}/update', 'JenisLombaController@update')->name('update.jenislomba');
    Route::get('/jenislomba/{id}/destroy', 'JenisLombaController@destroy')->name('delete.jenislomba');

    /**
     * CRUD Lomba
     */
    Route::get('/lomba', 'LombaController@index')->name('list.lomba');
    Route::get('/lomba/create', 'LombaController@create')->name('create.lomba');
    Route::post('/lomba/store', 'LombaController@store')->name('store.lomba');
    Route::get('/lomba/{id}/edit', 'LombaController@edit')->name('edit.lomba');
    Route::get('/lomba/{id}/show', 'LombaController@show')->name('show.lomba');
    Route::post('/lomba/{id}/update', 'LombaController@update')->name('update.lomba');
    Route::get('/lomba/{id}/destroy', 'LombaController@destroy')->name('delete.lomba');
    Route::get('/lomba/{id}/delete', 'LombaController@deletePeserta')->name('delete.peserta.lomba');
    Route::get('/dokumen/lomba/{id}/download', 'LombaController@downloadDokumenPeserta')->name('download.dokumen.peserta');
    Route::get('/lomba/{id}/peserta/{peserta_id}/detail', 'LombaController@detailPeserta')->name('detail.peserta.lomba');
    /**
     * CRUD Persyaratan Lomba
     */
    Route::post('/lomba/{id}/post/persyaratan', 'PersyaratanLombaController@add')->name('add.persyaratan.lomba');
    Route::get('/persyaratan/{id}/delete', 'PersyaratanLombaController@delete')->name('delete.persyaratan.lomba');

    /**
     * CRUD Pemenang Lomba
     */
    Route::post('/lomba/{id}/post/winner', 'PemenangLombaController@postWinner')->name('post.winner');
    Route::get('/pemenanglomba/{id}/delete', 'PemenangLombaController@delete')->name('delete.winner');
});

/**
 * Route Admin OPD
 */
Route::namespace('Opd')->prefix('opd')->name('opd.')->middleware('role:admin opd')->group(function () {


    /**
     * CRUD User
     */
    Route::get('/user', 'UserController@index')->name('users');
    Route::post('/user/{id}/update', 'UserController@update')->name('update.user');
    Route::post('/user/create', 'UserController@store')->name('create.user');
    Route::get('/user/{id}/delete', 'UserController@destroy')->name('delete.user');
    Route::get('/profile', 'UserController@profile')->name('profile');

    /**
     * CRUD Account
     * 
     */
    Route::get('/account', 'AccountController@index')->name('list.account');
    Route::post('/account/{id}/update', 'AccountController@update')->name('update.account');
    Route::post('/account/create', 'AccountController@store')->name('create.account');
    Route::get('/account/{id}/delete', 'AccountController@destroy')->name('delete.account');


    /**
     * CRUD OPD
     */
    Route::get('/opd', 'OpdController@index')->name('list.opd');
    Route::post('/opd/{id}/update', 'OpdController@update')->name('update.opd');
    Route::post('/opd/create', 'OpdController@store')->name('create.opd');
    Route::get('/opd/{id}/delete', 'OpdController@destroy')->name('delete.opd');

    /**
     * CRUD Inovasi
     */
    Route::get('/inovasi', 'InovasiController@index')->name('list.inovasi');
    Route::get('/inovasi/create', 'InovasiController@create')->name('create.inovasi');
    Route::post('/inovasi/store', 'InovasiController@store')->name('store.inovasi');
    Route::get('/inovasi/{id}/edit', 'InovasiController@edit')->name('edit.inovasi');
    Route::post('/inovasi/{id}/update', 'InovasiController@update')->name('update.inovasi');
    Route::get('/inovasi/{id}/delete', 'InovasiController@delete')->name('delete.inovasi');
    Route::get('/inovasi/{id}/indikator', 'InovasiController@listIndikator')->name('edit.indikator.inovasi');
    Route::post('/inovasi/{id_inovasi}/indikator/{id_indikator}', 'InovasiController@updateIndikator')->name('update.indikator.inovasi');
    Route::post('/inovasi/upload/dokumen/{id_inovasi}/indikator/{id_indikator}', 'InovasiController@uploadDokumenIndikator')->name('upload.dokumen.indikator.inovasi');


    /**
     * CRUD Penelitian
     */
    Route::get('/penelitian', 'PenelitianController@index')->name('list.penelitian');
    Route::get('/penelitian/create', 'PenelitianController@create')->name('create.penelitian');
    Route::post('/penelitian/store', 'PenelitianController@store')->name('store.penelitian');
    Route::get('/penelitian/{id}/edit', 'PenelitianController@edit')->name('edit.penelitian');
    Route::post('/penelitian/{id}/update', 'PenelitianController@update')->name('update.penelitian');
    Route::get('/penelitian/{id}/delete', 'PenelitianController@destroy')->name('delete.penelitian');
    Route::get('/penelitian/{id}/download', 'PenelitianController@download')->name('download.penelitian');

    /**
     * CRUD KKN
     */
    Route::get('/kkn', 'KknController@index')->name('list.kkn');
    Route::get('/kkn/create', 'KknController@create')->name('create.kkn');
    Route::post('/kkn/store', 'KknController@store')->name('store.kkn');
    Route::get('/kkn/{id}/edit', 'KknController@edit')->name('edit.kkn');
    Route::post('/kkn/{id}/update', 'KknController@update')->name('update.kkn');
    Route::get('/kkn/{id}/delete', 'KknController@destroy')->name('delete.kkn');
    Route::get('/kkn/{id}/download', 'KknController@download')->name('download.kkn');
});

/**
 * Route Masyarakat
 */
Route::namespace('Guest')->prefix('guest')->name('guest.')->middleware('role:masyarakat')->group(function () {


    /**
     * CRUD User
     */
    Route::get('/user', 'UserController@index')->name('users');
    Route::post('/user/{id}/update', 'UserController@update')->name('update.user');
    Route::post('/user/create', 'UserController@store')->name('create.user');
    Route::get('/user/{id}/delete', 'UserController@destroy')->name('delete.user');
    Route::get('/profile', 'UserController@profile')->name('profile');

    /**
     * CRUD Inovasi
     */
    Route::get('/inovasi', 'InovasiController@index')->name('list.inovasi');
    Route::get('/inovasi/create', 'InovasiController@create')->name('create.inovasi');
    Route::post('/inovasi/store', 'InovasiController@store')->name('store.inovasi');
    Route::get('/inovasi/{id}/edit', 'InovasiController@edit')->name('edit.inovasi');
    Route::post('/inovasi/{id}/update', 'InovasiController@update')->name('update.inovasi');
    Route::get('/inovasi/{id}/delete', 'InovasiController@destroy')->name('delete.inovasi');
    Route::get('/inovasi/{id}/indikator', 'InovasiController@listIndikator')->name('edit.indikator.inovasi');
    Route::post('/inovasi/{id_inovasi}/indikator/{id_indikator}', 'InovasiController@updateIndikator')->name('update.indikator.inovasi');
    Route::post('/inovasi/upload/dokumen/{id_inovasi}/indikator/{id_indikator}', 'InovasiController@uploadDokumenIndikator')->name('upload.dokumen.indikator.inovasi');


    /**
     * CRUD Penelitian
     */
    Route::get('/penelitian', 'PenelitianController@index')->name('list.penelitian');
    Route::get('/penelitian/create', 'PenelitianController@create')->name('create.penelitian');
    Route::post('/penelitian/store', 'PenelitianController@store')->name('store.penelitian');
    Route::get('/penelitian/{id}/edit', 'PenelitianController@edit')->name('edit.penelitian');
    Route::post('/penelitian/{id}/update', 'PenelitianController@update')->name('update.penelitian');
    Route::get('/penelitian/{id}/delete', 'PenelitianController@destroy')->name('delete.penelitian');
    Route::get('/penelitian/{id}/download', 'PenelitianController@download')->name('download.penelitian');

    /**
     * CRUD KKN
     */
    Route::get('/kkn', 'KknController@index')->name('list.kkn');
    Route::get('/kkn/create', 'KknController@create')->name('create.kkn');
    Route::post('/kkn/store', 'KknController@store')->name('store.kkn');
    Route::get('/kkn/{id}/edit', 'KknController@edit')->name('edit.kkn');
    Route::post('/kkn/{id}/update', 'KknController@update')->name('update.kkn');
    Route::get('/kkn/{id}/delete', 'KknController@destroy')->name('delete.kkn');
    Route::get('/kkn/{id}/download', 'KknController@download')->name('download.kkn');

    /**
     * Lomba
     */
    Route::get('/lomba', 'LombaController@index')->name('list.lomba');
    Route::get('/lomba/riwayat', 'LombaController@riwayat')->name('riwayat.lomba');
    Route::get('/lomba/{id}/detail', 'LombaController@detail')->name('detail.lomba');
    Route::get('/dokumen/lomba/{id}/download', 'LombaController@downloadDokumenPeserta')->name('download.dokumen.peserta');
    Route::post('/lomba/{id}/update', 'LombaController@update')->name('update.data.lomba');
});
