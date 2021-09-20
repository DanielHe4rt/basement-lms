<?php


namespace App\Services\Azure;


use Carbon\Carbon;
use GuzzleHttp\Client;

class MediaService
{
    private Client $client;

    private string $apiVersion = '2020-05-01';

    private $apiKey = '';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('streaming.azure.management_url')
        ]);
    }

    public function auth(): array
    {
        $tenant = config('streaming.azure.tenant_id');
        $uri = "https://login.microsoftonline.com/$tenant/oauth2/token";

        $response = $this->client->post($uri, [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => config('streaming.azure.client_id'),
                'client_secret' => config('streaming.azure.client_secret'),
                'resource' => config('streaming.azure.endpoint')
            ]
        ]);

        $response = json_decode($response->getBody(), true);
        $this->apiKey = $response['access_token'];

        return $response;
    }

    public function createAsset(string $assetName, string $description = '')
    {
        $uri = sprintf(
            '/subscriptions/%s/resourceGroups/%s/providers/Microsoft.Media/mediaServices/%s/assets/%s?api-version=%s',
            config('streaming.azure.subscription_id'),
            config('streaming.azure.resource_group'),
            config('streaming.azure.account_name'),
            $assetName,
            $this->apiVersion
        );

        $response = $this->client->put($uri, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey
            ],
            'json' => [
                'properties' => [
                    'description' => $description
                ]
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function deleteAsset(string $assetName)
    {
        $uri = sprintf(
            '/subscriptions/%s/resourceGroups/%s/providers/Microsoft.Media/mediaServices/%s/assets/%s?api-version=%s',
            config('streaming.azure.subscription_id'),
            config('streaming.azure.resource_group'),
            config('streaming.azure.account_name'),
            $assetName,
            $this->apiVersion
        );

        $response = $this->client->delete($uri, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey
            ]
        ]);

        return json_decode($response->getBody() ?? [], true);
    }

    public function grantAssetPermissions(string $assetName, string $permissions = 'ReadWrite'): array
    {
        $uri = sprintf(
            '/subscriptions/%s/resourceGroups/%s/providers/Microsoft.Media/mediaServices/%s/assets/%s/listContainerSas?api-version=%s',
            config('streaming.azure.subscription_id'),
            config('streaming.azure.resource_group'),
            config('streaming.azure.account_name'),
            $assetName,
            $this->apiVersion
        );

        $response = $this->client->post($uri, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey
            ],
            'json' => [
                'expiryTime' => Carbon::now()->addHour()->toISOString(),
                'permissions' => $permissions
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function startEncodingJob(string $assetInput, string $assetOutput, $transformSlug = 'encodebolado')
    {
        $payload = [
            'properties' => [
                'input' => [
                    'assetName' => $assetInput,
                    '@odata.type' => '#Microsoft.Media.JobInputAsset'
                ],
                'outputs' => [
                    [
                        'assetName' => $assetOutput,
                        '@odata.type' => '#Microsoft.Media.JobOutputAsset'
                    ]
                ],
                'priority' => 'Normal'
            ]
        ];

        $uri = sprintf(
            '/subscriptions/%s/resourceGroups/%s/providers/Microsoft.Media/mediaServices/%s/transforms/%s/jobs/%s?api-version=%s',
            config('streaming.azure.subscription_id'),
            config('streaming.azure.resource_group'),
            config('streaming.azure.account_name'),
            $transformSlug,
            $transformSlug . '_Job_' . date('Ymd-His'),
            $this->apiVersion
        );

        $response = $this->client->put($uri, [
            'headers' => ['Authorization' => 'Bearer ' . $this->apiKey],
            'json' => $payload
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getJobByName(string $jobName, $transformSlug = 'encodebolado')
    {
        $uri = sprintf(
            '/subscriptions/%s/resourceGroups/%s/providers/Microsoft.Media/mediaServices/%s/transforms/%s/jobs/%s?api-version=%s',
            config('streaming.azure.subscription_id'),
            config('streaming.azure.resource_group'),
            config('streaming.azure.account_name'),
            $transformSlug,
            $jobName,
            $this->apiVersion
        );

        $response = $this->client->get($uri, [
            'headers' => ['Authorization' => 'Bearer ' . $this->apiKey]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getStreamingLocator(string $streamingLocatorName)
    {
        $uri = sprintf(
            '/subscriptions/%s/resourceGroups/%s/providers/Microsoft.Media/mediaServices/%s/streamingLocators/%s?api-version=%s',
            config('streaming.azure.subscription_id'),
            config('streaming.azure.resource_group'),
            config('streaming.azure.account_name'),
            $streamingLocatorName,
            $this->apiVersion
        );

        $response = $this->client->get($uri, [
            'headers' => ['Authorization' => 'Bearer ' . $this->apiKey]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function createStreamingLocator(string $streamingLocatorName, string $assetName, string $streamingPolicyName = 'Predefined_ClearStreamingOnly')
    {
        $payload = [
            'properties' => [
                'assetName' => $assetName,
                'endTime' => Carbon::now()->addYears(100)->toISOString(),
                'streamingPolicyName' => $streamingPolicyName
            ]
        ];
        $uri = sprintf(
            '/subscriptions/%s/resourceGroups/%s/providers/Microsoft.Media/mediaServices/%s/streamingLocators/%s?api-version=%s',
            config('streaming.azure.subscription_id'),
            config('streaming.azure.resource_group'),
            config('streaming.azure.account_name'),
            $streamingLocatorName,
            $this->apiVersion
        );

        $response = $this->client->put($uri, [
            'headers' => ['Authorization' => 'Bearer ' . $this->apiKey],
            'json' => $payload
        ]);

        return json_decode($response->getBody(), true);
    }

    public function deleteStreamingLocator(string $streamingLocatorName)
    {
        $uri = sprintf(
            '/subscriptions/%s/resourceGroups/%s/providers/Microsoft.Media/mediaServices/%s/streamingLocators/%s?api-version=%s',
            config('streaming.azure.subscription_id'),
            config('streaming.azure.resource_group'),
            config('streaming.azure.account_name'),
            $streamingLocatorName,
            $this->apiVersion
        );

        $response = $this->client->delete($uri, [
            'headers' => ['Authorization' => 'Bearer ' . $this->apiKey],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function listStreamingLocatorPaths(string $streamingLocatorName)
    {
        $uri = sprintf(
            '/subscriptions/%s/resourceGroups/%s/providers/Microsoft.Media/mediaServices/%s/streamingLocators/%s/listPaths?api-version=%s',
            config('streaming.azure.subscription_id'),
            config('streaming.azure.resource_group'),
            config('streaming.azure.account_name'),
            $streamingLocatorName,
            $this->apiVersion
        );

        $response = $this->client->post($uri, [
            'headers' => ['Authorization' => 'Bearer ' . $this->apiKey]
        ]);

        return json_decode($response->getBody(), true);
    }

}
