<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plane_buyers', function (Blueprint $table) {
            // 1. Plane Buyers table ki khud ki primary ID
            $table->id();

            // 2. User ki ID (users table se link)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // 3. Plane ki ID (planes table se link)
            $table->foreignId('plane_id')->constrained('planes')->onDelete('cascade');

            // 4. Screenshot column (jo aapne manga tha)
            $table->string('screenshot')->nullable();

            // 5. Price column (jo plane table se aayegi)
            $table->decimal('price', 15, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plane_buyers');
    }
};