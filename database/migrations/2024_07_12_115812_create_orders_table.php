<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('customer_name');
            $table->date('order_date');
            $table->string('product_code');
            $table->integer('quantity');
            $table->decimal('total', 10, 2);
            $table->string('status');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
