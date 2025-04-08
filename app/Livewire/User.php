<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User as ModelUser;

class User extends Component
{
    public $pilihanMenu = 'lihat';

    public function pilihMenu($menu): void
    {
        $this->pilihanMenu = $menu;
    }

    public function render(): View
    {
        $semuaPengguna = ModelUser::paginate(5); // Pastikan pakai pagination
        return view('livewire.user', compact('semuaPengguna'));
    }

    public $nama, $email, $password, $peran;

    public function simpan(): void
    {
        $this->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'peran' => 'required',
        ], [
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'peran.required' => 'Peran harus dipilih'
        ]);

        $simpan = new ModelUser();
        $simpan->name = $this->nama;
        $simpan->email = $this->email;
        $simpan->password = bcrypt($this->password);
        $simpan->role = $this->peran;
        $simpan->save();

        $this->reset('nama', 'email', 'password', 'peran');
        $this->pilihMenu('lihat');
    }

    public $penggunaTerpilih;
    
    public function pilihHapus($id): void
    {
        $this->penggunaTerpilih = ModelUser::findOrFail($id);
        $this->pilihanMenu = 'hapus';
    }

    public function hapus(): void
    {
        $this->penggunaTerpilih->delete();
        $this->pilihMenu('lihat');
    }

    public function batal(): void
    {
        $this->reset();
    }

    public function pilihEdit($id): void
    {
        $this->penggunaTerpilih = ModelUser::findOrFail($id);
        $this->nama = $this->penggunaTerpilih->name;
        $this->email = $this->penggunaTerpilih->email;
        $this->peran = $this->penggunaTerpilih->peran;
        $this->pilihanMenu = 'edit';
    }

    public function simpanEdit(): void
    {
        $this->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->penggunaTerpilih->id,
            'peran' => 'required',
        ], [
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'peran.required' => 'Peran harus dipilih'
        ]);

        $simpan = $this->penggunaTerpilih;
        $simpan->name = $this->nama;
        $simpan->email = $this->email;
        if ($this->password) {
            $simpan->password = bcrypt($this->password);
        }

        $simpan->role = $this->peran;
        $simpan->save();

        $this->reset('nama', 'email', 'peran', 'penggunaTerpilih');
        $this->pilihMenu('lihat');
    }

    public function mount(): void
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }
    }
}
