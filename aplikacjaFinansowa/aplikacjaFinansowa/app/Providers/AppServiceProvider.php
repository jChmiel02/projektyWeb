<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Validator::extend('positive', function ($attribute, $value, $parameters, $validator) {
            return $value > 0;
        });

        Validator::replacer('positive', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'Wszystkie liczby muszą być dodatnie.');
        });
    }
}
