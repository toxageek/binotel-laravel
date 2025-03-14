<?php

namespace Toxageek\BinotelLaravel;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class BinotelClient
{
    protected string $key;

    protected string $secret;

    protected string $apiUrl;

    public function __construct(?string $key = null, ?string $secret = null, ?string $apiUrl = null)
    {
        $this->key = $key ?? config('binotel.key') ?? config('services.binotel.key');
        $this->secret = $secret ?? config('binotel.secret') ?? config('services.binotel.secret');
        $this->apiUrl = $apiUrl ?? config('binotel.api_url') ?? config('services.binotel.api_url') ?? 'https://api.binotel.com/api/4.0/';
    }

    protected function request(string $endpoint, array $params = []): array
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("{$this->apiUrl}{$endpoint}.json", array_merge($params, [
                'key' => $this->key,
                'secret' => $this->secret,
            ]));

            return $response->json();
        } catch (RequestException|ConnectionException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function stats(): BinotelStats
    {
        return new BinotelStats();
    }

    public static function customers(): BinotelCustomers
    {
        return new BinotelCustomers();
    }

    public static function calls(): BinotelCalls
    {
        return new BinotelCalls();
    }

    public static function settings(): BinotelSettings
    {
        return new BinotelSettings();
    }
}
