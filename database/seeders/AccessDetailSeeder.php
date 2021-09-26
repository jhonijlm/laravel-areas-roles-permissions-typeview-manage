<?php

namespace Database\Seeders;

use App\Models\AccessDetail;
use Illuminate\Database\Seeder;

class AccessDetailSeeder extends Seeder
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
                "role_id" => 1, // ADMIN
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 1,    // USERS
                "permission_id" => 1,
                "type_view_id" => 1
            ],
            [
                "role_id" => 1, // ADMIN
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 1,    // USERS
                "permission_id" => 2,
                "type_view_id" => 1
            ],
            [
                "role_id" => 1, // ADMIN
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 1,    // USERS
                "permission_id" => 3,
                "type_view_id" => 1
            ],
            [
                "role_id" => 1, // ADMIN
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 1,    // USERS
                "permission_id" => 4,
                "type_view_id" => 1
            ],
            [
                "role_id" => 1, // ADMIN
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 1,    // USERS
                "permission_id" => 5,
                "type_view_id" => 1
            ],
            [
                "role_id" => 1, // ADMIN
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 1,   // USERS
                "permission_id" => 6,
                "type_view_id" => 1
            ],


            [
                "role_id" => 1, // ADMIN
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 2, // ROLES
                "permission_id" => 1,
                "type_view_id" => 1
            ],
            [
                "role_id" => 1, // ADMIN
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 2, // ROLES
                "permission_id" => 2,
                "type_view_id" => 1
            ],
            [
                "role_id" => 1, // ADMIN
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 2, // ROLES
                "permission_id" => 3,
                "type_view_id" => 1
            ],
            [
                "role_id" => 1, // ADMIN
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 2, // ROLES
                "permission_id" => 4,
                "type_view_id" => 1
            ],
            [
                "role_id" => 1, // ADMIN
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 2, // ROLES
                "permission_id" => 5,
                "type_view_id" => 1
            ],
            [
                "role_id" => 1, // ADMIN
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 2, // ROLES
                "permission_id" => 6,
                "type_view_id" => 1
            ],


            [
                "role_id" => 1, // ADMIN
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 3, // POSTS
                "permission_id" => 1,
                "type_view_id" => 1
            ],
            [
                "role_id" => 1, // ADMIN
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 3, // POSTS
                "permission_id" => 2,
                "type_view_id" => 1
            ],
            [
                "role_id" => 1, // ADMIN
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 3, // POSTS
                "permission_id" => 3,
                "type_view_id" => 1
            ],
            [
                "role_id" => 1, // ADMIN
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 3, // POSTS
                "permission_id" => 4,
                "type_view_id" => 1
            ],
            [
                "role_id" => 1, // ADMIN
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 3, // POSTS
                "permission_id" => 5,
                "type_view_id" => 1
            ],
            [
                "role_id" => 1, // ADMIN
                "area_id" => 1, // ADMINISTRATOR
                "module_id" => 3, // POSTS
                "permission_id" => 6,
                "type_view_id" => 1
            ],

            // MANAGER
            [
                "role_id" => 2, // MANAGER
                "area_id" => 2, // MANAGER
                "module_id" => 3, // POSTS
                "permission_id" => 1,
                "type_view_id" => 1
            ],
            [
                "role_id" => 2, // MANAGER
                "area_id" => 2, // MANAGER
                "module_id" => 3, // POSTS
                "permission_id" => 2,
                "type_view_id" => 1
            ],
            [
                "role_id" => 2, // MANAGER
                "area_id" => 2, // MANAGER
                "module_id" => 3, // POSTS
                "permission_id" => 3,
                "type_view_id" => 1
            ],
            [
                "role_id" => 2, // MANAGER
                "area_id" => 2, // MANAGER
                "module_id" => 3, // POSTS
                "permission_id" => 4,
                "type_view_id" => 1
            ],
            [
                "role_id" => 2, // MANAGER
                "area_id" => 2, // MANAGER
                "module_id" => 3, // POSTS
                "permission_id" => 5,
                "type_view_id" => 1
            ],
            [
                "role_id" => 2, // MANAGER
                "area_id" => 2, // MANAGER
                "module_id" => 3, // POSTS
                "permission_id" => 6,
                "type_view_id" => 1
            ],

            // EMPLOYEE
            [
                "role_id" => 3, // MANAGER
                "area_id" => 3, // MANAGER
                "module_id" => 3, // POSTS
                "permission_id" => 1,
                "type_view_id" => 2
            ],
            [
                "role_id" => 3, // MANAGER
                "area_id" => 3, // MANAGER
                "module_id" => 3, // POSTS
                "permission_id" => 2,
                "type_view_id" => 2
            ],
            [
                "role_id" => 3, // MANAGER
                "area_id" => 3, // MANAGER
                "module_id" => 3, // POSTS
                "permission_id" => 3,
                "type_view_id" => 2
            ],
            [
                "role_id" => 3, // MANAGER
                "area_id" => 3, // MANAGER
                "module_id" => 3, // POSTS
                "permission_id" => 4,
                "type_view_id" => 2
            ],
            [
                "role_id" => 3, // MANAGER
                "area_id" => 3, // MANAGER
                "module_id" => 3, // POSTS
                "permission_id" => 5,
                "type_view_id" => 2
            ],

        ];

        AccessDetail::insert($data);
    }
}
