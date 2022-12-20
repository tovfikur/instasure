<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceClaimedPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_claimed_parts', function (Blueprint $table) {
            $table->id();
            $table->integer('device_claim_id');
            $table->integer('device_insurance_id');
            $table->string('parts_name')->nullable();
            $table->string('parts_identity_number')->nullable();
            $table->double('parts_price')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('device_claimed_parts');
    }
}
