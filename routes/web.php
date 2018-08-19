<?php
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
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['admin']], function() {
	// Anggota
  Route::get('/anggota', 'AnggotaController@index');
	Route::get('/anggota/create', 'AnggotaController@create');
	Route::post('/anggota/store', 'AnggotaController@store');
	Route::get('/anggota/view/{id}', 'AnggotaController@show');
	Route::get('/anggota/edit/{id}', 'AnggotaController@edit');
	Route::post('/anggota/update/{id}', 'AnggotaController@update');
	Route::delete('/anggota/hapus/{id}', 'AnggotaController@destroy');

	// Buku
	Route::get('/buku', 'BukuController@index')->middleware('admin');
	Route::get('/buku/create', 'BukuController@create');
	Route::post('/buku/store', 'BukuController@store');
	Route::get('/buku/view/{id}', 'BukuController@show');
	Route::get('/buku/edit/{id}', 'BukuController@edit');
	Route::post('/buku/update/{id}', 'BukuController@update');
	Route::delete('/buku/hapus/{id}', 'BukuController@destroy');

	// Kas
	Route::get('/kas', 'KasController@index');
	Route::get('/kas/pemasukan', 'KasController@pemasukan');
	Route::get('/kas/pengeluaran', 'KasController@pengeluaran');
	Route::post('/kas/kasmasuk', 'KasController@kasmasuk');
	Route::post('/kas/kaskeluar', 'KasController@kaskeluar');
	Route::get('/kas/view/{id}', 'KasController@show');
	Route::get('/kas/edit/{id}', 'KasController@edit');
	Route::post('/kas/update/{id}', 'KasController@update');
	Route::delete('/kas/hapus/{id}', 'KasController@destroy');
});
    
// Transaksi
Route::get('/peminjaman', 'TransaksiController@peminjaman');
Route::post('/peminjaman/pinjam', 'TransaksiController@store');
Route::get('/pengembalian', 'TransaksiController@pengembalian');
Route::get('/pengembalian/kembali/{id}', 'TransaksiController@kembali');
Route::get('/kembali/{id}', 'TransaksiController@kembali');

//Laporan
Route::get('/laporan/anggota', 'LaporanController@anggota');
Route::get('/laporan/buku', 'LaporanController@buku');
Route::get('/laporan/kas', 'LaporanController@kas');
Route::get('/laporan/kasmasuk', 'LaporanController@kasmasuk');
Route::get('/laporan/kaskeluar', 'LaporanController@kaskeluar');
Route::get('/laporan/grafikpeminjaman', 'LaporanController@grafikPeminjaman');
Route::get('/laporan/grafikpengembalian', 'LaporanController@grafikPengembalian');
Route::get('/laporan/peringkat/anggota', 'LaporanController@peringkatAnggota');
Route::get('/laporan/peringkat/buku', 'LaporanController@peringkatBuku');
