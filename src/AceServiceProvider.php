<?php
namespace Ybinrain\Ace;

use Illuminate\Support\ServiceProvider;

class AceServiceProvider extends ServiceProvider 
{
    public function register()
    {
        phpinfo();
    }

    public function boot()
    {
        dump(1);
    }
}
