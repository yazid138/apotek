<?php

namespace App\Models;

use App\Models\Pengadaan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Obat extends Model
{
    use HasFactory, SoftDeletes;

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

    protected $casts = [
        'expired_date' => 'datetime:d-m-Y',
        'input_date' => 'datetime:d-m-Y',
    ];

    public function pengadaan()
    {
        return $this->hasOne(Pengadaan::class);
    }
}
