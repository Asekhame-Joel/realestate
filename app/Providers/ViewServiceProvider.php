<?php

// app/Providers/ViewServiceProvider.php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\ProfileComposer;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Use the composer for all views
        View::composer('*', ProfileComposer::class);
    }

    public function register()
    {
        //
    }
}

