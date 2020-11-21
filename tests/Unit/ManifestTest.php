<?php

namespace unisys12\D2Laravel\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use unisys12\D2Laravel\Tests\TestCase;
use unisys12\D2Laravel\Models\Manifest;

class ManifestTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_manifest_has_a_version()
    {
        $manifest = Manifest::factory()->create(['version' => '1234']);
        $this->assertEquals('1234', $manifest->version);
    }
}
