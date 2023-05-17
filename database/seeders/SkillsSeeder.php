<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillsSeeder extends Seeder
{
    public function run()
    {
        Skill::insert([
            ['name' => 'Python'],
            ['name' => 'PHP'],
            ['name' => 'GO'],
            ['name' => 'JavaScript'],
            ['name' => 'MySQL'],
            ['name' => 'Postgresql'],
            ['name' => 'Linux'],
        ]);
    }
}

