<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AllUserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Frontend\FrontendHomeController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendHomeController::class, 'index'])->name('index');

Route::get('/dashboard', function () {
    return view('frontend.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'roles:user'])->group(function () {
    Route::get('/user/profile', [UserController::class, 'userProfile'])->name('user.profile');
    Route::post('/user/profile/update', [UserController::class, 'userProfileUpdate'])->name('user.profile.update');
    Route::post('/user/change/password', [UserController::class, 'userPasswordUpdate'])->name('user.change.password');
    Route::get('/user/logout', [UserController::class, 'userLogout'])->name('user.logout');
});

require __DIR__.'/auth.php';

// Admin Route Declare here

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
Route::get('/become/instructor', [AdminController::class, 'becomeInstructor'])->name('become.instructor');
Route::post('/register/instructor', [AdminController::class, 'registerInstructor'])->name('register.instructor');

Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

    Route::controller(CategoryController::class)->group(function(){
        Route::get('/all/category', 'allCategory')->name('all.category');
        Route::get('/add/category', 'addCategory')->name('add.category');
        Route::post('/store/category', 'storeCategory')->name('store.category');
        Route::put('/update/category/{id}', 'updateCategory')->name('update.category');
        Route::get('/destroy/category/{id}', 'destroyCategory')->name('destroy.category');
    });

    Route::controller(SubCategoryController::class)->group(function(){
        Route::get('/all/sub-category', 'allSubCategory')->name('all.sub_category');
        Route::get('/add/sub-category', 'addSubCategory')->name('add.sub_category');
        Route::post('/store/sub-category', 'storeSubCategory')->name('store.sub_category');
        Route::get('/edit/sub-category/${id}', 'editSubCategory')->name('edit.sub_category');
        Route::put('/update/sub-category/{id}', 'updateSubCategory')->name('update.sub_category');
        Route::get('/destroy/sub-category/{id}', 'destroySubCategory')->name('destroy.sub_category');
    });

    Route::controller(AllUserController::class)->group(function(){
        Route::get('/all/instructor', 'allInstructor')->name('all.instructor');
        Route::post('/update/user/status', 'updateUserStatus')->name('update.user.status');
    });
});

// Instructor Route Declare here

Route::get('/instructor/login', [InstructorController::class, 'InstructorLogin'])->name('instructor.login');

Route::middleware(['auth', 'roles:instructor'])->group(function(){

    Route::get('/instructor/dashboard', [InstructorController::class, 'InstructorDashboard'])->name('instructor.dashboard');
    Route::get('/instructor/profile', [InstructorController::class, 'InstructorProfile'])->name('instructor.profile');
    Route::post('/instructor/profile/store', [InstructorController::class, 'InstructorProfileStore'])->name('instructor.profile.store');
    Route::get('/instructor/change/password', [InstructorController::class, 'InstructorChangePassword'])->name('instructor.change.password');
    Route::post('/instructor/password/update', [InstructorController::class, 'InstructorPasswordUpdate'])->name('instructor.password.update');
    Route::get('/instructor/logout', [InstructorController::class, 'InstructorLogout'])->name('instructor.logout');
});
