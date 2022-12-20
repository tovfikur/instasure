<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_packages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('insurance_type_id');
            $table->bigInteger('device_category_id');
            $table->bigInteger('device_subcategory_id');
            $table->bigInteger('brand_id');
            $table->bigInteger('device_model_id');
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
        Schema::dropIfExists('insurance_packages');
    }
}
