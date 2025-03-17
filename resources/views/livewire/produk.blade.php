<div class="container">
    <div class="row my-2">
        <div class="col-12">
            <button wire:click="pilihMenu('lihat')" 
            class="btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }}">
            Semua Produk
            </button>
            <button wire:click="pilihMenu('tambah')" 
            class="btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }}">
            Tambah Produk
            </button>
            <button wire:click="pilihMenu('excel')"
            class="btn {{ $pilihanMenu == 'excel' ? 'btn-primary' : 'btn-outline-primary' }}">
            Import Produk
            </button>
            <button wire:loading class="btn btn-info">
                Loading . . .
            </button>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-12">
            @if ($pilihanMenu == 'lihat')
            <table class="table table-bordered">
                <thead>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                </thead>
                <tbody>
                    @foreach ($semuaProduk as $produk)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $produk->kode}}</td>
                        <td>{{ $produk->nama }}</td>
                        <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                        <td>{{ $produk->stok }} pcs</td>
                        <td>
                            <button wire:click="pilihEdit({{ $produk->id }})"
                                class="btn {{ $pilihanMenu == 'edit' ? 'btn-primary' : 'btn-outline-primary' }}">
                                Edit Produk
                            </button>
                            <button wire:click="pilihHapus({{ $produk->id }})"
                                class="btn {{ $pilihanMenu == 'hapus' ? 'btn-primary' : 'btn-outline-primary' }}">
                                Hapus Produk
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @elseif ($pilihanMenu == 'tambah')
            <form wire:submit='simpan' action="" method="post">
                <label for="">Kode</label>
                <input type="number" class="form-control" wire:model='kode'>
                @error('kode')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>
                <label for="">Nama</label>
                <input type="text" class="form-control" wire:model='nama'>
                @error('nama')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>
                <label for="">Harga</label>
                <input type="number" class="form-control" wire:model='harga'>
                @error('harga')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>
                <label for="">Stok</label>
                <input type="number" class="form-control" wire:model='stok'>
                @error('stok')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>
                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            </form>
            @elseif ($pilihanMenu == 'edit')
            <form wire:submit='simpanEdit' action="" method="post">
                <label for="">Kode</label>
                <input type="number" class="form-control" wire:model='kode'>
                @error('kode')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>
                <label for="">Nama</label>
                <input type="text" class="form-control" wire:model='nama'>
                @error('nama')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>
                <label for="">Harga</label>
                <input type="number" class="form-control" wire:model='harga'>
                @error('harga')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>
                <label for="">Stok</label>
                <input type="number" class="form-control" wire:model='stok'>
                @error('stok')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>
                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            </form>
            @elseif ($pilihanMenu == 'hapus')
            <div class="card border-primary">
                <div class="card-header bg-danger text-white">
                    Hapus Produk
                </div>
                <div class="card-body">
                    Anda yakin ingin menghapus produk ini?
                    <p>Nama : {{ $produkTerpilih->nama }}</p>
                    <button class="btn btn-danger" wire:click='hapus'>HAPUS</button>
                    <button class="btn btn-secondary" wire:click='batal'>BATAL</button>
                </div>
            </div>
            @elseif ($pilihanMenu == 'excel')
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        Import Produk
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent='imporExcel'>
                            <input type="file" class="form-control" wire:model='fileExcel'>
                            <br>
                            <button class="btn btn-primary" type="submit">Kirim</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
