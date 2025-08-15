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
        Schema::create('psychological_tests', function (Blueprint $table) {
            $table->id();
            $table->string('cover')->nullable();
            $table->string('title');
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->integer('price')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('final_price')->default(0);
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('view_count')->default(0);
            $table->unsignedBigInteger('participants_count')->default(0);
            $table->integer('capacity')->nullable();
            $table->string('age_group')->nullable();
            $table->string('test_link')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('psychological_tests');
    }
};
