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
        Schema::create('card_types', function (Blueprint $table) {
            $table->id();
            $table->string('card_type');
            $table->timestamps();
            // ->integer
            // ->date
            // ->boolean
            // ->text
            // ->string('code', 5);
            // ->string('name')->nullable();
            // ->enum('status', ['active', nonaktive'])->default('active');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_types');
    }
};
