<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, temporarily change the enum to allow both 'user' and 'doctor'
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'user', 'doctor'])->default('user')->change();
        });
        
        // Update existing 'user' roles to 'doctor'
        DB::table('users')->where('role', 'user')->update(['role' => 'doctor']);
        
        // Then change the enum to only allow 'admin' and 'doctor'
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'doctor'])->default('doctor')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // First, temporarily change the enum to allow both 'user' and 'doctor'
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'user', 'doctor'])->default('doctor')->change();
        });
        
        // Update existing 'doctor' roles to 'user'
        DB::table('users')->where('role', 'doctor')->update(['role' => 'user']);
        
        // Then change the enum to only allow 'admin' and 'user'
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'user'])->default('user')->change();
        });
    }
}; 