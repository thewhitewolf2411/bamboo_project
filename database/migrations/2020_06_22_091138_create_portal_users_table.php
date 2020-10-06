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
            $table->boolean('box_management')->default(false);
            $table->boolean('quarantine_managment')->default(false);
            $table->boolean('warehouse_management')->default(false);
            $table->boolean('customer_care')->default(false);
            $table->boolean('order_management')->default(false);
            $table->boolean('create_order')->default(false);
            $table->boolean('customer_accounts')->default(false);
            $table->boolean('administration')->default(false);
            $table->boolean('salvage_models')->default(false);
            $table->boolean('feeds')->default(false);
            $table->boolean('users')->default(false);
            $table->boolean('reports')->default(false);
            $table->boolean('cms')->default(false);
            $table->boolean('categories')->default(false);
            $table->boolean('settings')->default(false);
            $table->boolean('payments')->default(false);
            $table->boolean('payments_awaiting_assignment')->default(false);
            $table->boolean('pending_payments')->default(false);
            $table->boolean('completed_payment')->default(false);
            $table->boolean('payment_report')->default(false);
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
