<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password=Hash::make('superadmin@123');
        User::create(['id' => 1, 'fname' => 'Super', 'lname' => 'Admin', 'username' => 'super_admin', 'email' => 'superadmin@aimscal.com', 'phone' => '3001231231', 'email_verified_at' => '2022-06-12 00:37:13', 'password' => $password, 'gender' => 'Male', 'role' => 1, 'email_code' => NULL, 'coa' => NULL, 'profile' => 'coin.png',]);
    }
}
