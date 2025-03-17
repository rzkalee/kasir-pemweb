<?php

namespace App\Livewire;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Laporan extends Component
{
    public function render(): View
    {
        $semuaTransaksi = Transaksi::where('status', 'selesai')->get();
        return view('livewire.laporan')->with(['semuaTransasksi' => $semuaTransaksi]);
    }
}
