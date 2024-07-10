<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'stock',
        'safety_stock',
        'no_batch',
        'expired_date',
        'input_name',
        'input_date',
    ];
}
