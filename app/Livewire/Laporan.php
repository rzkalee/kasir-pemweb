<?php

namespace App\Livewire;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Laporan extends Component
{
    public $bulan;
    public $tahun; // Tambahan untuk filter tahun
    public $tanggalMulai;
    public $tanggalSelesai;
    public $kasir;

    public $semuaTransaksi = [];
    public $sudahFilter = false;

    public $daftarTahun = []; // Tambahan untuk dropdown tahun

    public function mount()
    {
        // Ambil semua transaksi selesai di awal
        $this->semuaTransaksi = Transaksi::where('status', 'selesai')->get();

        // Ambil daftar tahun unik dari transaksi yang tersedia
        $this->daftarTahun = Transaksi::selectRaw('YEAR(created_at) as tahun')
            ->where('status', 'selesai')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun')
            ->toArray();
    }

    public function render(): View
    {
        $kasirs = User::where('role', 'kasir')->get();

        return view('livewire.laporan', [
            'kasirs' => $kasirs,
            'semuaTransaksi' => $this->semuaTransaksi,
            'daftarTahun' => $this->daftarTahun, // Kirim ke view
        ]);
    }

    public function filter()
    {
        $query = Transaksi::where('status', 'selesai');

        if ($this->kasir) {
            $query->where('user_id', $this->kasir);
        }

        if ($this->tanggalMulai && $this->tanggalSelesai) {
            $query->whereBetween('created_at', [$this->tanggalMulai, $this->tanggalSelesai]);
        } elseif ($this->bulan) {
            $query->whereMonth('created_at', $this->bulan);

            if ($this->tahun) {
                $query->whereYear('created_at', $this->tahun);
            } else {
                $query->whereYear('created_at', now()->year); // default ke tahun ini kalau belum pilih
            }
        } elseif ($this->tahun) {
            // Kalau hanya tahun dipilih
            $query->whereYear('created_at', $this->tahun);
        }

        $this->semuaTransaksi = $query->get();
        $this->sudahFilter = true;
    }

    public function resetFilter()
    {
        $this->kasir = '';
        $this->tanggalMulai = '';
        $this->tanggalSelesai = '';
        $this->bulan = '';
        $this->tahun = ''; // reset juga tahun
        $this->semuaTransaksi = Transaksi::where('status', 'selesai')->get();
        $this->sudahFilter = false;
    }
}
