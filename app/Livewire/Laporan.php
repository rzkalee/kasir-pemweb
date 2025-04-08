<?php

namespace App\Livewire;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Laporan extends Component
{
    public $bulan;
    public $tanggalMulai;
    public $tanggalSelesai;

    public function render(): View
    {
        // Ambil transaksi dengan status "selesai"
        $semuaTransaksi = Transaksi::where('status', 'selesai');

        // Filter berdasarkan bulan jika dipilih
        if ($this->bulan) {
            $semuaTransaksi->whereMonth('created_at', date('m', strtotime($this->bulan)))
                           ->whereYear('created_at', date('Y', strtotime($this->bulan)));
        }

        // Filter berdasarkan rentang tanggal jika dipilih
        if ($this->tanggalMulai && $this->tanggalSelesai) {
            $semuaTransaksi->whereBetween('created_at', [$this->tanggalMulai, $this->tanggalSelesai]);
        }

        // Eksekusi query
        $semuaTransaksi = $semuaTransaksi->get();

        return view('livewire.laporan', compact('semuaTransaksi'));
    }
}
