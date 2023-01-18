<?php

use App\Http\Controllers\RoutingController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PostController;
use Faker\Guesser\Name;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
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

//-->Default/about
Route::get('/', function () {
  return view('adminHome');
});
Route::get('/about', [RoutingController::class, 'about']);

//-->Adverts
Route::get('/adverts', [ClientController::class, 'index'])->name('clients.index');
Route::get('/adverts/myAdverts', [ClientController::class, 'indexMyAdverts'])->name('clients.myadverts');
Route::get('/adverts/create', [ClientController::class, 'create'])->name('clients.create')->middleware('verified');
Route::post('/adverts', [ClientController::class, 'store'])->name('clients.store');
Route::get('/adverts/{client}', [ClientController::class, 'show'])->name('clients.show');
Route::get('/advert/{client}', [ClientController::class, 'search'])->name('clients.search');
Route::get('/adverts/admin/{client}', [ClientController::class, 'showAdmin'])->name('clients.showAdmin');
Route::get('/adverts/myAdverts/{client}', [ClientController::class, 'showMyAdverts'])->name('clients.showMyAdverts');
Route::get('/adverts/edit/{client}', [ClientController::class, 'edit'])->name('clients.edit');
Route::get('/adverts/admin/edit/{client}', [ClientController::class, 'editAdmin'])->name('clients.editAdmin');
Route::put('/adverts/{client}', [ClientController::class, 'update'])->name('clients.update');
Route::put('/adverts/admin/{client}', [ClientController::class, 'updateAdmin'])->name('clients.updateAdmin');
Route::delete('/adverts/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
Route::delete('/adverts/admin/{client}', [ClientController::class, 'destroyAdmin'])->name('clients.destroyAdmin');

//-->Advert comments
//Route::get('/postindex', [PostController::class, 'index'])->name('posts.index');
//Route::get('/post', [PostController::class, 'create'])->name('posts.create');
///Route::get('/post/{client}', [PostController::class, 'show'])->name('posts.show');
//Route::post('/poststore', [PostController::class, 'store'])->name('posts.store');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::get('/comments/edit/{comment}', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{client}', [CommentController::class, 'update'])->name('comments.update');



//-->Authentication
Auth::routes(['verify' => true]);
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

//-->Photo
Route::post('save/{client}', [PhotoController::class, 'store'])->name('upload.picture')->middleware('verified');
Route::post('/uploadPP/{id}', [ClientController::class, 'uploadImage']);


//-->Stripe
Route::controller(StripePaymentController::class)->group(function(){
  Route::get('/stripe/{client}', 'stripe')->name('stripe.get');
  Route::post('/stripe/{client}', 'stripePost')->name('stripe.post');
});

//-->PDF
Route::get('generate-invoice-pdf', array('as'=> 'generate.invoice.pdf', 'uses' => 'PDFController@generateInvoicePDF'));
Route::get('/pdf/{id}', [PDFController::class, 'generateInvoicePDF']);
