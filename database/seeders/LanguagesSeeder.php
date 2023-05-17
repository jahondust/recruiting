<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    public function run()
    {
        Language::insert([
            ['name' => 'English'],
            ['name' => 'O`zbek'],
            ['name' => 'Русский'],
        ]);
    }
}

