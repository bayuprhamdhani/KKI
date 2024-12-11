
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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('qty');
            $table->unsignedBigInteger('transmisi')->nullable();
            $table->string('price');
            $table->string('pict');
            $table->unsignedBigInteger('status')->nullable();
            $table->rememberToken();
            $table->timestamps();
            
            $table->foreign('transmisi')->references('id')->on('transmisies');
            $table->foreign('status')->references('id')->on('statuses');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
