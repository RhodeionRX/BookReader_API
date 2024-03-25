<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\LanguagesEnum;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $allowedLanguages = LanguagesEnum::values();
        Schema::create('languages', function (Blueprint $table) use ($allowedLanguages) {
            $table->id()->always();
            $table->enum('code', $allowedLanguages)->default(LanguagesEnum::En);
            $table->string('code', 5)->change();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
