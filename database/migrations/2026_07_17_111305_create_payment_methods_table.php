<?php
// database/migrations/2024_01_01_create_payment_methods_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // EasyPaisa, JazzCash, Bank Name
            $table->string('type')->default('mobile_wallet'); // mobile_wallet, bank
            $table->string('account_holder_name');
            $table->string('account_number');
            $table->string('account_iban')->nullable(); // For banks
            $table->string('branch_code')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('deep_link_scheme')->nullable(); // easypaisa://, jazzcash://
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_methods');
    }
};