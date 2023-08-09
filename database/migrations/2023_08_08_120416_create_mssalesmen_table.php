<?php

use App\Models\Mskota;
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
        Schema::create('mssalesman', function (Blueprint $table) {
            $table->char('sal_id', 4);
            $table->primary('sal_id');
            $table->string('sal_nm', 100);
            $table->date('sal_bekerjasejak')->nullable();
            $table->char('sal_aktif', 1)->default('Y');
            $table->foreignIdFor(Mskota::class)->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mssalesman');
    }
};
