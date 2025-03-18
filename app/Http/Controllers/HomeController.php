<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function cetak(): View
    {
        $semuaTransaksi = Transaksi::where('status', 'selesai')->get();
        return view('livewire.cetak')->with(['semuaTransaksi' => $semuaTransaksi]);
    }
}
