<?php

namespace Database\Seeders;

use App\Models\MonsterSpecialType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MonsterSpecialTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $monsterSpecialTypes = ['Gemini','Spirit','Toon','Tuner','Union'];
        foreach ($monsterSpecialTypes as $monsterSpecialType) {
            MonsterSpecialType::create([
                'name'=>$monsterSpecialType,
                'slug'=>Str::slug($monsterSpecialType,'-')
            ]);
        }
    }
}
