<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        Company::create([
            'name' => 'Dan Manu Company',
            'address' => '123 Main St',
            'email' => 'danmanu@example.com',
            'phone' => '123-456-7890',
            'description' => 'This is dan manu.',
        ]);

        Company::create([
            'name' => 'Humsad Global Concept Company',
            'address' => '456 Elm St',
            'email' => 'humsad@example.com',
            'phone' => '987-654-3210',
            'description' => 'This is Humsad global concept Company 2.',
        ]);
        
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
