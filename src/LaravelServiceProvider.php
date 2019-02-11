<?php
/**
 * User: qbhy
 * Date: 2019-02-11
 * Time: 12:17
 */

namespace Qbhy\Easemob;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;

class LaravelServiceProvider extends BaseServiceProvider
{

    /**
     * Setup the config.
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__ . '/../config/easemob.php');
        if ($this->app->runningInConsole()) {
            $this->publishes([$source => base_path('config/easemob.php')], 'easemob');
        }
        if ($this->app instanceof LumenApplication) {
            $this->app->configure('easemob');
        }
        $this->mergeConfigFrom($source, 'easemob');
    }

    public function register()
    {
        $this->setupConfig();
        $this->app->singleton(Easemob::class, function ($app) {
            return new Easemob(config('easemob'));
        });
        $this->app->alias(Easemob::class, 'easemob');
    }
}