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
        Schema::create('handovers', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name');
            $table->string('position')->nullable();
            $table->string('branch'); // សម្រាប់រក្សាទុកឈ្មោះសាខាដូចជា MG Siem Reap
            $table->date('handover_date')->default(now());
            $table->string('status')->default('active'); // active ឬ returned
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('handovers');
    }
};
