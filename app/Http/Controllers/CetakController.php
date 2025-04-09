<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class CetakController extends Controller
{
    public function cetak(Request $request)
    {
        $query = Transaksi::where('status', 'selesai');
    
        if ($request->kasir) {
            $query->where('user_id', $request->kasir);
        }
    
        if ($request->bulan) {
            $query->whereMonth('created_at', $request->bulan);
            $query->whereYear('created_at', now()->year); // atau pakai dari request kalau ada
        }
    
        if ($request->tanggalMulai && $request->tanggalSelesai) {
            $query->whereBetween('created_at', [$request->tanggalMulai, $request->tanggalSelesai]);
        }
    
        $semuaTransaksi = $query->get();
    
        return view('livewire.cetak', compact('semuaTransaksi'));
    }
    
}
