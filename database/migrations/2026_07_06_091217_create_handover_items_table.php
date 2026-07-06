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
        Schema::create('handover_items', function (Blueprint $table) {
            $table->id();
            // ភ្ជាប់ទៅតារាង handovers (បើលុបលិខិតមេ វានឹងលុបអីវ៉ាន់តាមក្រោយស្វ័យប្រវត្តិ)
            $table->foreignId('handover_id')->constrained()->onDelete('cascade'); 
            
            $table->string('description');
            $table->string('serial_number')->nullable();
            $table->integer('quantity')->default(1);
            $table->string('asset_code')->nullable();
            $table->string('condition')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('handover_items');
    }
};
