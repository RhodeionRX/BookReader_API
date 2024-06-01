<?php

namespace Database\Seeders;

use App\Enums\Users\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (RoleEnum::cases() as $role) {
            DB::table('roles')->insert([
                'code' => $role->value
            ]);
        }
    }
}
