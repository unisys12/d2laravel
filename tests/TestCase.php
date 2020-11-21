<?php

namespace unisys12\D2Laravel\Tests;

use Illuminate\Support\Facades\Artisan;
use unisys12\D2Laravel\D2LaravelServiceProvider;

/**
 * Setup tests you dumbass!!
 */

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        // setup tests
        parent::setUp();
        Artisan::call('migrate:fresh');
    }

    protected function getPackageProviders($app)
    {
        return [
            D2LaravelServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // import the CreatePostsTable class from the migration
        include_once __DIR__ . '/../src/database/migrations/create_manifest_table.php.stub';

        // run the up() method of that migration class
        (new \CreateManifestTable)->up();
    }
}
