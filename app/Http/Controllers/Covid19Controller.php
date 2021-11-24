<?php

namespace App\Http\Controllers;

use App\Services\BrasilIo\Api;
use Illuminate\Http\Request;

class Covid19Controller extends Controller
{
    public function __construct(private Api $brasilioApi)
    {
        $this->brasilioApi = new Api;
    }

    public function casesByStatePeriod(Request $request)
    {
        $this->brasilioApi->casesByStatePeriod($request->dateFrom, $request->dateTo, $request->state);

    }

}
