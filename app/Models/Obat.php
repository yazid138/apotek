<?php

namespace App\Models;

use App\Models\Pengadaan;
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

    protected $casts = [
        'expired_date' => 'datetime:d-m-Y',
        'input_date' => 'datetime:d-m-Y',
    ];

    public function pengadaan()
    {
        return $this->hasOne(Pengadaan::class);
    }
}
