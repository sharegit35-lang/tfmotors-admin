<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // ១. បង្កើតតួនាទី (Roles) ចំនួន ២
        $adminRole = Role::create(['name' => 'Admin']);
        $staffRole = Role::create(['name' => 'Staff']);

        // ២. បង្កើតគណនីមេ (Super Admin)
        $adminUser = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@tfmotors.com', // ទុកសម្រាប់ Login
            'password' => Hash::make('password123'), // លេខសម្ងាត់ Login
        ]);
        // ភ្ជាប់សិទ្ធិ Admin ទៅឲ្យគណនីនេះ
        $adminUser->assignRole($adminRole);

        // ៣. បង្កើតគណនីបុគ្គលិកធម្មតា
        $staffUser = User::create([
            'name' => 'General Staff',
            'email' => 'staff@tfmotors.com',
            'password' => Hash::make('password123'),
        ]);
        // ភ្ជាប់សិទ្ធិ Staff ទៅឲ្យគណនីនេះ
        $staffUser->assignRole($staffRole);
    }
}