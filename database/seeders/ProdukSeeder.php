<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        Produk::insert([
            [
                'nama' => 'Batik Mega Mendung',
                'kode' => 'BATIK001',
                'harga' => 150000,
                'stok' => 10,
            ],
            [
                'nama' => 'Batik Parang',
                'kode' => 'BATIK002',
                'harga' => 175000,
                'stok' => 8,
            ],
            [
                'nama' => 'Batik Kawung',
                'kode' => 'BATIK003',
                'harga' => 160000,
                'stok' => 12,
            ],
            [
                'nama' => 'Batik Sidomukti',
                'kode' => 'BATIK004',
                'harga' => 180000,
                'stok' => 7,
            ],
            [
                'nama' => 'Batik Truntum',
                'kode' => 'BATIK005',
                'harga' => 155000,
                'stok' => 15,
            ],
            [
                'nama' => 'Batik Sekar Jagad',
                'kode' => 'BATIK006',
                'harga' => 190000,
                'stok' => 9,
            ],
            [
                'nama' => 'Batik Tambal',
                'kode' => 'BATIK007',
                'harga' => 165000,
                'stok' => 11,
            ],
            [
                'nama' => 'Batik Ceplok',
                'kode' => 'BATIK008',
                'harga' => 170000,
                'stok' => 13,
            ],
            [
                'nama' => 'Batik Lereng',
                'kode' => 'BATIK009',
                'harga' => 185000,
                'stok' => 6,
            ],
            [
                'nama' => 'Batik Ciptoning',
                'kode' => 'BATIK010',
                'harga' => 200000,
                'stok' => 5,
            ],
            [
                'nama' => 'Batik Pisan Bali',
                'kode' => 'BATIK011',
                'harga' => 210000,
                'stok' => 7,
            ],
            [
                'nama' => 'Batik Jlamprang',
                'kode' => 'BATIK012',
                'harga' => 175000,
                'stok' => 9,
            ],
            [
                'nama' => 'Batik Udan Liris',
                'kode' => 'BATIK013',
                'harga' => 190000,
                'stok' => 8,
            ],
            [
                'nama' => 'Batik Modang',
                'kode' => 'BATIK014',
                'harga' => 220000,
                'stok' => 4,
            ],
            [
                'nama' => 'Batik Pring Sedapur',
                'kode' => 'BATIK015',
                'harga' => 195000,
                'stok' => 10,
            ],
            [
                'nama' => 'Batik Ratu Ratih',
                'kode' => 'BATIK016',
                'harga' => 185000,
                'stok' => 6,
            ],
            [
                'nama' => 'Batik Singa Barong',
                'kode' => 'BATIK017',
                'harga' => 230000,
                'stok' => 3,
            ],
            [
                'nama' => 'Batik Wahyu Tumurun',
                'kode' => 'BATIK018',
                'harga' => 200000,
                'stok' => 7,
            ],
            [
                'nama' => 'Batik Sido Asih',
                'kode' => 'BATIK019',
                'harga' => 170000,
                'stok' => 11,
            ],
            [
                'nama' => 'Batik Sido Luhur',
                'kode' => 'BATIK020',
                'harga' => 210000,
                'stok' => 5,
            ],
        ]);
    }
}
