<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Produk as ModelProduk;
use Maatwebsite\Excel\Concerns\WithStartRow;

class Produk implements ToCollection, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

    public function collection(Collection $collection): void
    {
        foreach ($collection as $col) {
            $kodedb = ModelProduk::where('kode', $col[0])->first();
            if (!$kodedb) {
                $simpan = new ModelProduk;
                $simpan->kode = $col[1];
                $simpan->nama = $col[2];
                $simpan->harga = $col[3];
                $simpan->stok = 10;
                $simpan->save();
            }   
        }
    }
}
