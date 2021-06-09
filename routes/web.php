<?php

use Illuminate\Support\Facades\Route;
use App\Vendor\Locale\LocalizationSeo;

$localizationseo = new LocalizationSeo();

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

    Route::get('/informacion-de-la-empresa', 'App\Http\Controllers\Admin\BusinessInformationController@index')->name('business_information');
    Route::post('/informacion-de-la-empresa', 'App\Http\Controllers\Admin\BusinessInformationController@store')->name('business_information_store');

    Route::get('/seo/sitemap', 'App\Http\Controllers\Admin\LocaleSeoController@getSitemaps')->name('create_sitemap');
    Route::get('/seo/import', 'App\Http\Controllers\Admin\LocaleSeoController@importSeo')->name('seo_import');
    Route::get('/seo/{key}', 'App\Http\Controllers\Admin\LocaleSeoController@edit')->name('seo_edit');
    Route::get('/seo', 'App\Http\Controllers\Admin\LocaleSeoController@index')->name('seo');
    Route::post('/seo', 'App\Http\Controllers\Admin\LocaleSeoController@store')->name('seo_store');
    Route::get('/ping-google', 'App\Http\Controllers\Admin\LocaleSeoController@pingGoogle')->name('ping_google');


    Route::get('/image/delete/{image?}', 'App\Vendor\Image\Image@destroy')->name('delete_image');
    Route::get('/image/{image}', 'App\Vendor\Image\Image@show')->name('show_image_seo');
    Route::get('/image/temporal/{image?}', 'App\Vendor\Image\Image@showTemporal')->name('show_temporal_image_seo');
    Route::post('/image/seo', 'App\Vendor\Image\Image@storeSeo')->name('store_image_seo');

    Route::get('/tags/filter/{filters?}', 'App\Http\Controllers\Admin\LocaleTagController@filter')->name('tags_filter');
    Route::get('/tags/{group}/{key}', 'App\Http\Controllers\Admin\LocaleTagController@edit')->name('tags_edit');
    Route::get('/tags/import', 'App\Http\Controllers\Admin\LocaleTagController@importTags')->name('tags_import');
    Route::get('/tags', 'App\Http\Controllers\Admin\LocaleTagController@index')->name('tags');
    Route::post('/tags', 'App\Http\Controllers\Admin\LocaleTagController@store')->name('tags_store');


    Route::get('/menus/item/index/{language?}/{item?}', 'App\Http\Controllers\Admin\MenuItemController@index')->name('menus_item_index');
    Route::get('/menus/item/create/{language?}', 'App\Http\Controllers\Admin\MenuItemController@create')->name('menus_item_create');
    Route::delete('/menus/item/delete/{item?}', 'App\Http\Controllers\Admin\MenuItemController@destroy')->name('menus_item_destroy');
    Route::get('/menus/item/show/{item?}', 'App\Http\Controllers\Admin\MenuItemController@show')->name('menus_item_show');
    Route::post('/menus/item/store', 'App\Http\Controllers\Admin\MenuItemController@store')->name('menus_item_store'); 
    Route::post('/menus/item/reordermenu', 'App\Http\Controllers\Admin\MenuItemController@orderItem')->name('menus_reorder');
    
    Route::resource('menus', 'App\Http\Controllers\Admin\MenuController', [
        'names' => [
            'index' => 'menus',
            'create' => 'menus_create',
            'store' => 'menus_store',
            'destroy' => 'menus_destroy',
            'show' => 'menus_show',
        ]
    ]);
    
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


    Route::get('/gloves/filter/{filters?}', 'App\Http\Controllers\Admin\GloveController@filter')->name('gloves_filter');
    Route::resource('gloves', 'App\Http\Controllers\Admin\GloveController', [
        'parameters' => [
            'gloves' => 'glove', 
        ],
        'names' => [
            'index' => 'gloves',
            'create' => 'gloves_create',
            'store' => 'gloves_store',
            'destroy' => 'gloves_destroy',
            'show' => 'gloves_show',
        ]
    ]);

  


  

});

Route::group(['prefix' => $localizationseo->setLocale(),
              'middleware' => [ 'localize' ]
            ], function () use ($localizationseo) {

    Route::get($localizationseo->transRoute('routes.front_faqs'), 'App\Http\Controllers\Front\FaqController@index')->name('front_faqs');
    Route::get($localizationseo->transRoute('routes.front_faq'), 'App\Http\Controllers\Front\FaqController@show')->name('front_faq');
    Route::get($localizationseo->transRoute('routes.front_gloves'), 'App\Http\Controllers\Front\GloveController@index')->name('front_gloves');
    Route::get($localizationseo->transRoute('routes.front_glove'), 'App\Http\Controllers\Front\GloveController@show')->name('front_glove');
    Route::get($localizationseo->transRoute('routes.front_contact'), 'App\Http\Controllers\Front\ContactController@index')->name('front_contact');
    Route::get($localizationseo->transRoute('routes.front_about_us'), 'App\Http\Controllers\Front\AboutUsController@index')->name('front_about_us');    

});

Route::post('/fingerprint', 'App\Http\Controllers\Front\FingerprintController@store')->name('front_fingerprint');



Route::get('/gloves/filter/{filters?}', 'App\Http\Controllers\Front\GloveController@filter')->name('gloves_filter');
Route::get('/login', 'App\Http\Controllers\Front\LoginController@index')->name('front_login');
Route::post('/login', 'App\Http\Controllers\Front\LoginController@login')->name('front_login_submit');
Route::get('/', 'App\Http\Controllers\Front\HomeController@index')->name('home_front');
Route::post('/contacto', 'App\Http\Controllers\Front\ContactController@store')->name('front_contact_form');
Route::get('/traduccion/{language}/{parent}/{slug?}', 'App\Http\Controllers\Front\LocalizationController@show')->name('front_localization');


