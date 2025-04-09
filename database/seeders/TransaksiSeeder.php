<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID user dengan role kasir
        $kasirIds = User::where('role', 'kasir')->pluck('id')->toArray();

        if (empty($kasirIds)) {
            $this->command->info('Tidak ada user dengan role kasir.');
            return;
        }

        // Buat 20 transaksi di bulan-bulan acak dalam setahun terakhir
        foreach (range(1, 20) as $i) {
            $randomMonthOffset = rand(0, 11);
            $createdAt = Carbon::now()->subMonths($randomMonthOffset)->setDay(rand(1, 28));

            Transaksi::create([
                'kode' => 'TRX' . Str::upper(Str::random(6)),
                'total' => rand(10000, 500000),
                'status' => 'selesai',
                'user_id' => $kasirIds[array_rand($kasirIds)],
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }
    }
}
