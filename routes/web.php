<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SslCommerzPaymentController;
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

Route::get('/', [HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect', [HomeController::class,'redirect'])->middleware('auth', 'verified');
Route::get('/view_category', [AdminController::class,'view_category']);
Route::post('/add_category', [AdminController::class,'add_category']);
Route::get('/delete_category/{id}', [AdminController::class,'delete_category']);


Route::get('/add_product', [AdminController::class,'add_product']);
Route::post('/store_product', [AdminController::class,'store_product']);
Route::get('/view_product', [AdminController::class,'view_product']);

route::get('/product_delete/{id}', [AdminController::class,'product_delete']);
route::get('/product_update/{id}', [AdminController::class,'product_update']);
route::post('/edit_product/{id}', [AdminController::class,'edit_product']);


route::get('/product_details/{id}', [HomeController::class,'product_details']);

// add to cart route
route::post('/add_cart/{id}', [HomeController::class,'add_cart']);

route::get('/show_cart', [HomeController::class,'show_cart']);
route::get('/remove_cart/{id}', [HomeController::class,'remove_cart']);


route::get('/cash_order', [HomeController::class,'cash_order']);
route::get('/stripe/{totalPrice}', [HomeController::class,'stripe']);
route::post('/stripe/{totalPrice}', [HomeController::class,'stripePost'])->name('stripe.post');


// order route
Route::get('/order', [AdminController::class,'order']);
Route::get('/delivered/{id}', [AdminController::class,'delivered']);

Route::get('/print_pdf/{id}', [AdminController::class,'print_pdf']);
Route::get('/send_email/{id}', [AdminController::class,'send_email']);
Route::post('/send_user_email/{id}', [AdminController::class,'send_user_email']);

Route::get('/search', [AdminController::class,'searchData']);

Route::get('/show_order', [HomeController::class,'show_order']);
Route::get('/cancel_order/{id}', [HomeController::class,'cancel_order']);


Route::get('/products', [HomeController::class,'products']);

// contact route
route::post('/contact', [HomeController::class,'contact']);
route::get('/all_messages', [AdminController::class,'all_messages']);
route::get('/contact_us', [HomeController::class,'contact_us']);


// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END