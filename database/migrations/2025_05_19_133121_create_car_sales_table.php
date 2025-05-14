<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('car_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->constrained();
            $table->unsignedBigInteger('car_id');  // Changed vehicle_id to car_id
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');  // Foreign key now points to cars
            $table->foreignId('user_id')->constrained(); // buyer
            $table->decimal('sale_price', 10, 2);
            $table->date('sale_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_sales');
    }
};
