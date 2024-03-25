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
        Schema::create('text_lines', function (Blueprint $table) {
            $table->unsignedBigInteger('key');
            $table->text('content');
            $table->foreignId('translation_id')->constrained(table: 'book_translations')->onDelete('cascade');
            $table->primary(['key', 'translation_id']);
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('text_lines');
    }
};
