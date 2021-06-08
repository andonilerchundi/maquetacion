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

        view()->composer([
            'admin.tags.index'],
            'App\Http\ViewComposers\Admin\LocaleGroups'
        );

        view()->composer([
            "admin.gloves.index"],
            "App\Http\ViewComposers\Admin\Oz"
        );

        view()->composer([
            "admin.gloves.index"],
            "App\Http\ViewComposers\Admin\Brand"
        );

        view()->composer([
            "admin.gloves.index"],
            "App\Http\ViewComposers\Admin\IVA"
        );

        view()->composer([
            "front.components.header"],
            "App\Http\ViewComposers\Front\Logo"
        );
        view()->composer([
            "front.components.header"],
            "App\Http\ViewComposers\Front\LogoLight"
        );

        view()->composer([
            "front.components.footer"],
            "App\Http\ViewComposers\Front\Logo"
        );
        view()->composer([
            "front.components.footer"],
            "App\Http\ViewComposers\Front\LogoLight"
        );
       
    }

    
    public function register()
    {
        //
    }

}
