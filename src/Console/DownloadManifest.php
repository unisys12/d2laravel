<?php

namespace unisys12\D2Laravel\Console;

use ZipArchive;
use Illuminate\Http\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

/**
 * DownloadManifest
 * 
 * Downloads and stores the SQLite database into `storage/app/public/`. 
 * This file contains all static assests from the Manifest and is used to generate seed files.
 * 
 * @author Phillip Jackson <unisys12@gmail.com>
 * 
 * @return void
 */
class DownloadManifest extends Command
{
    protected $signature = 'd2:manifest';

    protected $description = 'Downloads the latest version of the SQLite Database';

    function __construct()
    {
        parent::__construct();
    }

    protected function download($uri)
    {
        // download the manifest file

        $request = Http::withOptions(
            [
                'headers' => [
                    'X_API_KEY' => env('BUNGIE_KEY')
                ]
            ]
        )->get($uri);

        if ($request->successful()) {
            $this->info('Request Successful');
            return $request->body();
        } else {
            $this->error("There was an error " . $request->getStatusCode());
            $request->throw();
        }
    }

    protected function store($localPath)
    {
        // file_put_contents($storeage_path())
    }

    /**
     * Extract contents of compressed database
     * 
     * @param string $path Path to storage location of extract sqlite db
     * 
     * @return void
     */
    protected function _extractZip(string $path)
    {
        $zip = new ZipArchive;
        $zip->open($path);
        $zip->extractTo('storage/app/destiny2/');
        $zip->close();
    }

    public function handle()
    {
        $worldContentPath = DB::table('manifests')
            ->where('key', 'mobileWorldContentPath')
            ->first();

        $fullPath = 'https://www.bungie.net/' . $worldContentPath->value;
        $content = $this->download($fullPath);

        // store the file locally
        Storage::disk('local')->put('manifest.zip', $content);

        if (file_exists('storage/app/manifest.zip')) {
            $this->info('File stored successfully!');
            $this->info('Unzipping Archive');
            $this->_extractZip('storage/app/manifest.zip');
        } else {
            $this->error('File was not found where it was supposed to be...');
            $this->error(error_get_last());
        }
    }
}
