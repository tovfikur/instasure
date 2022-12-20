<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsuranceDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_discounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->default(0);
            $table->bigInteger('insurance_provider_id')->nullable();
            $table->bigInteger('device_category_id');
            $table->bigInteger('device_subcategory_id');
            $table->bigInteger('device_brand_id')->default(0);
            $table->bigInteger('device_model_id')->default(0);
            $table->enum('inc_exc_type',["excluded", "included"])->default('excluded')->comment("excluded, included");
            $table->enum('discount_type',["flat", "percentage"])->default('flat')->comment("flat, percentage");
            $table->string('discount_price')->default(0);
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->time('time_from')->nullable();
            $table->time('time_to')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('insurance_discounts');
    }
}
