<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortalUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portal_users', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->boolean('customer_care')->default(false);
            $table->boolean('categories')->default(false);
            $table->boolean('product')->default(false);
            $table->boolean('quarantine')->default(false);
            $table->boolean('testing')->default(false);
            $table->boolean('payments')->default(false);
            $table->boolean('reports')->default(false);
            $table->boolean('feeds')->default(false);
            $table->boolean('users')->default(false);
            $table->boolean('settings')->default(false);
            $table->boolean('cms')->default(false);
            $table->boolean('trays')->default(false);
            $table->boolean('trolleys')->default(false);
            $table->boolean('boxes')->default(false);
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
        Schema::dropIfExists('portal_users');
    }
}
