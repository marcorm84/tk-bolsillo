<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * gt Greater than, used only for numbers
         * parameters[0]
         */
        Validator::extend('gt', function($attribute, $value, $parameters, $validator) {
            return $value > $parameters[0];
        });

        Validator::replacer('gt', function($message, $attribute, $rule, $parameters) {
          return str_replace(':field', $parameters[0], $message);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
