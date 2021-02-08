<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_batches', function (Blueprint $table) {
            $table->id();
            $table->string('payment_type')->default('01');
            $table->date('arrive_at');
            $table->text('csv_file')->nullable(true)->default(null);
            $table->text('reference')->nullable(true)->default(null);
            $table->integer('batch_type');
            $table->boolean('exported')->default(false);
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
        Schema::dropIfExists('payment_batches');
    }
}
