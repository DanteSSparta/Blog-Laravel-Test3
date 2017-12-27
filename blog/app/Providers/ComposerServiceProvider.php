<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class ComposerServiceProvider extends ServiceProvider {

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('layouts.sidebar',function($view){
            $archives = \App\Post::archives();
        $tags = \App\Tag::has('posts')->pluck('name');
        $view->with(compact('archives','tags'));
        });
        
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }
}