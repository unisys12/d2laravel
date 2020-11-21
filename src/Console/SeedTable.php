<?php

namespace unisys12\D2Laravel\Console;

use Illuminate\Console\Command;
use unisys12\D2Laravel\Helpers\Seeders\ManifestSeeder;

/**
 * SeedTable
 * 
 * Generic class used to call the different seeders avaliable in the package
 * 
 * @author Phillip Jackson <unisys12@gmail.com>
 * 
 * @return void
 */
class SeedTable extends Command
{
    protected $signature = 'd2:seed {--tables=*} {--lang=en}';

    protected $description = 'Seed the local database with paths from the current Destiny 2 Manifest';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // handle seeding method calls
        foreach ($this->option('tables') as $table) {
            switch ($table) {
                case 'manifest':
                    $this->info('### Fetching Manifest ###');
                    $manifest = new ManifestSeeder($table, $this->option('lang'));
                    $manifest->seeder();
                    break;

                default:
                    $this->info("Seeded tables");
                    break;
            }
        }
    }
}
