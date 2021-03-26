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
            $table->boolean('recycle')->default(false);
            $table->boolean('trade_pack_despatch')->default(false);
            $table->boolean('awaiting_receipt')->default(false);
            $table->boolean('receiving')->default(false);
            $table->boolean('device_testing')->default(false);
            $table->boolean('trolley_management')->default(false);
            $table->boolean('trays_managment')->default(false);
            $table->boolean('quarantine_managment')->default(false);
            $table->boolean('warehouse_management')->default(false);
            $table->boolean('sales_lots')->default(false);
            $table->boolean('despatch')->default(false);
            $table->boolean('buying')->default(false);
            $table->boolean('ecommerence_orders')->default(false);
            $table->boolean('ecommerence_users')->default(false);
            $table->boolean('selling_status')->default(false);
            $table->boolean('ecommerence_create_order')->default(false);
            $table->boolean('customer_care')->default(false);
            $table->boolean('order_management')->default(false);
            $table->boolean('create_order')->default(false);
            $table->boolean('customer_accounts')->default(false);
            $table->boolean('messages')->default(false);
            $table->boolean('administration')->default(false);
            $table->boolean('salvage_models')->default(false);
            $table->boolean('sales_models')->default(false);
            $table->boolean('feeds')->default(false);
            $table->boolean('users')->default(false);
            $table->boolean('reports')->default(false);
            $table->boolean('cms')->default(false);
            $table->boolean('categories')->default(false);
            $table->boolean('settings')->default(false);
            $table->boolean('payments')->default(false);
            $table->boolean('awaiting_payments')->default(false);
            $table->boolean('submit_payments')->default(false);
            $table->boolean('payment_confirmations')->default(false);
            $table->boolean('failed_payments')->default(false);
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
