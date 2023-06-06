<?php

namespace Database\Seeders;

use App\Models\MonsterClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MonsterClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $monsterClasses = ['Normal','Effect','Ritual','Fusion','Synchro','Xyz','Link'];
        foreach ($monsterClasses as $monsterClass) {
            MonsterClass::create([
                'name'=>$monsterClass,
                'slug'=>Str::slug($monsterClass,'-')
            ]);
        }
    }
}
