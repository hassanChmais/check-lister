<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'  => ['auth','save_last_action_at']] ,function(){

Route::get('checklists/{checklist}', [\App\Http\Controllers\ChecklistController::class, 'index'])->name('user.checklists.show');
Route::get('tasklist/{list_type}', [\App\Http\Controllers\User\ChecklistController::class, 'tasklist'])
        ->name('user.tasklist');


        Route::get('/welcome',[\App\Http\Controllers\PageController::class,'welcome'])->name('welcome');
        Route::get('/consultation',[\App\Http\Controllers\PageController::class,'consultation'])->name('consultation');
    Route::get('/consultation',[\App\Http\Controllers\PageController::class,'consultation'])->name('consultation');
    Route::get('checklists/{checklist}',[\App\Http\Controllers\ChecklistController::class , 'index'])->name('user.checklist');
    Route::group(['prefix' => 'admin' ,'as' => 'admin.', 'middleware' => 'is_admin' ] ,function(){
Route::resource('checklist_groups',App\Http\Controllers\Admin\CheckListGroupController::class);
Route::resource('checklist_groups.checklists',App\Http\Controllers\Admin\CheckListController::class);
Route::resource('checklists.tasks',App\Http\Controllers\Admin\TaskController::class);
Route::post('images',[App\Http\Controllers\Admin\ImageController::class ,'store'])->name('images.store');
Route::get('users',[App\Http\Controllers\Admin\UserController::class ,'index'])->name('users');
    });
});