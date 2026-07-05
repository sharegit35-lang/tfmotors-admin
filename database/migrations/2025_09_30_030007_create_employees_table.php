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
        Schema::create('employees', function (Blueprint $table) {
        $table->id();
        $table->string('english_name');
        $table->string('khmer_name');
        $table->string('gender');
        $table->string('identity_card');
        $table->string('cambodian_passport')->nullable();
        $table->string('phone')->nullable();
        $table->string('position')->nullable();
        $table->string('department_name')->nullable();
        $table->string('branch_name')->nullable();
        $table->date('date_of_birth')->nullable();
        $table->date('start_work')->nullable();
        $table->decimal('salary', 10, 2)->nullable();
        $table->date('hire_date')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
