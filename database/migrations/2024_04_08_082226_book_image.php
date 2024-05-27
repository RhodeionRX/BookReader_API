<?php

use App\Enums\ImageStatusEnum;
use App\Enums\LanguagesEnum;
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
        Schema::create('book_images', function (Blueprint $table) {
            $table->id()->always();
            $table->text('content')->nullable(false);
            $table->enum('status', ImageStatusEnum::values())->nullable(false)->default(ImageStatusEnum::Additional);
            $table->foreignId('detail_id')->constrained(table: 'book_details')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_images');
    }
};
