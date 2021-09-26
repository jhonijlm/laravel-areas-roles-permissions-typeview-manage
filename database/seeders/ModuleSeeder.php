<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $module1 = new Module();
        $module1->name = "Users";
        $module1->slug = "users";
        $module1->save();

        $module2 = new Module();
        $module2->name = "Roles";
        $module2->slug = "roles";
        $module2->save();

        $module3 = new Module();
        $module3->name = "Posts";
        $module3->slug = "posts";
        $module3->save();

    }
}
