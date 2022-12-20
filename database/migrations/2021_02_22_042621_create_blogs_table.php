<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('blog_category_id');
            $table->string('title')->nullable();
            $table->string('slug')->unique();
            $table->string('author')->nullable();
            $table->string('image')->default('default.png');
            $table->longText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->enum('type', ['blog', 'news'])->default('blog');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('blogs');
    }
}
