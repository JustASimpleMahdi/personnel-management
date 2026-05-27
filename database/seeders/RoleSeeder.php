<?php

namespace Database\Seeders;

use App\Models\Role;
use App\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::createOrFirst(['key' => RoleEnum::MANAGER],[
            'key' => RoleEnum::MANAGER,
            'name'=> 'مدیریت'
        ]);
        Role::createOrFirst(['key' => RoleEnum::PURCHASING_MANAGER],[
            'key' => RoleEnum::PURCHASING_MANAGER,
            'name'=> 'مسئول خرید'
        ]);
        Role::createOrFirst(['key' => RoleEnum::SALES_MANAGER],[
            'key' => RoleEnum::SALES_MANAGER,
            'name'=> 'مسئول فروش'
        ]);
        Role::createOrFirst(['key' => RoleEnum::ACCOUNTANT],[
            'key' => RoleEnum::ACCOUNTANT,
            'name'=> 'حسابدار'
        ]);
        Role::createOrFirst(['key' => RoleEnum::CASHIER],[
            'key' => RoleEnum::CASHIER,
            'name'=> 'صندوقدار'
        ]);
    }
}
