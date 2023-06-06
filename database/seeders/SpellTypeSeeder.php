<?php

namespace Database\Seeders;

use App\Models\SpellType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpellTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spellTypes = ['Normal','Continuous','Equip','Quick-Play','Field','Ritual'];
        foreach ($spellTypes as $spellType) {
            SpellType::create([
                'name'=>$spellType,
                'slug'=>Str::slug($spellType,'-')
            ]);
        }
    }
}
