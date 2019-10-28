<?php

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

// Index
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Authentication
Route::prefix('auth')->name('auth.')->group(function() {
    // Login
    Route::get('login', 'Auth\LoginController@index')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    // Logout
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
});

// Dashboard
Route::get('dashboard', 'DashboardController@index')->name('dashboard');

// Assets
Route::prefix('asset')->name('asset.')->group(function() {
    // Asset List
    Route::get('/', 'AssetController@index')->name('index');
    // Assets JSON
    Route::get('get/json', 'AssetController@getJSON')->name('json');
    // Add Asset
    Route::post('add', 'AssetController@store')->name('add');
    // Edit Asset
    Route::get('{id}/edit', 'AssetController@edit')->name('edit');
    Route::post('{id}/edit', 'AssetController@update')->name('update');
    // Delete Asset
    Route::post('{id}/delete', 'AssetController@delete')->name('delete');
    // Transfer Asset
    Route::get('transfer', 'AssetController@transferForm')->name('transfer');
    Route::post('transfer', 'AssetController@transferSubmit');
    // Borrow Asset
    Route::get('borrowed', 'AssetController@borrowList')->name('borrow.index');
    Route::get('borrow', 'AssetController@borrowAsset')->name('borrow');
    Route::post('borrow', 'AssetController@borrow')->name('borrow');
    // User Borrow Asset
    Route::get('borrow/list', 'AssetController@borrowListUser')->name('borrow.list');
    // Borrow JSON
    Route::get('borrow/json', 'AssetController@borrowJSON')->name('borrow.json');
    // View Asset
    Route::get('{id}/view', 'AssetController@viewAsset')->name('view');
    // Return Asset
    Route::post('borrow/{id}/return', 'AssetController@returnAsset')->name('borrow.return');
});

// Categories
Route::prefix('category')->name('category.')->group(function() {
    // Categories List
    Route::get('/', 'CategoryController@index')->name('index');
    // Categories JSON
    Route::get('get/json', 'CategoryController@getJSON')->name('json');
    // Add Category
    Route::post('add', 'CategoryController@store')->name('add');
    // Edit Category
    Route::get('{id}/edit', 'CategoryController@edit')->name('edit');
    Route::post('{id}/edit', 'CategoryController@update')->name('update');
    // Delete Category
    Route::post('{id}/delete', 'CategoryController@delete')->name('delete');
});

// Users
Route::prefix('user')->name('user.')->group(function() {
    // Users List
    Route::get('/', 'UserController@index')->name('index');
    // Users JSON
    Route::get('get/json', 'UserController@getJSON')->name('json');
    // Add User
    Route::post('add', 'UserController@store')->name('add');
    // Edit User
    Route::get('{id}/edit', 'UserController@edit')->name('edit');
    Route::post('{id}/edit', 'UserController@update')->name('update');
    // Delete User
    Route::post('{id}/delete', 'UserController@delete')->name('delete');
});

// Setting
Route::prefix('settings')->name('settings.')->group(function() {
    // Settings Form
    Route::get('/', 'SettingController@index')->name('index');
    // Update Settings
    Route::post('/', 'SettingController@update')->name('update');
});

// Profile
Route::prefix('profile')->name('profile.')->group(function() {
    // Profile Form
    Route::get('/', 'ProfileController@index')->name('index');
    // Update profile
    Route::post('/', 'ProfileController@update')->name('update');
});
