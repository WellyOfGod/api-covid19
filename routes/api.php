<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Covid19Controller;

Route::get('cases-by-state-period', [Covid19Controller::class, 'casesByStateDate']);

Route::post('top10state',[Covid19Controller::class, 'top10state']);
