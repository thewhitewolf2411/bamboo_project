<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email',100)->unique()->nullable();
            $table->string('password');
            $table->string('birthdate');
            $table->string('current_phone');
            $table->string('preffered_os');
            $table->boolean('sub');
            $table->string('username')->nullable()->unique();
            $table->string('worker_email', 100)->default('customersupport@bamboorecycle.com');
            $table->timestamp('email_verified_at')->nullable();
            $table->smallInteger('type_of_user')->default(0);
            $table->boolean('account_disabled')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
