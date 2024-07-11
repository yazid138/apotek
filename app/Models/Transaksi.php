<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'input_name',
        'input_date',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
