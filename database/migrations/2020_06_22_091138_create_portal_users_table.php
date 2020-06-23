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
            $table->boolean('superuser')->default(false);
            //Warehouse Receipt & Dispach Portal
            $table->boolean('trade_pack_dispach_system')->default(false);
            $table->boolean('dispach_portal_delivery_receiving_system')->default(false);
            //Warehouse Stock Management Portal
            $table->boolean('device_tester_stock_managment')->default(false);
            $table->boolean('stock_managment')->default(false);
            $table->boolean('stock_managment_delivery_receiving_system')->default(false);
            $table->boolean('quarantine_managamnet_and_customer_returns')->default(false);
            $table->boolean('tray_managment_system')->default(false);
            $table->boolean('sales_and_dispach')->default(false);
            $table->boolean('stock_transfer')->default(false);
            $table->boolean('device_managment')->default(false);
            //Phone Testing Portal
            $table->boolean('box_managment_system')->default(false);
            $table->boolean('device_testing')->default(false);
            //Warehouse Administration Console 
            $table->boolean('user_managment')->default(false);
            $table->boolean('reports_and_statistics')->default(false);
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
