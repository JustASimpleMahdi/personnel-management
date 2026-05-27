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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // نام فایل ذخیره شده در دیسک (مثلا: profile_images/xyz.jpg)
            $table->string('original_name')->nullable(); // نام اصلی فایل آپلود شده
            $table->string('path'); // مسیر کامل فایل در صورت نیاز (مثلا: [/mnt/data/storage/app/public/profile_images/xyz.jpg](https://storage.gapgpt.app/media/code_interpreter/3c4cd761-ffd6-4291-ae66-8f9932c278c0/xyz.jpg)) - یا می‌توانیم فقط filename را داشته باشیم و filepath را با config بسازیم
            $table->string('extension');
            $table->string('mime_type')->nullable(); // مثال: image/jpeg, application/pdf
            $table->unsignedBigInteger('size')->nullable(); // اندازه فایل بر حسب بایت
            $table->string('disk')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
