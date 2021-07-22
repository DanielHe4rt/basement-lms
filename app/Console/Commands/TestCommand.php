<?php

namespace App\Console\Commands;

use App\Services\Azure\MediaService;
use App\Services\Azure\StorageService;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'azure:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $mediaService = new MediaService();
        $storageService = new StorageService();
        $mediaService->auth();
        $storageService->auth();

        $assetInput = 'aula-1' . date('H-i-s');
        $assetOutput = 'aula-1' . date('H-i-s') . '_Output_' . date('Ymd-His');

        $this->info('creating asset...');
        $asset = $mediaService->createAsset($assetInput);

        $this->info('granting permissions...');
        $permissions = $mediaService->grantAssetPermissions($assetInput);

        $assetId = $asset['properties']['assetId'];
        $this->info('asset ' . $assetId . ' created with permissions!');

        $assetUrl = $permissions['assetContainerSasUrls'][0];
        $this->info('uploading...');
        $storageService->uploadFile($assetUrl, storage_path('app/tests/ig-arguments1.mp4'));

        $this->info('creating helper asset...');
        $mediaService->createAsset($assetOutput);

        $this->info('uploaded! starting encoding...');
        $encodeJob = $mediaService->startEncodingJob($assetInput, $assetOutput);

        do {
            $jobInfo = $mediaService->getJobByName($encodeJob['name']);
            $this->info('Progress: ' . $jobInfo['properties']['outputs'][0]['progress'] . '%');
            sleep(7);
        } while ($jobInfo['properties']['outputs'][0]['progress'] < 99);

        $this->info('encode done.');


        $locatorName = 'locator-' . date('Ymd-His');
        $this->info('generating streaming locator...');
        $mediaService->createStreamingLocator($locatorName, $assetOutput);

        $this->info('fetching locator url...');
        $paths = $mediaService->listStreamingLocatorPaths($locatorName);

        // dar o output da url para streaming

        foreach ($paths['streamingPaths'] as $path) {
            $this->info('Protocol: ' . $path['streamingProtocol'] . ' -> https://basement-brso.streaming.media.azure.net/'  . $path['paths'][0]);
        }

        $this->info('done =)');

        return 0;
    }
}
