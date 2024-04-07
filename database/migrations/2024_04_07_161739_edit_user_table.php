<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name', 25)->change();
            $table->string('login', 75)->nullable(true);
            $table->softDeletesTz();
        });

        // fill the login column with email values, user can change their login in the future
        DB::table('users')->update([
            'login' => DB::raw('email')
        ]);

        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'nickname');
            $table->string('login', 75)->nullable(false)->unique()->change();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_login_unique');
            $table->dropColumn('login');
            $table->renameColumn('nickname', 'name');
            $table->dropSoftDeletesTz();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('name', 25)->change();
        });
    }
};
