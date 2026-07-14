<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->longText('description');
            $table->string('logo')->nullable();           // Logo image path
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('about_pages');
    }
};