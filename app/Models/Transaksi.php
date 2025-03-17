<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetilTransaksi;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    protected $fillable = ['kode', 'total', 'status'];
    
    public function DetilTransaksi(): HasMany
    {
        return $this->hasMany(DetilTransaksi::class);
    }
}
