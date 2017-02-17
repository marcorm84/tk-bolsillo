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

        Validator::extend('exists_where', function($attribute, $value, $parameters){
            $table = $parameters[0];
            $query = \DB::table($table)->where('id', $value);

            for ($i=1; $i < count($parameters); $i+=2) {
                if (($col = $parameters[$i]) && ($val = $parameters[$i+1])) {
                    $query = $query->where($col, $val);
                } else {
                    break;
                }
            }

            return (bool) $query->count();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        date_default_timezone_set('America/Lima');
    }
}
