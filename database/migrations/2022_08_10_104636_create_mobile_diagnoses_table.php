<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobileDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_diagnoses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('dealer_id')->default(0);
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('device_model_id');
            $table->unsignedBigInteger('imei_data_id')->nullable()->default(0);
            $table->date('validity_period')->comment('Valid for 30 minutes from store time');
            $table->string('serial_number', 30)->comment('Device serial number');;
            $table->string('battery_number', 20)->comment('Device batery number');;
            $table->unsignedDouble('price')->comment('Device actual purchase price');;
            $table->boolean('motherboard_status')->comment('Result true or false');
            $table->boolean('battery_health_status')->comment('Result true or false');
            $table->boolean('front_camera_status')->comment('Result true or false');
            $table->boolean('back_camera_status')->comment('Result true or false');
            $table->boolean('microphone_status')->comment('Result true or false');
            $table->boolean('ram_status')->comment('Result true or false');
            $table->boolean('rom_status')->comment('Result true or false');
            $table->boolean('display_screen_status')->comment('Result true or false');
            $table->string('invoice_image')->nullable();
            $table->json('device_images')->nullable();
            $table->string('imei_image');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->comment('pending = customer diagnosis report by default pending, admin can approve and deny');
            $table->boolean('is_active')->default(0);
            $table->text('note')->nullable();
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
        Schema::dropIfExists('mobile_diagnoses');
    }
}
