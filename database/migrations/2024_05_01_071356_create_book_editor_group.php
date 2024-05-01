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
        Schema::create('book_editor_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('book_id')
                ->constrained('books')
                ->cascadeOnDelete();
            $table->json('permissions')->nullable();
        });

        Schema::table('books', function (Blueprint $table) {
            $table->foreignId('created_by')
                ->nullable()
                ->constrained(table: 'users')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });

        Schema::table('book_entity', function (Blueprint $table) {
            $table->foreignId('initial_author_id')
                ->nullable()
                ->constrained(
                    table: 'users',
                    column: 'id'
                )
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_editor_group');
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['created_by', 'updated_by']);
        });
        Schema::table('book_entity', function (Blueprint $table) {
            $table->dropColumn(['initial_author_id']);
        });
    }
};
