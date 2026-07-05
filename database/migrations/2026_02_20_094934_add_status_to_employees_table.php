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
        Schema::table('employees', function (Blueprint $table) {
            // Adding the status column with 'active' as the default
            $table->string('status')->default('active')->after('salary');
        });
    }
    
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};