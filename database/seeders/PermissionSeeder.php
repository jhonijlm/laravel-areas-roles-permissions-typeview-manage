<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission00 = new Permission();
        $permission00->name = "Index";
        $permission00->slug = "index";
        $permission00->save();//

        $permission0 = new Permission();
        $permission0->name = "List";
        $permission0->slug = "list";
        $permission0->save();//

        $permission1 = new Permission();
        $permission1->name = "Get";
        $permission1->slug = "get";
        $permission1->save();

        $permission2 = new Permission();
        $permission2->name = "Create";
        $permission2->slug = "create";
        $permission2->save();

        $permission3 = new Permission();
        $permission3->name = "Update";
        $permission3->slug = "update";
        $permission3->save();

        $permission4 = new Permission();
        $permission4->name = "Delete";
        $permission4->slug = "delete";
        $permission4->save();
    }
}
