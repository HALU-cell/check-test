<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use PharIo\Manifest\Author;
use Symfony\Component\HttpKernel\DependencyInjection\RegisterControllerArgumentLocatorsPass;

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

Route::get('/', [ContactController::class, 'index'])->name('form.index');
Route::post('/', [ContactController::class, 'post'])->name('form.post');
Route::get('/confirm', [ContactController::class, 'confirm'])->name('form.confirm');
Route::post('/confirm', [ContactController::class, 'send'])->name('form.send');
Route::get('/thanks', [ContactController::class, 'thanks'])->name('form.thanks');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AuthController::class, 'index']);
});
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

