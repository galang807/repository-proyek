<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Produk Baru
        </h2>
    </x-slot>

    <div class="p-4">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Kategori -->
            <div class="mb-4">
                <label for="kategori_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select id="kategori_id" name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('kategori_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->nama }}
                    </option>
                    @endforeach
                </select>
                @error('kategori_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nama Produk -->
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Nama Produk" required>
                @error('nama')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Deskripsi Produk -->
            <div class="mb-4">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Deskripsi Produk" rows="4" required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Harga Produk -->
            <div class="mb-4">
                <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" id="harga" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" placeholder="Harga Produk" step="0.01" required>
                @error('harga')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Stok Produk -->
            <div class="mb-4">
                <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
                <input type="number" id="stok" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok') }}" placeholder="Stok Produk" required>
                @error('stok')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Foto Produk -->
            <div class="mb-4">
                <label for="foto" class="block text-sm font-medium text-gray-700">Foto Produk</label>
                <input type="file" id="foto" name="foto" class="form-control @error('foto') is-invalid @enderror">
                @error('foto')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan Produk</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary ml-3">Kembali</a>
        </form>
    </div>
</x-app-layout>