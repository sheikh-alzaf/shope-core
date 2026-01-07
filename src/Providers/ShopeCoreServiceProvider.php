<?php

namespace Shope\Core\Providers;

use Illuminate\Support\ServiceProvider;

class ShopeCoreServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Config publish
        $this->publishes([
            __DIR__.'/../config/shope-core.php' => config_path('shope-core.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/shope-core.php', 'shope-core'
        );
    }
}
