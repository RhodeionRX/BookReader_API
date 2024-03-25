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
        Schema::create('book_translations', function (Blueprint $table) {
            $table->id()->always();
            $table->string('title', 100)->nullable(false);
            $table->string('description', 255);
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->timestampsTz();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_translations');
    }
};
