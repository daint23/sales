<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mssalesman extends Model
{
    use HasFactory;

    protected $table = 'mssalesman';
    protected $primaryKey = 'sal_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'sal_id', 'sal_nm', 'sal_bekerjasejak', 'sal_aktif', 'mskota_kta_id'
    ];
    public $timestamps = false;

    public function jual()
    {
        return $this->hasMany(Trpenjualan::class);
    }
}
