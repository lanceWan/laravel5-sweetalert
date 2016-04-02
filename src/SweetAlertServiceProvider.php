<?php

namespace Lance\Sweet;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Sweet;

class SweetAlertServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //加载视图
        $this->loadViewsFrom(__DIR__ . '/views', 'Sweet');
        //将扩展包中的视图文件和配置文件复制到项目中对应的位置
        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/vendor/sweet'),
            __DIR__.'/config/sweet.php' => config_path('sweet.php'),
        ]);
        $this->registerBladeExtensions();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['sweet'] = $this->app->share(function ($app) {
            return new SweetAlert($app['session'], $app['config']);
        });
    }

    public function provides()
    {
        return ['sweet'];
    }

    public function registerBladeExtensions()
    {
        Blade::directive('sweet', function () {
            return Sweet::render();
        });
    }
}
