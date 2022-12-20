<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_collections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('device_insurance_id');
            $table->unsignedBigInteger('collection_center_id');
            $table->text('mobile_health_details')->nullable();
            $table->string('device_photos')->nullable();
            $table->string('receipt_copy')->nullable();
            $table->boolean('customer_will_pay')->default(true);
            $table->enum('status', ['collected', 'cc_shipped_to_hq', 'on_hq', 'on_servicing', 'repaired', 'hq_shipped_to_cc', 'cc_received_by_hq', 'delivered'])->default('collected')->comment('collected=device colected by collection center, cc_shipped_to_hq=collectin center shipped to head quarter,on_hq=received by head quarter,on_servicing=device sent to service center, repaired=device repaired by service center, hq_shipped_to_cc=head quarter sent to collection center, cc_received_by_hq=collection center received back from head quarters, delivered=device delivered to customer successfully');
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
        Schema::dropIfExists('device_collections');
    }
}
