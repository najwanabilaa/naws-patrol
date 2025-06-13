<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('pet_name');
            $table->string('pet_breed')->nullable();
            $table->string('pet_location')->nullable();
            $table->string('pet_age')->nullable();
            $table->string('pet_color')->nullable();
            $table->string('pet_gender')->nullable();
            $table->text('pet_description')->nullable();
            $table->string('pet_image')->nullable();
            $table->string('pet_category')->nullable();
  
            $table->string('full_name');
            $table->integer('age');
            $table->text('address');
            $table->string('house_type');
            $table->string('daily_activity');
            $table->text('reason');

            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->text('admin_notes')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adoptions');
    }
};
