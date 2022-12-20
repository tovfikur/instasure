<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentDealersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_dealers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('category_id');
            $table->string('com_org_inst_name');
            $table->string('logo')->nullable();
            $table->string('tread_license')->nullable();
            $table->longText('com_address')->nullable();
            $table->integer('is_api')->default(0);
            $table->string('api_secret')->nullable();;
            $table->string('api_key')->nullable();
            $table->enum('dealer_type',["prepaid, postpaid"])->nullable()->comment("prepaid, postpaid");
            $table->double('dealer_balance')->nullable();
            $table->integer('commission_percentage')->nullable();
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
        Schema::dropIfExists('parent_dealers');
    }
}
