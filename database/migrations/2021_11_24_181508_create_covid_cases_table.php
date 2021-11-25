<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovidCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covid_cases', function (Blueprint $table) {
            $table->id();
            $table->date('date')->index();
            $table->string('state',2);
            $table->string('city')->nullable()->index();
            $table->string('place_type');
            $table->unsignedInteger('confirmed');
            $table->unsignedInteger('deaths');
            $table->integer('order_for_place');
            $table->boolean('is_last');
            $table->unsignedInteger('estimated_population_2019')->nullable();
            $table->unsignedInteger('estimated_population')->nullable();
            $table->string('city_ibge_code')->nullable();
            $table->unsignedDecimal('confirmed_per_100k_inhabitants')->index()->nullable();
            $table->unsignedDecimal('death_rate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('covid_cases');
    }
}
