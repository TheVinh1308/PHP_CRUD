<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
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

// bắt buộc đăng nhập
Route::middleware('auth')->group(function() { 
    // Bắt buộc đăng nhập tài khoản admin
    Route::post('/logout',[LoginController::class,'logout'])->name('logout');
    Route::prefix('admin')->middleware('can:isAdmin')->group(function() {
        Route::resource('/products',ProductController::class)->except(['index','show']);
        Route::get('dashboard',function(){
            return view('admin.dashboard');
        })->name('dashboard');

        Route::post('/edit',function(){
            return view('admin.dashboard');
        })->name('dashboard');
    });
});

// không cần đăng nhập

Route::get('/login',[LoginController::class,'showForm'])->name('login');
Route::post('/login',[LoginController::class,'authenticate'])->name('login');
Route::resource('/products',ProductController::class)->only(['index','show']);
Route::get('/', function () {
    //return view('welcome');
    return view('home');
});

// Đăng nhập,đăng xuất
// Bước 1: Sửa migration, seeder
// Bước 2: chạy lại migration, seeder
// Bước 3: tạo view đăng nhập
// Bước 4: tạo route + controller
// Bước 5: sửa view layout
// Bước 6: phân quyền cho khách và người dùng đã đăng nhập
// Bước 7: phân quyền cho admin

//Đăng nhập, đăng xuất API
// Bước 1: tạo controller + route (code mẫu trong docs)
