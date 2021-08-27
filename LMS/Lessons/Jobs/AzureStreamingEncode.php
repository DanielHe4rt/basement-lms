<?php

namespace LMS\Lessons\Jobs;

use App\Services\Azure\MediaService;
use App\Services\Azure\StorageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use LMS\Lessons\Models\Lesson;

class AzureStreamingEncode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Lesson $lesson;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Lesson $lesson)
    {
        $this->lesson = $lesson;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mediaService = new MediaService();
        $storageService = new StorageService();
        $mediaService->auth();
        $storageService->auth();

        if ($this->lesson->getStatus() != 'waiting') {
            $this->deletePreviousStream($mediaService, $storageService);
            $this->lesson->initVideoStream();
        }

        $this->createStream($mediaService, $storageService);
    }

    private function deletePreviousStream(MediaService $mediaService, StorageService $storageService)
    {
        $locatorName = $this->lesson->getInfo('locator');
        $mediaService->deleteStreamingLocator($locatorName);

        $assetName = $this->lesson->getInfo('asset');
        $mediaService->deleteAsset($assetName);
    }

    private function createStream(MediaService $mediaService, StorageService $storageService): void
    {
        $assetInput = sprintf(
            '%s-%s-%s-%s',
            $this->lesson->module->course->id,
            $this->lesson->module->id,
            $this->lesson->id,
            date('H-i-s')
        );

        $assetOutput = $assetInput . '_Output_' . date('Ymd-His');


        $mediaService->createAsset($assetInput);
        $this->lesson->setInfo('status', 'creating asset');

        $permissions = $mediaService->grantAssetPermissions($assetInput);
        $this->lesson->setInfo('status', 'granting permissions');


        $this->lesson->setInfo('status', 'preparing to upload');
        $assetUrl = $permissions['assetContainerSasUrls'][0];
        $storageService->uploadFile($assetUrl, $this->lesson->getFirstMediaPath());

        $this->lesson->setInfo('status', 'generating output asset');
        $mediaService->createAsset($assetOutput);
        $this->lesson->setInfo('asset', $assetOutput);

        $encodeJob = $mediaService->startEncodingJob($assetInput, $assetOutput);
        $this->lesson->setInfo('status', 'encoding');


        $this->encodeMedia($mediaService, $encodeJob['name']);
        $mediaService->deleteAsset($assetInput);


        $locatorName = 'locator-' . date('Ymd-His');
        $this->lesson->setInfo('locator', $locatorName);
        $mediaService->createStreamingLocator($locatorName, $assetOutput);
        $this->lesson->setInfo('status', 'creating locator');

        $paths = $mediaService->listStreamingLocatorPaths($locatorName);

        $urls = $this->getStreamingUrls($paths['streamingPaths']);

        $this->lesson->setInfo('status', 'done');
        $this->lesson->setStreamingUrls($urls);

        $this->deleteFile();
    }

    private function getStreamingUrls($streamingPaths): array
    {
        $urls = [];
        foreach ($streamingPaths as $path) {
            $urls[] = [
                'protocol' => $path['streamingProtocol'],
                'url' => 'https://basement-brso.streaming.media.azure.net/' . $path['paths'][0]
            ];
        }
        return $urls;
    }

    private function encodeMedia(MediaService $mediaService, $name): void
    {
        do {
            $jobInfo = $mediaService->getJobByName($name);
            $progress = $jobInfo['properties']['outputs'][0]['progress'];
            $this->lesson->setInfo('percent', $progress);
            sleep(5);
        } while ($jobInfo['properties']['outputs'][0]['progress'] < 99);
    }

    private function deleteFile()
    {
        unlink($this->lesson->getFirstMediaPath());
    }


}
