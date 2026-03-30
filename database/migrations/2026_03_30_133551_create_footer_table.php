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
        Schema::create('footer', function (Blueprint $table) {
            $table->id();
            $table->string('title_1', 255);
            $table->string('title_2', 255);
            $table->string('title_3', 255);
            $table->string('title_4', 255);
            $table->string('sub_1_title_1', 255);
            $table->string('sub_1_title_2', 255);
            $table->string('sub_1_title_3', 255);
            $table->string('sub_2_title_1', 255);
            $table->string('sub_2_title_2', 255);
            $table->string('sub_2_title_3', 255);
            $table->string('sub_3_title_1', 255);
            $table->string('sub_3_title_2', 255);
            $table->string('sub_3_title_3', 255);
            $table->string('sub_4_title_1', 255);
            $table->string('sub_4_title_2', 255);
            $table->string('sub_4_title_3', 255);
            $table->string('url_1_title_1', 255);
            $table->string('url_1_title_2', 255);
            $table->string('url_1_title_3', 255);
            $table->string('url_2_title_1', 255);
            $table->string('url_2_title_2', 255);
            $table->string('url_2_title_3', 255);
            $table->string('url_3_title_1', 255);
            $table->string('url_3_title_2', 255);
            $table->string('url_3_title_3', 255);
            $table->string('url_4_title_1', 255);
            $table->string('url_4_title_2', 255);
            $table->string('url_4_title_3', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('footer');
    }
};
