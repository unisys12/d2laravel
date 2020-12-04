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

        include_once __DIR__ . "/../src/database/migrations/create_manifests_table.php.stub";

        (new \CreateManifestsTable)->up();
    }

    protected function getPackageProviders($app)
    {
        return [
            D2LaravelServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }
}
