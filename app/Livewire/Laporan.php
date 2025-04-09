<?php

namespace App\Livewire;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Laporan extends Component
{
    public $bulan;
    public $tanggalMulai;
    public $tanggalSelesai;
    public $kasir;

    public $semuaTransaksi = [];
    public $sudahFilter = false;

    public function mount()
    {
        // Tampilkan semua transaksi di awal
        $this->semuaTransaksi = Transaksi::where('status', 'selesai')->get();
    }

    public function render(): View
    {
        $kasirs = User::where('role', 'kasir')->get();

        return view('livewire.laporan', [
            'kasirs' => $kasirs,
            'semuaTransaksi' => $this->semuaTransaksi,
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
            $query->whereMonth('created_at', $this->bulan)
                  ->whereYear('created_at', now()->year);
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
        $this->semuaTransaksi = Transaksi::where('status', 'selesai')->get();
        $this->sudahFilter = false;
    }
}
