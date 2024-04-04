<?php

use App\Http\Controllers\DepartmentController;
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
    return view('welcome');
});
Route::resource('departments', DepartmentController::class);
Route::delete('/selected-department',[DepartmentController::class,'deleteSelected'])->name('departments.delete');
// Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
// Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
// Route::post('/departments', [DepartmentController::class, 'store']);
// Route::get('/departments/{id}', [DepartmentController::class, 'show'])->name('departments.detail');
// Route::get('/departments/{id}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
// Route::delete('/departments/{id}', [DepartmentController::class, 'destroy']);
