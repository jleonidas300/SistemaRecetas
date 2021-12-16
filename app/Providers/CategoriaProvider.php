<?php

namespace App\Providers;

use View;
use App\CategoriaReceta;
use Illuminate\Support\ServiceProvider;

class CategoriaProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //pasando todas las categorias a una vista
        View::composer('*', function($view){
            $categorias = CategoriaReceta::all();
            $view->with('categorias', $categorias);
        });
    }
}
