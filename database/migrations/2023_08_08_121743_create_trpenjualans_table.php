<?php

use App\Models\Mssalesman;
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
        Schema::create('trpenjualan', function (Blueprint $table) {
            $table->integer('jul_id', 11)->autoIncrement();
            $table->date('jul_tanggaljual');
            $table->foreignIdFor(Mssalesman::class)->nullable();
            $table->char('jul_cus_id', 4)->nullable();
            $table->string('jul_notes', 100)->nullable();
            $table->date('jul_tanggalbayar')->nullable()->comment('null jika belum bayar, terisi jika sudah bayar');
            $table->char('jul_batal', 1)->default('N')->comment('N = tidak batal, Y = jika dibatalkan');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trpenjualan');
    }
};
