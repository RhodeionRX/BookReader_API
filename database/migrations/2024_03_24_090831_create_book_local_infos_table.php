<?php

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
        Schema::create('book_local_infos', function (Blueprint $table) {
            $table->id()->always();
            $table->string('title', 100)->nullable(false);
            $table->text('description')->nullable(true);
            $table->enum('language', LanguagesEnum::values())->nullable(false);
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
        Schema::dropIfExists('book_local_infos');
    }
};
