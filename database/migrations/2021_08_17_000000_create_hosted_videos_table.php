<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostedVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosted_videos', function (Blueprint $table) {
            $table->id();

            $table->morphs('model');
            $table->string('collection_name')->default('default');
            $table->string('source');
            $table->string('video_id');
            $table->unsignedInteger('order')->nullable();
            $table->json('custom_properties')->default('{}');
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
        Schema::drop('hosted_videos');
    }
}
