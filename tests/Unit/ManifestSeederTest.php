<?php

namespace unisys12\D2Laravel\Tests\Unit;

use Orchestra\Testbench\TestCase;
use unisys12\D2Laravel\Helpers\Seeders\ManifestSeeder;

class ManifestSeederTest extends TestCase
{
    /** @test */
    function default_language_is_en()
    {
        $cmd = new ManifestSeeder('manifest');

        $this->assertEquals($cmd->lang, 'en');
    }
}
