<?php

namespace unisys12\D2Laravel\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class checkManifestVersion extends Command
{
    protected $signature = 'd2:check';

    protected $description = 'Check the current Manfiest version';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('#### Fetching Destiny 2 Manifest ####');

        // possibly move $request items out to seperate helper to test better.
        $request = Http::withHeaders(['X_API_KEY' => env('BUNGIE_KEY')])->get(
            'https://www.bungie.net/Platform/Destiny2/Manifest/'
        );

        if ($request->getStatusCode() == '200') {
            $body = $request->getBody();
            $size = $body->getSize();
            $read = $body->read($size);
            $data = json_decode($read);
            $this->line("Current Manifest version is " . $data->Response->version);
        } else {
            $this->error('There was an error: {$request->getStatusCode()}');
        }
    }
}
