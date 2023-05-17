<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionsSeeder extends Seeder
{
    public function run()
    {
        Position::insert([
            ['name' => 'Chief Technology Officer'],
            ['name' => 'Full-Stack Developer'],
            ['name' => 'Software Developer'],
            ['name' => 'Web Developer'],
            ['name' => 'Backend Developer'],
            ['name' => 'Frontend Developer'],
            ['name' => 'Mobile Developer'],
            ['name' => 'DevOps Engineer'],
        ]);
    }
}

