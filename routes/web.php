<?php
/**
 * Web route file
 * php version 7.2
 *
 * @category Routes
 * @package  Restaurant
 * @author   Ivelin Nikolov <ivonikolov9898@gmail.com>
 */

Auth::routes();

// Frontend
Route::get('/logout', 'AdminController@logout')->name('logout');
//Maintenance
Route::get('/maintenance', 'IndexController@maintenance')->name('maintenance');
// Frontend routes
Route::get('/', 'IndexController@index')->name('index');
Route::get('/table/{id}', 'IndexController@table')->name('table');
Route::match(['get', 'post'], '/products', 'ProductController@frontViewProducts')->name('products');
Route::get('/product/{id}', 'ProductController@frontGetProduct')->name('product');
Route::get('/order/{id}', 'OrderController@viewOrder')->name('order');
Route::post('/add-order', 'OrderController@addOrder')->name('add-order-product');
Route::get('/delete-order-product/{id}', 'OrderController@delOrderProduct')->name('delete-order-product');

// Admin
Route::match(['get', 'post'], '/admin', 'AdminController@login')->name('admin');
Route::group(
    ['middleware' => ['auth']],
    function () {
        Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
        // Settings routes
        Route::get('/admin/settings', 'AdminController@settings')->name('admin.settings');
        Route::get('/admin/check-pwd', 'AdminController@chkPassword')->name('admin.check-pwd');
        Route::match(['get', 'post'], '/admin/update-pwd', 'AdminController@updatePassword')->name('admin.update-pwd');
        // Categories routes
        Route::match(['get', 'post'], '/admin/add-category', 'CategoryController@addCategory')->name('admin.add-category');
        Route::match(['get', 'post'], '/admin/edit-category/{id}', 'CategoryController@editCategory')->name('admin.edit-category');
        Route::get('/admin/delete-category/{id}', 'CategoryController@deleteCategory')->name('admin.delete-category');
        Route::get('/admin/view-categories', 'CategoryController@viewCategory')->name('admin.view-categories');
        Route::post('/admin/populate-categories', 'CategoryController@populateCategories')->name('admin.populate-categories');
        // Product routes
        Route::match(['get', 'post'], '/admin/add-product', 'ProductController@addProduct')->name('admin.add-product');
        Route::match(['get', 'post'], '/admin/edit-product/{id}', 'ProductController@editProduct')->name('admin.edit-product');
        Route::get('/admin/delete-product/{id}', 'ProductController@deleteProduct')->name('admin.delete-product');
        Route::get('/admin/view-products', 'ProductController@viewProducts')->name('admin.view-products');
        Route::get('/admin/delete-product-image/{id}', 'ProductController@deleteProductImage')->name('admin.delete-product-image');
        Route::get('/admin/check-product', 'ProductController@checkProduct');
        // Products Images routes
        Route::match(['get', 'post'], '/admin/add-images/{id}', 'ProductController@addImages')->name('admin.add-images');
        Route::get('/admin/delete-product-images/{id}', 'ProductController@deleteProductImages')->name('admin.delete-product-images');
        // Orders routes
        Route::get('/admin/edit-order/{id}', 'OrderController@editOrder')->name('admin.edit-order');
        Route::get('/admin/delete-order/{id}', 'OrderController@deleteAdminOrder')->name('admin.delete-order');
        Route::get('/admin/close-order/{id}', 'OrderController@closeAdminOrder')->name('admin.close-order');
        Route::get('/admin/view-orders', 'OrderController@viewOrders')->name('admin.view-orders');
        Route::get('/admin/change-product-cooked/{id}', 'OrderController@changeCooked')->name('admin.change-product-cooked');
        Route::get('/admin/change-product-delivered/{id}', 'OrderController@changeDelivered')->name('admin.change-product-delivered');
        Route::get('/admin/delete-product-order/{id}', 'OrderController@deleteProductOrder')->name('admin.delete-product-order');
        // LandingPage routes
        Route::match(['get', 'post'], '/admin/edit-landing-page', 'IndexController@editLandingPage')->name('admin.edit-landing-page');
        Route::match(['get', 'post'], '/admin/edit-maintenance-page', 'IndexController@editMaintenancePage')->name('admin.edit-maintenance-page');
    }
);
