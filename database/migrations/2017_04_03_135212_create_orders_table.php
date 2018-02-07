<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders',function (Blueprint $table){
           $table->increments('id');
            $table->integer('job_number')->unique();
            $table->integer('user_id');
            $table->decimal('price',10,2)->default(0);
            $table->decimal('tax',8,2)->default(0);
            $table->decimal('shipping_cost',8,2)->default(0);
            $table->decimal('discount',8,2)->default(0);
            $table->decimal('extra_charge',8,2)->default(0);
            $table->decimal('total',10,2)->default(0);
            $table->decimal('paid',10,2)->default(0);
            $table->string('status')->default('new');
            $table->integer('order_shipping_method_id');
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
        Schema::dropIfExists('orders');
    }
}
