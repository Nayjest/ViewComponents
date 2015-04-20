<?php namespace Nayjest\Grids;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * For backward compatibility with Laravel 4
     * @deprecated
     * @return string
     */
    public function guessPackagePath()
    {
        return __DIR__;
    }
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $pkg_path = dirname(__DIR__);
        $views_path = $pkg_path . '/resources/views';

        # only for Laravel 4 & some of 5-dev
        if (version_compare(Application::VERSION, '5.0.0', '<')) {
            $this->package('nayjest/grids');
            $this->app['view']->addNamespace('data-view', $views_path);
        } else {
            $this->loadViewsFrom($views_path, 'data-view');
            $this->loadTranslationsFrom($pkg_path . '/resources/lang', 'data-view');
            $this->publishes([
                $views_path => base_path('resources/views/nayjest/data-view')
            ]);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
