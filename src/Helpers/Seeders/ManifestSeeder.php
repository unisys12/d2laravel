<?php

namespace unisys12\D2Laravel\Helpers\Seeders;

use Error;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

/**
 * Manifest Seeder Class
 * 
 * Seeds the Manifests table with key value pairs obtained from the current Destiny 2 Manifest
 * 
 * @author Phillip Jackson <unisys12@gmail.com> * 
 * 
 * @param $tables array
 * @param $lang string default "en"
 * 
 * @return void
 */
class ManifestSeeder
{
    function __construct($tables, $lang)
    {
        $this->tables = $tables;
        $this->lang = $lang;
    }

    public function seeder()
    {
        $request = Http::withHeaders(['X_API_KEY' => env('BUNGIE_KEY')])->get(
            'https://www.bungie.net/Platform/Destiny2/Manifest/'
        );

        if ($request->getStatusCode() == '200') {
            $body = $request->getBody();
            $size = $body->getSize();
            $read = $body->read($size);
            $data = json_decode($read);

            DB::table('manifests')->insert([
                ['key' => 'version', 'value' => $data->Response->version],
                [
                    'key' => 'mobileWorldContentPath',
                    'value' => $data->Response->mobileWorldContentPaths->{$this->lang}
                ],
                [
                    'key' => 'jsonWorldContentPath',
                    'value' => $data->Response->jsonWorldContentPaths->{$this->lang}
                ],
                [
                    'key' => 'DestinyInventoryItemDefinition',
                    'value' =>
                    $data->Response->jsonWorldComponentContentPaths->{$this->lang}->DestinyInventoryItemDefinition,
                ],
                [
                    'key' => 'DestinyLoreDefinition',
                    'value' =>
                    $data->Response->jsonWorldComponentContentPaths->{$this->lang}->DestinyLoreDefinition,
                ],
                [
                    'key' => 'DestinyCollectibleDefinition',
                    'value' =>
                    $data->Response->jsonWorldComponentContentPaths->en->DestinyCollectibleDefinition,
                ],
            ]);
        } else {
            new Error('There was an error: {$request->getStatusCode()}');
        }
    }
}
