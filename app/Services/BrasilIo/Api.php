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

    public function casesByStatePeriod(string $dateFrom, string $dateTo, string $state)
    {
        $casesByFromDate = $this->client->get("caso/data?date={$dateFrom}&state={$state}&")->object();

        $casesByToDate = $this->client->get("caso/data?date={$dateTo}&state={$state}&")->object();

        dd($casesByFromDate, $casesByToDate);
    }
}
