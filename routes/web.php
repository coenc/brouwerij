<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

//Homepage
Route::get('/', 'HomeController@index');

//Authentication routes
Route::get('auth/login', 'Auth\LoginController@showLoginForm');
Route::post('auth/login', 'Auth\LoginController@login');
Route::get('auth/logout', 'Auth\LoginController@logout');
Route::get('logout', 'Auth\LoginController@logout');
//Registration routes
Route::get('auth/register', 'Auth\RegisterController@showRegistrationForm');
Route::post('auth/register', 'Auth\RegisterController@create');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::get('auth/woonplaatsen', 'WoonplaatsController@getWoonplaatsen');

Auth::routes();

// Application routes

Route::resource('producten', 'BierController');
Route::get('producten/cat/{productcatid}', 'BierController@index');

Route::resource('bier', 'BierController');
// Route::post('bier_image_save', 'BierController@storeBeerImage');

Route::resource('productie', 'BrouwselController');
// Route::resource('brouwen', 'BrouwselController');

Route::resource('productcategorieen', 'BiercategorieController');
Route::resource('biercategorie', 'BiercategorieController');

Route::get('grondstoffen/cat/{grondstofcatid}', 'GrondstofController@index');
Route::resource('grondstoffen', 'GrondstofController');

Route::resource('grondstof', 'GrondstofController');

Route::resource('grondstofcategorieen', 'GrondstofcategorieController');
Route::resource('grondstofcategorie', 'GrondstofcategorieController');

Route::resource('inkoopgrondstoffen', 'InkoopController');
Route::resource('inkoop', 'InkoopController');
Route::resource('verbruikgrondstoffen', 'VoorraadController');
Route::resource('voorraadgrondstoffen', 'VoorraadController');
Route::resource('leveranciers', 'LeverancierController');
Route::resource('leverancier', 'LeverancierController');
Route::resource('klanten', 'LeverancierController');
Route::get('brief', 'LeverancierController@brief');

Route::get('recepten', 'ReceptController@index');
Route::get('recept', 'ReceptController@recept');
Route::resource('receptregel', 'ReceptController');

Route::resource('mijnprofiel', 'ProfielController');

//Rapportages
Route::get('rapportage/productie', 'RapportageController@productie');
Route::get('rapportagedata', 'RapportageController@servedata');
Route::get('rapportage/accijnsafdracht', 'RapportageController@accijnsAfdracht');

Route::get('brouwerijen', 'BrouwerijenController@index');
