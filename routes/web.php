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

Route::group(['prefix' => 'admin'], function () {

    Route::get('/image/delete/{image?}', 'App\Vendor\Image\Image@destroy')->name('delete_image');
    Route::get('/image/{image}', 'App\Vendor\Image\Image@showImageSeo')->name('show_image_seo');
    Route::post('/image', 'App\Vendor\Image\Image@storeImageSeo')->name('store_image_seo');

    Route::resource('faqs/categorias', 'App\Http\Controllers\Admin\FaqCategoryController', [
        'parameters' => [
            'categorias' => 'faq_category', 
        ],
        'names' => [
            'index' => 'faqs_categories',
            'create' => 'faqs_categories_create',
            'store' => 'faqs_categories_store',
            'destroy' => 'faqs_categories_destroy',
            'show' => 'faqs_categories_show',
        ]
    ]);

    Route::get('/faqs/filter/{filters?}', 'App\Http\Controllers\Admin\FaqController@filter')->name('faqs_filter');
    Route::resource('faqs', 'App\Http\Controllers\Admin\FaqController', [
        'names' => [
            'index' => 'faqs',
            'create' => 'faqs_create',
            'store' => 'faqs_store',
            'destroy' => 'faqs_destroy',
            'show' => 'faqs_show',
        ]
    ]);

    Route::resource('stock', 'App\Http\Controllers\Admin\StockController', [
        'names' => [
            'index' => 'stock',
            'create' => 'stock_create',
            'store' => 'stock_store',
            'destroy' => 'stock_destroy',
            'show' => 'stock_show',
        ]
    ]);

    Route::resource('usuarios', 'App\Http\Controllers\Admin\UserController', [
        'parameters' => [
            'usuarios' => 'user', 
        ],
        'names' => [
            'index' => 'users',
            'create' => 'users_create',
            'store' => 'users_store',
            'destroy' => 'users_destroy',
            'show' => 'users_show',
        ]
    ]);

    Route::resource('clientes', 'App\Http\Controllers\Admin\ClientController', [
        'parameters' => [
            'clientes' => 'client', 
        ],
        'names' => [
            'index' => 'customers',
            'create' => 'customers_create',
            'store' => 'customers_store',
            'destroy' => 'customers_destroy',
            'show' => 'customers_show',
        ]
    ]);
    Route::get('/sliders/filter/{filters?}', 'App\Http\Controllers\Admin\SliderController@filter')->name('sliders_filter');
    Route::resource('sliders', 'App\Http\Controllers\Admin\SliderController', [
        'parameters' => [
            'sliders' => 'slider', 
        ],
        'names' => [
            'index' => 'sliders',
            'create' => 'sliders_create',
            'store' => 'sliders_store',
            'destroy' => 'sliders_destroy',
            'show' => 'sliders_show',
        ]
    ]);

});

Route::post('/fingerprint', 'App\Http\Controllers\Front\FingerprintController@store')->name('front_fingerprint');

Route::get('/faqs', 'App\Http\Controllers\front\FaqController@index')->name('faqs_front');
Route::get('/login', 'App\Http\Controllers\Front\LoginController@index')->name('front_login');
Route::post('/login', 'App\Http\Controllers\Front\LoginController@login')->name('front_login_submit');
Route::get('/', 'App\Http\Controllers\Front\HomeController@index')->name('home_front');
