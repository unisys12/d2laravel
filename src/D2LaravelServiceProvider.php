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
        if ($this->app->runningInConsole()) {
            $this->commands([
                checkManifestVersion::class,
                SeedTable::class,
                DownloadManifest::class,
            ]);

            if (!class_exists('CreateManifestTable')) {
                $this->publishes([
                    __DIR__ . '/database/migrations/create_manifest_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_manifest_table.php'),
                ], 'migrations');
            }
        }
    }
}
