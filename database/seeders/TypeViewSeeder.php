<?php

namespace Database\Seeders;

use App\Models\TypeView;
use Illuminate\Database\Seeder;

class TypeViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $typeView1 = new TypeView();
        $typeView1->name = "Total";
        $typeView1->slug = "total";
        $typeView1->save();

        $typeView2 = new TypeView();
        $typeView2->name = "Partial";
        $typeView2->slug = "partial";
        $typeView2->save();
    }
}
