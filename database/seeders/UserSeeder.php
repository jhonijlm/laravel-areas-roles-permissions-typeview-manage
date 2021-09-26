<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Guarantee;
use App\Models\StatusUser;
use App\Models\TypeBusiness;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user1 = new User();
        $user1->name = "jhoni";
        $user1->last_name = "ADM";
        $user1->email = "admin@gmail.com";
        $user1->cell_phone = "9246464646464";
        $user1->address = "MZ AJ LT 45 - M - DEV";
        $user1->password = bcrypt("password123");
        $user1->email_verified_at = now();
        $user1->status = 1;
        $user1->save();

        $user1->roles()->sync([Role::get()->first()->id]);


        $user2 = new User();
        $user2->name = "jhoni";
        $user2->last_name = "MG";
        $user2->email = "manager@gmail.com";
        $user2->cell_phone = "78942241244";
        $user2->address = "MZ JW LT 12 - M - DEV";
        $user2->password = bcrypt("password123");
        $user2->email_verified_at = now();
        $user2->status = 1;
        $user2->save();

        $user2->roles()->sync([2]);

        $user3 = new User();
        $user3->name = "jhoni";
        $user3->last_name = "EMP";
        $user3->email = "employee@gmail.com";
        $user3->cell_phone = "78942241244";
        $user3->address = "MZ JW LT 12 - M - DEV";
        $user3->password = bcrypt("password123");
        $user3->email_verified_at = now();
        $user3->status = 1;
        $user3->save();

        $user3->roles()->sync([3]);
    }
}
