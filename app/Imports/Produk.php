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
            if (!isset($col[0]) || !isset($col[1]) || !isset($col[2])) {
                continue;
            }

            $kodedb = ModelProduk::where('kode', $col[0])->first();
            if (!$kodedb) {
                $simpan = new ModelProduk;
                $simpan->kode = $col[0];
                $simpan->nama = $col[1];
                $simpan->harga = is_numeric($col[2]) ? (float) $col[2] : 0; 
                $simpan->stok = $col[3];
                $simpan->save();
            }   
        }
    }
}
