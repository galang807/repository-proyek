<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Produk
        </h2>
    </x-slot>

    <div class="p-4">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Kategori -->
            <div class="mb-4">
                <label for="kategori_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select id="kategori_id" name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->kategori_id == $category->id ? 'selected' : '' }}>
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
                <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $product->nama) }}" placeholder="Nama Produk" required>
                @error('nama')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Deskripsi Produk -->
            <div class="mb-4">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Deskripsi Produk" rows="4" required>{{ old('deskripsi', $product->deskripsi) }}</textarea>
                @error('deskripsi')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Harga Produk -->
            <div class="mb-4">
                <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" id="harga" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga', $product->harga) }}" placeholder="Harga Produk" step="0.01" required>
                @error('harga')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Stok Produk -->
            <div class="mb-4">
                <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
                <input type="number" id="stok" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok', $product->stok) }}" placeholder="Stok Produk" required>
                @error('stok')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Foto Produk -->
            <div class="mb-4">
                <label for="foto" class="block text-sm font-medium text-gray-700">Foto Produk</label>
                <input type="file" id="foto" name="foto" class="form-control @error('foto') is-invalid @enderror">
                @if($product->foto)
                <div class="mt-2">
                    <img src="{{ asset('uploads/products/' . $product->foto) }}" alt="Foto Produk" width="150">
                </div>
                @endif
                @error('foto')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Produk</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary ml-3">Kembali</a>
        </form>
    </div>
</x-app-layout>