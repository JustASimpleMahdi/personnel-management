<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstname' => 'مبینا',
            'lastname' => 'براهویی',
            'national_code' => '1234567890',
            'username' => 'mobina',
            'password' => '12345678',
            'salary' => 20_000_000,
            'phone' => '09036249486',
            'address'=>'یه جایی در شهسوار',
            'role_id' => Role::where('key',RoleEnum::MANAGER)->first()->id,
        ]);
    }
}
