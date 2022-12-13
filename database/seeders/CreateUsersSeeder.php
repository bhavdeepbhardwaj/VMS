<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = [
            [
               'admin_name'     =>'Admin',
               'company_name'   =>'Developer',
               'email'          =>'admin@globalsync.com.au',
               'company_phone'          =>'9876543211',
               'is_admin'       =>'1',
               'role'           =>'1',
               'password'       => bcrypt('Admin@123'),
            ],
            [
               'admin_name'    =>'User',
               'company_name'  =>'Globalsync',
               'email'         =>'user@globalsync.com.au',
               'company_phone'         =>'9876543210',
               'is_admin'      =>'2',
               'role'          =>'2',
               'password'       => bcrypt('User@123'),
            ],
            [
                'admin_name'           =>'Demo',
                'company_name'      =>'Demo',
                'email'          =>'demo@demo.com.au',
                'company_phone'          =>'9999900000',
                'is_admin'       =>'0',
                'role'           =>'0',
                'password'       => bcrypt('Demo@123'),
             ],

        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
