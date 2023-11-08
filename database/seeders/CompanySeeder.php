<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
