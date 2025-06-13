<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->string('payment_type')->nullable()->after('payment_method'); 
            $table->string('payment_provider')->nullable()->after('payment_type'); 
            $table->string('virtual_account')->nullable()->after('payment_provider');
            $table->string('qr_code')->nullable()->after('virtual_account');
            $table->timestamp('payment_expiry')->nullable()->after('qr_code');
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn([
                'payment_type',
                'payment_provider',
                'virtual_account',
                'qr_code',
                'payment_expiry'
            ]);
        });
    }
};
