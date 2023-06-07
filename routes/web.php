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
use Illuminate\Http\Request;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\HomeController;

Route::get('/', function (Request $request) {
    if (Auth::check()) {
        $homeController = new HomeController();
        return $homeController->index($request);
    } else {
        return view('welcome');
    }
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// CLIENTS ROUTES
Route::get('/clients', 'ClientsController@show');
Route::get('/cliente/{id}', 'ClientsController@edit');
Route::post('clients-form', [ClientsController::class, 'store']);
// PRODUCTS ROUTS
Route::get('/products', 'ProductsController@show');
Route::get('/producto/{id}', 'ProductsController@edit');
Route::post('products-form', [ProductsController::class, 'store']);
// INVOICES ROUTS
Route::get('/invoices', 'InvoiceController@show');
Route::get('/invoice/{id}', 'InvoiceController@edit')->name('invoices.show');
Route::post('invoices-form', [InvoiceController::class, 'store']);
Route::get('invoices/{id}/delete', 'InvoiceController@delete')->name('invoices.delete');
Route::get('invoices/{id}/confirm-delete', 'InvoiceController@confirmDelete')->name('invoices.confirm-delete');