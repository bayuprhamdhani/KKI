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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('country');
            $table->unsignedBigInteger('province');
            $table->unsignedBigInteger('city');
            $table->unsignedBigInteger('subdistrict');
            $table->unsignedBigInteger('status');
            $table->string('logo');
            $table->unsignedBigInteger('bank');
            $table->string('norek');
            $table->string('contact');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('bank')->references('id')->on('banks');
            $table->foreign('status')->references('id')->on('statuses');
            $table->foreign('country')->references('id')->on('countries');
            $table->foreign('province')->references('id')->on('provinces');
            $table->foreign('city')->references('id')->on('cities');
            $table->foreign('subdistrict')->references('id')->on('subdistricts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
