<?php


namespace App\Services\Azure;


use DateTime;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Utils;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class StorageService
{
    private Client $client;

    private string $apiVersion = '2020-05-01';
    private string $apiKey;

    public function __construct()
    {
        $resource = config('streaming.azure.resource_group');
        $this->client = new Client([
            'base_uri' => "https://$resource.blob.core.windows.net/",
        ]);
    }

    public function auth(): array
    {
        $uri = config('streaming.azure.tenant_oauth_url');

        $response = $this->client->post($uri, [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => config('streaming.azure.client_id'),
                'client_secret' => config('streaming.azure.client_secret'),
                'resource' => 'https://rest.media.azure.net'
            ]
        ]);

        $response = json_decode($response->getBody(), true);
        $this->apiKey = $response['access_token'];

        return $response;
    }

    public function uploadFile(string $assetUrl, string $filePath): ?array
    {
        $filename = File::name($filePath) . '.' . File::extension($filePath);

        $uri = str_replace('?', '/' . $filename . '?', $assetUrl);
        try {
            $response = $this->client->put($uri, [
                'headers' => [
                    'x-ms-version' => '2017-11-09',
                    'x-ms-blob-type' => 'BlockBlob',
                    'x-ms-effective-locale' => 'en.en-us',
                    'x-ms-blob-content-type' => File::mimeType($filePath),
                    'x-ms-date' => date(DateTime::RFC1123),
                ],
                'body' => Utils::tryFopen($filePath, 'r')
            ]);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }

        return json_decode($response->getBody() ?? [], true);
    }
}
