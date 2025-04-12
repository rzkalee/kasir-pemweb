<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\DetilTransaksi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Beranda extends Component
{
    public $data = [];
public $pemasukanBulanan = [];

public function mount()
{
    $user = Auth::user();

    // Pemasukan per bulan (untuk semua role, biar aman)
    $pemasukan = [];
        for ($i = 1; $i <= 12; $i++) {
            $bulan = str_pad($i, 2, '0', STR_PAD_LEFT);
            $tahunBulan = now()->format('Y') . '-' . $bulan;

            $pemasukan[] = Transaksi::where('status', 'selesai')
                ->where('created_at', 'like', "$tahunBulan%")
                ->sum('total');
        }

        $this->pemasukanBulanan = $pemasukan;

        // Role-based data
        if ($user->role === 'admin') {
            $this->data = [
                'totalUser' => User::count(),
                'totalProduk' => Produk::count(),
                'totalStok' => Produk::sum('stok'),
            ];
        } elseif ($user->role === 'kasir') {
            $today = now()->toDateString();
            $transaksiHariIni = Transaksi::whereDate('created_at', $today)
                ->where('user_id', $user->id)
                ->where('status', 'selesai');

            $this->data = [
                'jumlahTransaksi' => $transaksiHariIni->count(),
                'produkTerjual' => DetilTransaksi::whereIn('transaksi_id', $transaksiHariIni->pluck('id'))->sum('jumlah'),
                'pemasukanHariIni' => $transaksiHariIni->sum('total'),
            ];
        } elseif ($user->role === 'manager') {
            $bulanIni = now()->format('Y-m');
            $transaksiBulanIni = Transaksi::where('status', 'selesai')
                ->where('created_at', 'like', "$bulanIni%");

            $this->data = [
                'jumlahTransaksi' => $transaksiBulanIni->count(),
                'produkTerjual' => DetilTransaksi::whereIn('transaksi_id', $transaksiBulanIni->pluck('id'))->sum('jumlah'),
                'pemasukanBulanIni' => $transaksiBulanIni->sum('total'),
            ];
        }
    }


    public function render()
    {
        return view('livewire.beranda');
    }
}
