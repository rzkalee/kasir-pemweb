<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Transaksi;
use App\Models\Produk;

class DetilTransaksi extends Model
{
    use HasFactory;

    protected $fillable = ['transaksi_id', 'produk_id', 'jumlah'];

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class);
    }
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }
}
