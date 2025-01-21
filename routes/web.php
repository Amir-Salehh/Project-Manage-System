<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\mainController;
use \App\Http\Controllers\authController;
use \App\Http\Controllers\dashboardController;

Route::get('/', [mainController::class, 'index'])->name('home');

Route::get('/login', [authController::class, 'login_page'])->name('login_page');
Route::post('/login', [authController::class, 'login_post'])->name('login_post');

Route::get('/register', [authController::class, 'register_page'])->name('register_page');
Route::post('/register', [authController::class, 'register_post'])->name('register_post');

Route::get('/dashboard', [dashboardController::class, 'dashboard_page'])->name('dashboard_page');

Route::get('/dashboard/create/project', [dashboardController::class, 'create_project'])->name('create_project');
Route::post('//dashboard/create/project', [dashboardController::class, 'project_post'])->name('project_post');

Route::get('/dashboard/project/edit', [dashboardController::class, 'project_edit'])->name('project_edit');
Route::get('/dashboard/projects/done', [dashboardController::class, 'project_done'])->name('project_done');
Route::post('/dashboard/projects/edit', [dashboardController::class, 'project_edit_post'])->name('project_edit_post');
Route::delete('/dashboard/projects/delete', [dashboardController::class, 'delete_project'])->name('delete_project');

Route::get('logout', [authController::class, 'logout'])->name('logout');

