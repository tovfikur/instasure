<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicyProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policy_providers', function (Blueprint $table) {
            $table->id();
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_email');
            $table->string('contact_person_phone');
            $table->integer('is_api')->nullable();
            $table->integer('api_url')->nullable();
            $table->string('api_key')->nullable();
            $table->string('api_secret');
            $table->integer('status')->nullable();
            $table->string('logo');
            $table->string('template_img')->nullable();
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
        Schema::dropIfExists('policy_providers');
    }
}
