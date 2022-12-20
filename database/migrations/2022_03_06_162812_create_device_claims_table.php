<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_claims', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('device_insurance_id');
            $table->double('amount_will_pay_ins_provider');
            $table->double('user_will_pay');
            $table->string('status')->nullable();
            $table->double('device_value')->nullable();
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
        Schema::dropIfExists('device_claims');
    }
}
