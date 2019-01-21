<?php

namespace Ybinrain\Ace;

use Illuminate\Support\ServiceProvider;

class AceServiceProvider extends ServiceProvider 
{
    public function register()
    {
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('assets'),
        ], 'public');
    }
}
