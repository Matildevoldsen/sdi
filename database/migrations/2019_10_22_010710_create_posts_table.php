<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug');
            $table->string('title_dk');
            $table->string('title_en')->nullable();
            $table->text('content_dk');
            $table->text('content_en')->nullable();
            $table->integer('category_id');
            $table->string('meta_title_dk');
            $table->string('meta_title_en')->nullable();
            $table->string('meta_desc_dk');
            $table->string('meta_desc_en')->nullable();
            $table->string('thumbnail');
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
        Schema::dropIfExists('posts');
    }
}
