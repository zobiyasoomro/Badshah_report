<?php
// database/migrations/2026_07_19_create_withdrawals_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_method_id')->nullable()->constrained('payment_methods')->onDelete('set null');
            
            // User details (auto-filled from users table)
            $table->string('user_name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('whatsapp_number')->nullable();
            
            // Withdrawal details
            $table->string('account_holder_name')->nullable();
            $table->string('account_number')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('payment_method')->nullable(); // mobile_wallet or bank
            $table->string('bank_name')->nullable();
            $table->string('iban_number')->nullable();
            $table->string('card_number')->nullable();
            $table->string('branch_code')->nullable();
            
            // Status fields
            $table->enum('status', ['pending', 'approved', 'declined', 'completed'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('declined_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('user_id');
            $table->index('status');
            $table->index('payment_method_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('withdrawals');
    }
};