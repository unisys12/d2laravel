<?php

namespace unisys12\D2Laravel\Tests\Unit;

use unisys12\D2Laravel\Tests\TestCase;

class SeedTableTest extends TestCase
{

    /** @test */
    function the_SeedTable_class_should_be_loaded()
    {
        $this->assertTrue(class_exists(\unisys12\D2Laravel\Console\SeedTable::class));
    }

    /** @test */
    function the_manifest_seeder_is_called_when_manifest_is_passed_to_seedtable()
    {
        $this->artisan('d2:seed', ["tables" => ["manifest"]])
            ->expectsOutput('### Fetching Manifest ###')
            ->assertExitCode(0);
    }
}
