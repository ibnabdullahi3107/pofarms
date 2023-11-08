<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

       
        $company1 = Company::find(1);
        $company2 = Company::find(2);



         User::create([
            'name' => 'Hafix Dan Manu',
            'address' => '123 User St',
            'phone_number' => '111-111-1111',
            'email' => 'user1@example.com',
            'password' => bcrypt('secret'),
            'company_id' => $company1->id,
        ]);

        User::create([
            'name' => 'HumSad',
            'address' => '456 User St',
            'phone_number' => '222-222-2222',
            'email' => 'user2@example.com',
            'password' => bcrypt('secret'),
            'company_id' => $company2->id,
        ]);


    }
}
