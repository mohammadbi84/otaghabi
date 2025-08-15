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
        Schema::create('consultation_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // اگر لاگین بود
            $table->string('name');
            $table->string('mobile');
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete(); // حوزه مشاوره

            $table->foreignId('consultant_id')->constrained('users')->cascadeOnDelete(); // فرض بر اینکه مشاورها همون جدول users هستن

            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_requests');
    }
};
