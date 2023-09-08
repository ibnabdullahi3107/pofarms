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
    public function boot(): void
    {
        Validator::extend('exists_in_users', function ($attribute, $value, $parameters, $validator) {

            // Check if the beneficiary_id exists in the users table
            return \App\Models\User::where('client_id', $value)->exists();
        });
    }
}
