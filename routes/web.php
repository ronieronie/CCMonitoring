<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CardManagerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpensesController;
use App\Models\User;
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

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('show_dashboard')
        : view('login');
})->name('index');

Route::get('/show_register', [AuthenticationController::class, 'show_register'])->name('show_register');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
Route::post('/register', [AuthenticationController::class, 'register'])->name('register');


Route::get('/show_dashboard', [DashboardController::class, 'show_dashboard'])
    ->middleware(['auth', 'preventBack'])
    ->name('show_dashboard');

Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');


// Route::get('/dashboard', function(){
//     return view('dashboard');
// })->name('dashboard');

// Route::get('/card_manager', [CardManagerController::class, 'show_card_manager'])->name('show_card_manager');
// Route::post('/add_card', [CardManagerController::class, 'add_card'])->name('add_card');
// Route::get('/display_cards', [CardManagerController::class, 'display_cards'])->name('display_cards');
// Route::post('/update_card', [CardManagerController::class, 'update_card'])->name('update_card');
// Route::post('/delete_card', [CardManagerController::class, 'delete_card'])->name('delete_card');

// Route::get('/show_expenses', [ExpensesController::class, 'show_expenses'])->name('show_expenses');
// Route::post('/add_expenses', [ExpensesController::class, 'add_expenses'])->name('add_expenses');
// Route::get('/display_expenses', [ExpensesController::class, 'display_expenses'])->name('display_expenses');
// Route::post('/update_expenses', [ExpensesController::class, 'update_expenses'])->name('update_expenses');
// Route::post('/delete_expenses', [ExpensesController::class, 'delete_expenses'])->name('delete_expenses');

// Card Manager
Route::get('/card_manager', [CardManagerController::class, 'show_card_manager'])
    ->middleware(['auth', 'preventBack'])
    ->name('show_card_manager');

Route::post('/add_card', [CardManagerController::class, 'add_card'])
    ->middleware('auth')
    ->name('add_card');

Route::get('/display_cards', [CardManagerController::class, 'display_cards'])
    ->middleware('auth')
    ->name('display_cards');

Route::post('/update_card', [CardManagerController::class, 'update_card'])
    ->middleware('auth')
    ->name('update_card');

Route::post('/delete_card', [CardManagerController::class, 'delete_card'])
    ->middleware('auth')
    ->name('delete_card');

// Expenses
Route::get('/show_expenses', [ExpensesController::class, 'show_expenses'])
    ->middleware(['auth', 'preventBack'])
    ->name('show_expenses');

Route::post('/add_expenses', [ExpensesController::class, 'add_expenses'])
    ->middleware('auth')
    ->name('add_expenses');

Route::get('/display_expenses', [ExpensesController::class, 'display_expenses'])
    ->middleware('auth')
    ->name('display_expenses');

Route::post('/update_expenses', [ExpensesController::class, 'update_expenses'])
    ->middleware('auth')
    ->name('update_expenses');

Route::post('/delete_expenses', [ExpensesController::class, 'delete_expenses'])
    ->middleware('auth')
    ->name('delete_expenses');


