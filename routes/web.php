<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::view('/', 'pages.dashboard')->name('dashboard');

Route::view('/submenu-1', 'pages.simple')->name('submenu.one');
Route::view('/submenu-2', 'pages.simple')->name('submenu.two');
Route::view('/submenu-3', 'pages.simple')->name('submenu.three');

Route::view('/menu-2', 'pages.simple')->name('menu.two');
Route::view('/menu-3', 'pages.simple')->name('menu.three');


