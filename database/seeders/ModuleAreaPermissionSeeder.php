<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModuleAreaPermission;

class ModuleAreaPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [

            [
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 1,    // USERS
                "permission_id" => 1
            ],
            [
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 1,    // USERS
                "permission_id" => 2
            ],
            [
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 1,    // USERS
                "permission_id" => 3
            ],
            [
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 1,    // USERS
                "permission_id" => 4
            ],
            [
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 1,    // USERS
                "permission_id" => 5
            ],
            [
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 1,   // USERS
                "permission_id" => 6
            ],


            [
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 2, // ROLES
                "permission_id" => 1
            ],
            [
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 2, // ROLES
                "permission_id" => 2
            ],
            [
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 2, // ROLES
                "permission_id" => 3
            ],
            [
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 2, // ROLES
                "permission_id" => 4
            ],
            [
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 2, // ROLES
                "permission_id" => 5
            ],
            [
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 2, // ROLES
                "permission_id" => 6
            ],


            [
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 3, // POSTS
                "permission_id" => 1
            ],
            [
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 3, // POSTS
                "permission_id" => 2
            ],
            [
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 3, // POSTS
                "permission_id" => 3
            ],
            [
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 3, // POSTS
                "permission_id" => 4
            ],
            [
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 3, // POSTS
                "permission_id" => 5
            ],
            [
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 3, // POSTS
                "permission_id" => 6
            ],

            // MANAGER
            [
                "area_id" => 2, // MANAGER
                "module_id" => 3, // POSTS
                "permission_id" => 1,
            ],
            [
                "area_id" => 2, // MANAGER
                "module_id" => 3, // POSTS
                "permission_id" => 2,
            ],
            [
                "area_id" => 2, // MANAGER
                "module_id" => 3, // POSTS
                "permission_id" => 3,
            ],
            [
                "area_id" => 2, // MANAGER
                "module_id" => 3, // POSTS
                "permission_id" => 4,
            ],
            [
                "area_id" => 2, // MANAGER
                "module_id" => 3, // POSTS
                "permission_id" => 5,
            ],
            [
                "area_id" => 2, // MANAGER
                "module_id" => 3, // POSTS
                "permission_id" => 6,
            ],

            // EMPLOYEE
            [
                "area_id" => 3, // MANAGER
                "module_id" => 3, // POSTS
                "permission_id" => 1,
            ],
            [
                "area_id" => 3, // MANAGER
                "module_id" => 3, // POSTS
                "permission_id" => 2,
            ],
            [
                "area_id" => 3, // MANAGER
                "module_id" => 3, // POSTS
                "permission_id" => 3,
            ],
            [
                "area_id" => 3, // MANAGER
                "module_id" => 3, // POSTS
                "permission_id" => 4,
            ],
            [
                "area_id" => 3, // MANAGER
                "module_id" => 3, // POSTS
                "permission_id" => 5,
            ],
        ];

        ModuleAreaPermission::insert($data);
    }
}
