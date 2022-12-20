<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimPaymentRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claim_payment_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_dealer_id');
            $table->bigInteger('service_center_id');
            $table->string('total_amount')->nullable();
            $table->string('requestId')->nullable();
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('claim_payment_requests');
    }
}
