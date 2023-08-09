<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mskota extends Model
{
    use HasFactory;

    protected $table = 'mskota';
    protected $primaryKey = 'kta_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'kta_nm', 'kta_notes'
    ];
}
