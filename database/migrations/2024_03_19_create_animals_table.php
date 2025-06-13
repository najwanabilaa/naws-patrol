<?php
// database/migrations/xxxx_create_animals_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // cats, dogs, birds, rabbits
            $table->string('breed');
            $table->text('description');
            $table->string('gender');
            $table->string('age');
            $table->enum('status', ['available', 'pending', 'adopted'])->default('available');
            $table->string('image_path');
            $table->string('location')->nullable();
            $table->string('color')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
