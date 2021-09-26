<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Role;
use App\Models\Module;
use App\Models\TypeView;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role1 = new Role();
        $role1->name = "Administrator";
        $role1->slug = "administrator";
        $role1->status = 1;
        $role1->save();


        $role2 = new Role();
        $role2->name = "Manager";
        $role2->slug = "manager";
        $role2->status = 1;
        $role2->save();

        $role3 = new Role();
        $role3->name = "Employee";
        $role3->slug = "employee";
        $role3->status = 1;
        $role3->save();
    }

}
