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
        Schema::create('transmisies', function (Blueprint $table) {
            $table->id();
            $table->string('transmisi');
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
        Schema::dropIfExists('transmisies');
    }
};
