<?php

namespace App;

enum RoleEnum:string
{
    case MANAGER = "manager";
    case PURCHASING_MANAGER = "purchasing-manager";
    case SALES_MANAGER = "sales-manager";
    case ACCOUNTANT = "accountant";
    case CASHIER = "cashier";
}
