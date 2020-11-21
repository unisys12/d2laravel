<?php

namespace unisys12\D2Laravel\Tests\Unit;

// use Illuminate\Support\Facades\Artisan;
use unisys12\D2Laravel\Tests\TestCase;

class SeedTableTest extends TestCase
{
    /** @test */
    function the_SeedTable_class_should_be_loaded()
    {
        $this->artisan('d2:seed manifest')->assertExitCode(0);
    }
}
