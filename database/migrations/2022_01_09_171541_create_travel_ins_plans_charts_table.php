<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelInsPlansChartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_ins_plans_charts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('travel_ins_plans_category_id');
            $table->double('age_from')->nullable();
            $table->double('age_to')->nullable();
            $table->double('period_from')->nullable();
            $table->double('period_to')->nullable();
            $table->double('ins_price')->nullable();
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
        Schema::dropIfExists('travel_ins_plans_charts');
    }
}
