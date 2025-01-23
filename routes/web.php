<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\SessionAuthenticateMiddleware;
use App\Http\Middleware\TokenVarificationMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//page route for user
Route::get('/registration-page', [UserController::class, 'registrationPage'])->name('registrationPage');
Route::get('/login-page', [UserController::class, 'loginPage'])->name('loginPage');
Route::get('/send-otp-page', [UserController::class, 'sendOtpPage'])->name('sendOtpPage');
Route::get('/verify-otp-page', [UserController::class, 'verifyOtpPage'])->name('verifyOtpPage');
Route::get('/reset-password-page', [UserController::class, 'resetPasswordPage'])->name('resetPasswordPage');


//page route for dashboard
Route::get('/category-page',[CategoryController::class,'categoryPage'])->name('categoryPage')->middleware(SessionAuthenticateMiddleware::class);
Route::get('/category-save-page',[CategoryController::class,'categorySavePage'])->name('categorySavePage')->middleware(SessionAuthenticateMiddleware::class);

Route::get('/customer-page',[CustomerController::class,'customerPage'])->name('customerPage')->middleware(SessionAuthenticateMiddleware::class);
Route::get('/customer-save-page',[CustomerController::class,'customerSavePage'])->name('customerSavePage')->middleware(SessionAuthenticateMiddleware::class);


Route::get('/product-page',[ProductController::class,'productPage'])->name('productPage')->middleware(SessionAuthenticateMiddleware::class);
Route::get('/product-save-page',[ProductController::class,'productSavePage'])->name('productSavePage')->middleware(SessionAuthenticateMiddleware::class);

Route::get('/dashboard-page',[DashboardController::class,'dashboardPage'])->name('dashboardPage')->middleware(SessionAuthenticateMiddleware::class);
Route::get('/sale-page',[DashboardController::class,'salePage'])->name('salePage')->middleware(SessionAuthenticateMiddleware::class);
Route::get('/invoice-page',[InvoiceController::class,'listInvoice'])->name('listInvoice')->middleware(SessionAuthenticateMiddleware::class);




// users
Route::post('user-registration',[UserController::class,'userRegistration'])->name('userRegistration');
Route::post('user-login',[UserController::class,'userLogin'])->name('userLogin');
Route::get('user-logout',[UserController::class,'userLogout'])->name('userLogout');
Route::post('send-otp',[UserController::class,'sendOtp'])->name('sendOtp');
Route::post('verify-otp',[UserController::class,'verifyOtp'])->name('verifyOtp');
Route::post('reset-pass',[UserController::class,'resetPassword'])->name('resetPassword')->middleware(SessionAuthenticateMiddleware::class);

//category
Route::post('/create-category',[CategoryController::class,'createCategory'])->name('createCategory')->middleware(SessionAuthenticateMiddleware::class);
Route::post('/update-category',[CategoryController::class,'updateCategory'])->name('updateCategory')->middleware(SessionAuthenticateMiddleware::class);
Route::get('/delete-category',[CategoryController::class,'deleteCategory'])->name('deleteCategory')->middleware(SessionAuthenticateMiddleware::class);
Route::get('/category-by-id',[CategoryController::class,'categoryById'])->name('categoryById')->middleware(SessionAuthenticateMiddleware::class);


//customer
Route::post('/create-customer',[CustomerController::class,'createCustomer'])->name('createCustomer')->middleware(SessionAuthenticateMiddleware::class);
Route::get('/list-customer',[CustomerController::class,'listCustomer'])->name('createCustomer')->middleware(SessionAuthenticateMiddleware::class);
Route::post('/update-customer',[CustomerController::class,'updateCustomer'])->name('updateCustomer')->middleware(SessionAuthenticateMiddleware::class);
Route::get('/delete-customer',[CustomerController::class,'deleteCustomer'])->name('deleteCustomer')->middleware(SessionAuthenticateMiddleware::class);
Route::get('/customer-by-id',[CustomerController::class,'customerById'])->name('customerById')->middleware(SessionAuthenticateMiddleware::class);

// products
Route::post('/create-product',[ProductController::class,'createProduct'])->name('createProduct')->middleware(SessionAuthenticateMiddleware::class);
Route::get('/list-product',[ProductController::class,'listProduct'])->name('listProduct')->middleware(SessionAuthenticateMiddleware::class);
Route::get('/delete-product',[ProductController::class,'deleteProduct'])->name('deleteProduct')->middleware(SessionAuthenticateMiddleware::class);
Route::post('/update-product',[ProductController::class,'updateProduct'])->name('updateProduct')->middleware(SessionAuthenticateMiddleware::class);



//invoice
Route::post('create-invoice',[InvoiceController::class,'createInvoice'])->name('createInvoice')->middleware(SessionAuthenticateMiddleware::class);
Route::get('delete-invoice',[InvoiceController::class,'deleteInvoice'])->name('deleteInvoice')->middleware(SessionAuthenticateMiddleware::class);
Route::get('list-invoice',[InvoiceController::class,'listInvoice'])->name('listInvoice')->middleware(SessionAuthenticateMiddleware::class);
Route::get('invoce-details',[InvoiceController::class,'invoiceDetails'])->name('invoiceDetails')->middleware(SessionAuthenticateMiddleware::class);
