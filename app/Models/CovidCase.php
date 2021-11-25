<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CovidCase extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'covid_cases';

    /**
     * @var string[]
     */
    protected $guarded = ['id'];
}
