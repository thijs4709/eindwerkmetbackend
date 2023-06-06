<?php

namespace Database\Seeders;

use App\Models\MonsterType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MonsterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $monstertypes = ['Aqua','Beast','Beast-Warrior','Cyberse','Dinosaur','Divine-Beast','Dragon','Fairy','Fiend','Fish','Insect','Machine','Plant','Psychic','Pyro','Reptile','Rock','Sea Serpent','Spellcaster','Thunder','Warrior','Winged Beast','Wyrm','Zombie'];
        foreach ($monstertypes as $monstertype) {
            MonsterType::create([
                'name'=>$monstertype,
                'slug'=>Str::slug($monstertype,'-')
            ]);
        }
    }
}
