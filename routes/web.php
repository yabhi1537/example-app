<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PhonePecontroller;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Category;
use App\Livewire\StudentShow;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\WeatherController;

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

// Route::get('/',function(){
//     return view('welcome');
// });

Route::get('/',function(){
    return view('student.index');
});

Route::get('/employees', function () {
    return view('home');
});

Route::get('pusher',function(){
    return view('pusher');
});

Route::resource('/post', PostController::class)->names([
  'index' => 'posts.index',
  'create' => 'posts.create',
  'store' => 'posts.store',
  'show' => 'posts.show',
]);
Route::get('test',[PostController::class,'test']);

// Route::get('Weather',[WeatherController::class,'Weather'])->name('Weather');
Route::match(["get", "post"], "weather", [WeatherController::class, "weather"])->name("weather.form");

Route::get('phonepe',[PhonePecontroller::class,'phonePe']);
Route::any('phonepe-response',[PhonePeController::class,'response'])->name('response');
Route::get('callback',[PhonePeController::class,'callback'])->name('callback');
 

Route::get('event-registration',[OrderController::class,'register']);
Route::post('payment',[OrderController::class,'order']);
Route::post('payment/status',[OrderController::class,'paymentCallback'])->name('paymentCallback');

 // Stripe
// Route::get('/payment',[PaymentController::class,'showPaymentForm'])->name('payment.form');
// Route::post('/process-payment',[PaymentController::class,'processPayment'])->name('process.payment');

Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');


// Route::get('/student/index', StudentShow::class);
 Route::get('logouts',[StudentController::class,'logouts'])->name('logouts');
Auth::routes();


