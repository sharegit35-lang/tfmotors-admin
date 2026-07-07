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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // ចំណងជើងការងារ (ឧ. Senior Software Developer)
            $table->string('employment_type')->default('Full Time'); // ប្រភេទការងារ (Full Time, Part Time)
            $table->string('salary_range')->nullable(); // ប្រាក់ខែ (ឧ. $500 - $1000)
            $table->string('location')->default('Phnom Penh, Cambodia'); // ទីតាំង
            $table->text('description')->nullable(); // ព័ត៌មានលម្អិតពីការងារ
            $table->enum('status', ['Open', 'Closed', 'Draft'])->default('Open'); // ស្ថានភាព
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
