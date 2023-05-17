<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(PositionsSeeder::class);
        $this->call(SkillsSeeder::class);
        $this->call(LanguagesSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
