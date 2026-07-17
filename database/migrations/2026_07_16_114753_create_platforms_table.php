<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('platforms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('subtitle')->nullable();
            $table->text('description');
            $table->string('logo')->nullable();       // path under public/images
            $table->string('website_url')->nullable(); // used by the "Learn More" button
            $table->string('join_url')->nullable();    // used by the "Join" button
            $table->boolean('status')->default(true);  // true = Online, false = Offline
            $table->integer('sort_order')->default(0); // controls display order on the frontend
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('platforms');
    }
};