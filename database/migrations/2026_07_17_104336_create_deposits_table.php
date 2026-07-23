<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_method_id')->nullable()->constrained('payment_methods')->onDelete('set null');
            $table->string('account_holder_name');
            $table->decimal('amount', 10, 2);
            $table->string('payment_method')->nullable(); // Changed from enum to string
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('branch_code')->nullable();
            $table->string('transaction_id')->unique();
            $table->string('screenshot_path')->nullable();
            $table->boolean('is_receipt_required')->default(false);
            $table->string('receipt_path')->nullable();
            $table->timestamp('receipt_submitted_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->enum('status', ['pending', 'approved', 'declined', 'expired'])->default('pending');
            $table->string('user_bank_name')->nullable()->after('user_account_number');
            $table->string('user_account_holder')->nullable()->after('user_bank_name');
            $table->string('user_branch_code')->nullable()->after('user_account_holder');
            $table->text('admin_notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('declined_at')->nullable();
            $table->timestamps();

            // Add indexes
            $table->index('payment_method_id');
            $table->index('status');
            $table->index('user_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('deposits');
    }
};