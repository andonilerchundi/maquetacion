<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
 
    
    public function boot()
    {
        view()->composer([
            "admin.faqs.index"],
            "App\Http\ViewComposers\Admin\FaqsCategories"
        );

        view()->composer([
            'admin.client.index'],
            'App\Http\ViewComposers\Admin\Countries'
        );

        view()->composer([
            'admin.*'],
            'App\Http\ViewComposers\Admin\LocaleLanguage'
        );
    }

    
    public function register()
    {
        //
    }

}
