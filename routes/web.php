<?php

use App\Notifications\NotifAlert;
use Illuminate\Support\Facades\Route;

use App\Notifications\NotifTest;
use App\User;

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

Route::middleware(['auth'])->group(function(){
    Route::get('/', 'HomeController@dashboardUser')->name('dashboard.user');
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::post('/profile/update/{id}', 'ProfileController@update')->name('profile.update');
    Route::resource('department', 'DepartmentController');
    Route::resource('pegawai', 'PegawaiController');
    Route::resource('head-department', 'HeadDepartmentController');
    Route::resource('barang', 'MtBarangController');
    Route::resource('users', 'UserController');
    Route::get('/peminjaman', 'PeminjamanController@create')->name('pinjam.create');
    Route::post('/pinjam/create', 'PeminjamanController@store')->name('pinjam.store');
    Route::get('/list-peminjaman', 'PeminjamanController@listAdmin')->name('list.peminjaman');
    Route::get('/peminjaman-approve/{id}', 'PeminjamanController@acc')->name('pinjam.acc');
    Route::get('/peminjaman-selesai/{id}', 'PeminjamanController@approve')->name('pinjam.approve');
});

Auth::routes();

// Route::get('/mail', function(){
//     $user = User::find(1);
//     $user->notify(new NotifAlert);
// });

Route::get('/home', 'HomeController@index')->name('home');
