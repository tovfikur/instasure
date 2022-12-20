<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelInsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_ins_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('travel_insurance_category_title');
            $table->string('full_name')->nullable();
            $table->integer('email')->nullable();
            $table->integer('phone')->nullable();
            $table->string('age')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('passport_expire_till');
            $table->string('policy_number')->nullable();
            $table->integer('ins_price')->nullable();
            $table->double('total_vat')->nullable();
            $table->double('vat_percentage')->nullable();
            $table->double('service_total_amount')->nullable();
            $table->double('grand_total');
            $table->double('parent_dealer_commission')->nullable();
            $table->double('child_dealer_commission')->nullable();
            $table->enum('payment_status',["paid", "unpaid"])->nullable()->comment("paid, unpaid");
            $table->enum('ssl_status',["pending", "completed", "canceled"])->nullable()->comment("pending, completed, canceled");
            $table->enum('status',["pending", "processing", "completed", "canceled"])->nullable()->comment("pending, processing, completed, canceled");
            $table->string('flight_number')->nullable();
            $table->string('flight_date')->nullable();
            $table->string('return_date')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travel_ins_orders');
    }
}
