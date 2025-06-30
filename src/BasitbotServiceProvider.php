<?php

namespace Haladigitally\Basitbot;

use Illuminate\Support\ServiceProvider;

class BasitbotServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/basitbot.php' => config_path('basitbot.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/basitbot.php', 'basitbot');
    }
}
// php artisan vendor:publish --provider="Haladigitally\Basitbot\BasitbotServiceProvider" --tag=config
