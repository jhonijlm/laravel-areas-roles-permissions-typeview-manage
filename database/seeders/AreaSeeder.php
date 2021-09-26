<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $area1 = new Area();
        $area1->name = "Administrator";
        $area1->slug = "administrator";
        $area1->save();

        $area2 = new Area();
        $area2->name = "Manager";
        $area2->slug = "manager";
        $area2->save();

        $area3 = new Area();
        $area3->name = "Employee";
        $area3->slug = "employee";
        $area3->save();
    }
}
