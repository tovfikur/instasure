<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceInsuranceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_insurance_details', function (Blueprint $table) {
            $table->id();
            $table->integer('device_insurance_id')->nullable();
            $table->string('parts_type')->nullable();
            $table->double('price')->nullable();
            $table->string('ins_type')->nullable();
            $table->string('protection_times_for')->nullable();
            $table->string('claim_status')->nullable();
            $table->double('claim_amount')->nullable();
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
        Schema::dropIfExists('device_insurance_details');
    }
}
