<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produk as ModelProduk;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Produk as ImportProduk;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Milon\Barcode\DNS1D;

class Produk extends Component
{
    use WithFileUploads;

    public $fileExcel;

    public function imporExcel(): void
    {
        Excel::import(new ImportProduk, $this->fileExcel);
        $this->reset();
    }

    public function mount(): void
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }
    }

    public $pilihanMenu = 'lihat';


    public function render()
    {
        $semuaProduk = ModelProduk::paginate(10); 
        return view('livewire.produk', compact('semuaProduk'));
    }

    public $kode,$nama, $harga, $stok;

    public function simpan(): void
    {
        $this->validate([
            'kode' => 'required|unique:produks,kode,',
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ], [
            'kode.required' => 'Kode harus diisi',
            'kode.unique' => 'Kode sudah terdaftar',
            'nama.required' => 'Nama harus diisi',
            'harga.required' => 'Harga harus diisi',
            'stok.required' => 'Stok harus dipilih'
        ]);

        $simpan = new ModelProduk();
        $simpan->kode = $this->kode;
        $simpan->nama = $this->nama;
        $simpan->harga = $this->harga;
        $simpan->stok = $this->stok;
        $simpan->save();

        $this->reset('kode', 'nama', 'harga', 'stok');
        $this->pilihanMenu('lihat');
    }

    public $produkTerpilih;
    
    public function pilihHapus($id): void
    {
        $this->produkTerpilih = ModelProduk::findOrFail($id);
        $this->pilihanMenu = 'hapus';
    }

    public function hapus(): void
    {
        $this->produkTerpilih->delete();
        $this->pilihMenu('lihat');
    }

    public function batal(): void
    {
        $this->reset();
    }

    public function pilihEdit($id): void
    {
        $this->produkTerpilih = ModelProduk::findOrFail($id);
        $this->kode = $this->produkTerpilih->kode;
        $this->nama = $this->produkTerpilih->nama;
        $this->harga = $this->produkTerpilih->harga;
        $this->stok = $this->produkTerpilih->stok;
        $this->pilihanMenu = 'edit';
    }

    public function simpanEdit(): void
    {
        $this->validate([
            'kode' => 'required|unique:produks,kode,' . $this->produkTerpilih->id,
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ], [
            'kode.required' => 'Kode harus diisi',
            'kode.unique' => 'Kode sudah terdaftar',
            'nama.required' => 'Nama harus diisi',
            'harga.required' => 'Harga harus diisi',
            'stok.required' => 'Stok harus dipilih'
        ]);

        $this->produkTerpilih->update([
            'kode' => $this->kode,
            'nama' => $this->nama,
            'harga' => $this->harga,
            'stok' => $this->stok,
        ]);

        $this->reset('kode', 'nama', 'harga', 'stok', 'produkTerpilih');
        $this->pilihMenu('lihat');
    }

    public function cetakSemua($format)
    {
        $produk = ModelProduk::all();
        $pdf = Pdf::loadView('livewire.produk-barcode', compact('produk'));
        return response()->streamDownload(fn () => print($pdf->stream()), 'semua-barcode.pdf');
    }    

    public function cetakSatu($id)
    {
        $produk = ModelProduk::findOrFail($id);
        $pdf = Pdf::loadView('livewire.produk-barcode-single', compact('produk'));
        return response()->streamDownload(fn () => print($pdf->stream()), 'barcode-'.$produk->kode.'.pdf');
    }

}
