<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\data_skillController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\SkillController;
use App\Http\Controllers\googlecontroller;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\get;

Route::get('/', function () {
    return view('home.index');
});


// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

//google login
Route::get('/google/redirect' , [googlecontroller::class , 'index'])->name('google.redirect');
Route::get('/google/callback' , [googlecontroller::class , 'verify']);

Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/profile/store', [AdminController::class, 'ProfileStore'])->name('profile.store');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
 
});


Route::controller(HomeController::class)->group(function() {

    Route::get('all/home', 'AllHome')->name('all.home');
    Route::get('add/home', 'AddHome')->name('add.home');
    Route::post('store/home', 'StoreHome')->name('store.home');
    Route::get('edit/home/{id}', 'EditHome')->name('home.edit');
    Route::post('update/home', 'UpdateHome')->name('update.home');
    Route::get('delete/home/{id}', 'DeleteHome')->name('home.delete');
});

Route::controller(AboutController::class)->group(function() {
    Route::get('all/about' , 'AllAbout')->name('all.about');
    Route::get('add/about' , 'AddAbout')->name('add.about');
    Route::post('store/about', 'StoreAbout')->name('store.about');
    Route::get('edit/about/{id}', 'EditAbout')->name('about.edit');
    Route::post('update/about', 'UpdateAbout')->name('update.about');
    Route::get('delete/about/{id}', 'DeleteAbout')->name('about.delete');
});

Route::controller(SkillController::class)->group(function() {

    Route::get('all/skill' , 'AllSkill')->name('all.skill');
    Route::get('add/skill' , 'AddSkill')->name('add.skill');
    Route::post('store/skill', 'StoreSkill')->name('store.skill');
    Route::get('edit/skill/{id}', 'EditSkill')->name('skill.edit');
    Route::post('update/skill', 'UpdateSkill')->name('update.skill');
    Route::get('delete/skill/{id}', 'DeleteSkill')->name('skill.delete');

});

Route::controller(data_skillController::class)->group(function() {

    Route::get('all/data/skill' , 'AllDataSkill')->name('all.data.skill');
    Route::get('add/data/skill' , 'AddDataSkill')->name('add.data.skill');
    Route::post('store/data/skill', 'StoreDataSkill')->name('store.data.skill');
    Route::get('edit/data_skill/{id}', 'EditDataSkill')->name('data.edit');
    Route::post('update/data_skill', 'UpdateDataSkill')->name('update.data');
    Route::get('delete/data_skill/{id}', 'DeleteDataSkill')->name('data.delete');

} );

});

require __DIR__.'/auth.php';

