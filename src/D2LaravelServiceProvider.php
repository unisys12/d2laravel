<?php

namespace unisys12\D2Laravel;

use Illuminate\Support\ServiceProvider;
use unisys12\D2Laravel\Console\checkManifestVersion;
use unisys12\D2Laravel\Console\DownloadManifest;
use unisys12\D2Laravel\Console\SeedTable;

class D2LaravelServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                checkManifestVersion::class,
                SeedTable::class,
                DownloadManifest::class,
            ]);
        }
    }
}
