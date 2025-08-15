<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->comment('0:bying 1:payment 2:paid 3:done 4:cancel')->default(0);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('cupon')->nullable();
            $table->integer('total_price')->default(0);
            $table->integer('final_price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
