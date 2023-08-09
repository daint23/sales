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
        Schema::create('mskota', function (Blueprint $table) {
            $table->char('kta_id', 3);
            $table->primary('kta_id');
            $table->string('kta_nm', 100);
            $table->string('kta_notes', 100)->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mskota');
    }
};
