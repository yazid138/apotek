<?php

namespace App\Models;

use App\Models\Obat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'jumlah',
        'satuan',
        'input_date',
    ];

    protected $casts = [
        'input_date' => 'datetime:d-m-Y',
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}
