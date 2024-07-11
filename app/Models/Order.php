<?php

namespace App\Models;

use App\Models\Obat;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'qty',
        'obat_id',
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
