<?php

namespace Database\Seeders;

use App\Models\CardType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CardTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            $cardtypes = ['Monster','Spell','Trap'];
            foreach ($cardtypes as $cardtype) {
                CardType::create([
                    'name'=>$cardtype,
                    'slug'=>Str::slug($cardtype,'-')
                ]);
            }
        }
    }
}
