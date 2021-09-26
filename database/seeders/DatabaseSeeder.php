<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\AreaSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ModuleSeeder;
use Database\Seeders\TypeViewSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\AccessDetailSeeder;
use Database\Seeders\ModuleAreaPermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            AreaSeeder::class,
            PermissionSeeder::class,
            ModuleSeeder::class,
            TypeViewSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            ModuleAreaPermissionSeeder::class,
            AccessDetailSeeder::class,
        ]);

        User::factory(40)->create()->each(function($u) {
            $u->roles()->sync(Role::all()->random()->first()->id);
        });

        Post::factory(40)->create();

    }
}
