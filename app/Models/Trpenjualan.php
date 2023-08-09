<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trpenjualan extends Model
{
    use HasFactory;

    protected $table = 'trpenjualan';
    protected $primaryKey = 'jul_id';
    protected $fillable = [
        'jul_id', 'jul_tanggaljual', 'mssalesman_id', 'jul_cus_id', 'jul_notes', 'jul_tanggalbayar', 'jul_batal'
    ];

    public function sales()
    {
        return $this->belongsTo(Mssalesman::class);
    }
}
