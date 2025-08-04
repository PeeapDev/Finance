<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('id_cards', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->string('card_type'); // student, staff, visitor, etc.
            $table->integer('quantity');
            $table->decimal('unit_price', 8, 2);
            $table->decimal('total_amount', 10, 2);
            $table->string('customer_name');
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->date('order_date');
            $table->date('delivery_date')->nullable();
            $table->string('status')->default('pending'); // pending, processing, completed, cancelled
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
        Schema::dropIfExists('id_cards');
    }
};
