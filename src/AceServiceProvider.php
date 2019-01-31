<?php

namespace Ybinrain\Ace;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container;
use Ybinrain\Ace\Events\BuildingMenu;

use Ybinrain\Ace\Http\ViewComposers\AceComposer;

class AceServiceProvider extends ServiceProvider 
{
    public function register()
    {
        $this->app->singleton(AceService::class, function (Container $app) {
            return new AceService($app['config']['ace.filters'],
                $app['events'],
                $app);
        });
    }

    public function boot(Factory $view, Dispatcher $events, Repository $config)
    {
        $this->publishAssets();

        $this->registerViewComposer($view);

        self::registerMenu($events, $config);
    }

    private function publishAssets()
    {
        // Ace
        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('assets'),
        ], 'public');

        // Vendor
        $this->publishes([
            __DIR__.'/../resources/vendor' => public_path('vendor'),
        ], 'public');
    }
    
    private function registerViewComposer(Factory $view)
    {
        $view->composer('partials.sidebar', AceComposer::class);
    }

    public static function registerMenu(Dispatcher $events, Repository $config)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) use ($config) {
            $menu = \App\Models\Menu::defaultOrder()
                ->get()
                ->toTree()
                ->toArray();
            call_user_func_array([$event->menu, 'add'], $menu);
        });
    }
}
