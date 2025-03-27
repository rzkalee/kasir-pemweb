<?php

namespace App\Livewire;

use App\Models\DetilTransaksi;
use App\Models\Produk;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use App\Models\Transaksi as ModelsTransaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class Transaksi extends Component
{
    public $kode, $total, $bayar, $kembalian, $totalSemuaBelanja;

    public $transaksiAktif;

    public function transaksiBaru(): void
    {
        $this->reset();
        $this->transaksiAktif = new ModelsTransaksi();
        $this->transaksiAktif->kode = 'INV/' . date('YmdHis');
        $this->transaksiAktif->total = 0;
        $this->transaksiAktif->status = 'pending';
        $this->transaksiAktif->save();
    }

    public function batalTransaksi(): void
    {
        if($this->transaksiAktif) {
            $detilTransaksi = DetilTransaksi::where('transaksi_id',$this->transaksiAktif->id)->get();
            foreach ($detilTransaksi as $detil) {
                $produk = Produk::find($detil->produk_id);
                $produk->stok += $detil->jumlah;
                $produk->save();
                $detil->delete();
            }
            $this->transaksiAktif->delete();
        }
        $this->reset();
    }

    public function render(): View
    {
        if ($this->transaksiAktif) {
            $semuaProduk = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)->get();
            $this->totalSemuaBelanja = $semuaProduk->sum(fn($detil) => $detil->jumlah * $detil->produk->harga);
        } else {
            $semuaProduk = [];
        }
        
        return view('livewire.transaksi', [
            'semuaProduk' => $semuaProduk
        ]);
    }
    

    public function updatedKode(): void
    {
        $this->kembalian = $this->bayar - (float) $this->totalSemuaBelanja;

        $produk = Produk::where('kode', $this->kode)->first();
        if ($produk && $produk->stok > 0) {
            $detil = DetilTransaksi::firstOrNew([
                'transaksi_id' => $this->transaksiAktif->id,
                'produk_id' => $produk->id
            ], [
                'jumlah' => 0
            ]);
            $detil->jumlah += 1;
            $detil->save();
            $produk->stok -= 1;
            $produk->save();
            $this->reset('kode');
        }
    }

    public function updatedBayar(): void 
    {
        $this->kembalian = $this->bayar - $this->totalSemuaBelanja;
    }

    public function hapusProduk($id): void
    {
        $detil = DetilTransaksi::find($id);
        if($detil) {
            $produk = Produk::find($detil->produk_id);
            $produk->stok += $detil->jumlah;
            $produk->save();
        }
        $detil->delete();
    }

    public function transaksiSelesai()
    {
        if (!$this->transaksiAktif) {
            return;
        }
    
        $transaksi = $this->transaksiAktif;
        $this->transaksiAktif->total = $this->totalSemuaBelanja;
        $this->transaksiAktif->status = 'selesai';
        $this->transaksiAktif->save();
    
        $pdf = Pdf::loadView('livewire.nota', [
            'transaksi' => $transaksi,
            'produk' => DetilTransaksi::where('transaksi_id', $transaksi->id)->get()
        ]);
    
        $fileName = 'Nota_' . str_replace(['/', '\\'], '_', $transaksi->kode) . '.pdf';
    
        $this->reset();
    
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $fileName);
    }

    public function tambahJumlah($produkId)
    {
        $detil = DetilTransaksi::find($produkId);
        if ($detil) {
            $produk = Produk::find($detil->produk_id);
            if ($produk->stok > 0) { 
                $detil->jumlah += 1;
                $detil->save();
                $produk->stok -= 1;
                $produk->save();
                $this->hitungTotal();
            }
        }
    }

    public function kurangiJumlah($produkId)
    {
        $detil = DetilTransaksi::find($produkId);
        if ($detil && $detil->jumlah > 1) { 
            $produk = Produk::find($detil->produk_id);
            $detil->jumlah -= 1;
            $detil->save();
            $produk->stok += 1;
            $produk->save();
            $this->hitungTotal();
        }
    }

    private function hitungTotal()
    {
        $this->totalSemuaBelanja = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)
            ->get()
            ->sum(fn($detil) => $detil->jumlah * $detil->produk->harga);
    }

}
