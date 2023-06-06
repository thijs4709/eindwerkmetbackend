<?php

namespace Database\Seeders;

use App\Models\TrapType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TrapTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trapTypes = ['Normal','Continuous','Counter'];
        foreach ($trapTypes as $trapType) {
            TrapType::create([
                'name'=>$trapType,
                'slug'=>Str::slug($trapType,'-')
            ]);
        }
    }
}
