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
        Schema::create('type_effectiveness', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attacking_type_id');
            $table->unsignedBigInteger('defending_type_id');
            $table->decimal('effectiveness', 3, 1);
            $table->timestamps();

            $table->foreign('attacking_type_id')->references('id')->on('types');
            $table->foreign('defending_type_id')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_effectiveness');
    }
};
