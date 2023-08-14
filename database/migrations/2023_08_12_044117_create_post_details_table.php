<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("post_id")->nullable();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->unsignedBigInteger("category_id")->nullable();
            $table->unsignedBigInteger("category_detail_id")->nullable();
            $table->foreign("post_id")->references("id")->on("posts")->onDelete('set null');
            $table->foreign("user_id")->references("id")->on("users")->onDelete('set null');
            $table->foreign("category_id")->references("id")->on("categories")->onDelete('set null');
            $table->foreign("category_detail_id")->references("id")->on("category_details")->onDelete('set null');
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
        Schema::dropIfExists('post_details');
    }
};