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
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->string('cover')->nullable(); // عکس کاور
            $table->string('title'); // عنوان
            $table->text('short_description'); // توضیح کوتاه
            $table->longText('description'); // توضیح کامل
            $table->unsignedBigInteger('teacher_id'); // استاد (رابطه به users)
            $table->unsignedBigInteger('category_id')->nullable(); // استاد (رابطه به users)
            $table->decimal('price', 15, 2)->default(0); // قیمت اصلی
            $table->decimal('discount', 15, 2)->default(0); // مبلغ تخفیف
            $table->decimal('final_price', 15, 2)->default(0); // قیمت بعد از تخفیف
            $table->enum('type', ['online', 'offline', 'in_person']); // نوع برگزاری
            $table->string('link')->nullable(); // لینک گوگل میت یا لینک ویدیو
            $table->string('video')->nullable(); // فایل ویدیو
            $table->integer('capacity')->nullable(); // ظرفیت
            $table->string('age_group')->nullable(); // رده سنی
            $table->unsignedBigInteger('city_id')->nullable(); // شهر برای حضوری
            $table->integer('comments_count')->default(0); // تعداد نظرات
            $table->decimal('rate', 3, 2)->default(0); // امتیاز
            $table->integer('participants_count')->default(0); // تعداد شرکت کننده
            $table->integer('views')->default(0); // تعداد بازدید
            $table->timestamps();

            // روابط
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workshops');
    }
};
