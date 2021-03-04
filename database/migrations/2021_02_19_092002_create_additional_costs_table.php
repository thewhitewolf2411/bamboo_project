<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionalCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_costs', function (Blueprint $table) {
            $table->id();
            $table->float('administration_costs')->default(0);
            $table->float('carriage_costs')->default(0);
            $table->float('miscellaneous_costs')->default(0);
            $table->float('per_job_deduction')->default(0);
            $table->string('cost_description')->nullable();
            $table->integer('applied_to')->default(0);
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
        Schema::dropIfExists('additional_costs');
    }
}
