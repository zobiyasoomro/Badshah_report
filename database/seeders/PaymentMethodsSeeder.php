<?php
// database/seeders/PaymentMethodsSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodsSeeder extends Seeder
{
    public function run()
    {
        // Mobile Wallets
        PaymentMethod::create([
            'name' => 'EasyPaisa',
            'type' => 'mobile_wallet',
            'account_holder_name' => 'Muhammad Ahmed',
            'account_number' => '03001234567',
            'deep_link_scheme' => 'easypaisa://',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        PaymentMethod::create([
            'name' => 'JazzCash',
            'type' => 'mobile_wallet',
            'account_holder_name' => 'Muhammad Ahmed',
            'account_number' => '03098765432',
            'deep_link_scheme' => 'jazzcash://',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        // Banks
        PaymentMethod::create([
            'name' => 'Meezan Bank',
            'type' => 'bank',
            'account_holder_name' => 'Muhammad Ahmed',
            'account_number' => '12345678901234',
            'account_iban' => 'PK99MEZN0001234567890123',
            'branch_code' => '0123',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        PaymentMethod::create([
            'name' => 'Habib Bank Limited (HBL)',
            'type' => 'bank',
            'account_holder_name' => 'Muhammad Ahmed',
            'account_number' => '98765432109876',
            'account_iban' => 'PK88HBLB0009876543210987',
            'branch_code' => '0456',
            'is_active' => true,
            'sort_order' => 4,
        ]);

        PaymentMethod::create([
            'name' => 'Bank Alfalah',
            'type' => 'bank',
            'account_holder_name' => 'Muhammad Ahmed',
            'account_number' => '56789012345678',
            'account_iban' => 'PK77ALFH0005678901234567',
            'branch_code' => '0789',
            'is_active' => true,
            'sort_order' => 5,
        ]);
    }
}