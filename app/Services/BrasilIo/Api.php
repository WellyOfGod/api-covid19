<?php

namespace App\Services\BrasilIo;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class Api
{

    /** @var PendingRequest  */
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::withToken(config('services.brasilio.token'),'Token')
        ->baseUrl(config('services.brasilio.url'));
    }

    public function casesByStateDate(string $date, string $state)
    {
        return $this->client->get('caso/data',[
            'date' => $date,
            'state' => $state
        ])->json();
    }
}
