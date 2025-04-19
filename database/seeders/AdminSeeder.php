<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $admins = [
            ['email' => 'admin1@deped.gov.ph', 'password' => 'Admin@1234'],
            ['email' => 'admin2@deped.gov.ph', 'password' => 'Pass@5678'],
            ['email' => 'admin3@deped.gov.ph', 'password' => 'Secure#901'],
            ['email' => 'admin4@deped.gov.ph', 'password' => 'Strong$Pass1'],
            ['email' => 'admin5@deped.gov.ph', 'password' => 'Key123$Safe'],
            ['email' => 'admin6@deped.gov.ph', 'password' => 'MyPass#2024'],
            ['email' => 'admin7@deped.gov.ph', 'password' => 'Safe@Pass!12'],
            ['email' => 'admin8@deped.gov.ph', 'password' => 'Top$Secret123'],
            ['email' => 'admin9@deped.gov.ph', 'password' => 'Guard@9988'],
            ['email' => 'admin10@deped.gov.ph', 'password' => 'Shield#000'],
            ['email' => 'admin11@deped.gov.ph', 'password' => 'Lock@It#Up'],
            ['email' => 'admin12@deped.gov.ph', 'password' => 'Vault$777'],
            ['email' => 'admin13@deped.gov.ph', 'password' => 'Cyber@Sec1'],
            ['email' => 'admin14@deped.gov.ph', 'password' => 'Root#Access9'],
        ];

        foreach ($admins as $admin) {
            $role = match ($admin['email']) {
                'admin12@deped.gov.ph' => 'guidance counselor',
                'admin13@deped.gov.ph' => 'principal',
                default => 'admin',
            };

            Admin::create([
                'email' => $admin['email'],
                'password' => Hash::make($admin['password']),
                'role' => $role,
            ]);
        }
    }
}

