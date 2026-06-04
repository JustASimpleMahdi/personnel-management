<?php

use App\RoleEnum;

return [
    'key' => [
        RoleEnum::MANAGER->value => 'مدیریت',
        RoleEnum::PURCHASING_MANAGER->value => 'مسئول خرید',
        RoleEnum::SALES_MANAGER->value => 'مسئول فروش',
        RoleEnum::ACCOUNTANT->value => 'حسابدار',
        RoleEnum::CASHIER->value => 'صندوقدار',
    ]
];
