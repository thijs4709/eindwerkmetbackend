<?php

namespace Database\Seeders;

use App\Models\MonsterAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MonsterAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $monsterAttributes = ['Dark','Divine','Earth','Fire','Light','Water','Wind'];
        foreach ($monsterAttributes as $monsterAttribute) {
            MonsterAttribute::create([
                'name'=>$monsterAttribute,
                'slug'=>Str::slug($monsterAttribute,'-')
            ]);
        }
    }
}
