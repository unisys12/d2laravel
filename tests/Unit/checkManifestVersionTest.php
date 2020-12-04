<?php

namespace unisys12\D2Laravel\Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use unisys12\D2Laravel\Tests\TestCase;

class checkManifestVersionTest extends TestCase
{

    /** @test */
    function the_cmd_returns_the_version_of_current_manifest()
    {
        // Need to update this due to version number being returned is dynamic
        // Currently, must run cmd `d2:check` to get the version number and paste it here
        // NOT GOOD
        $this->artisan('d2:check')
            ->expectsOutput('Current Manifest version is 89360.20.11.18.2249-6')
            ->assertExitCode(0);
    }
}
