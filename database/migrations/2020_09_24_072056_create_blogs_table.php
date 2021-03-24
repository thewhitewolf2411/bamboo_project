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
            $table->integer('cms_type'); //0 news, 1 blog
            $table->string('cms_title');
            $table->text('cms_parg_1');
            $table->text('cms_parg_2')->nullable();
            $table->text('cms_parg_3')->nullable();
            $table->string('image_1');
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->string('author');
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
