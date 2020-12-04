<?php

namespace unisys12\D2Laravel\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use unisys12\D2Laravel\Tests\TestCase;
use unisys12\D2Laravel\Models\Manifest;

class ManifestTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    /** @test */
    function a_manifest_has_a_version()
    {
        $manifest = Manifest::factory()->make([
            'version' => '1234'
        ]);
        $this->assertEquals('1234', $manifest->version);
    }
}
