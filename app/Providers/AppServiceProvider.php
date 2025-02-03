<?php

namespace App\Providers;
use Livewire\Livewire;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        Livewire::component('admin.manage-products', \App\Http\Livewire\Admin\ManageProducts::class);
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
