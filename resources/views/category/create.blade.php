<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Buat Kategori
        </h2>
    </x-slot>

    <div class="row">
        <div class="col-lg mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm">
                        <h5 class="card-header">Buat Kategori Baru</h5>
                        <div class="card-body">
                            <form action="{{ route('categories.store') }}" method="POST">
                                @csrf
                                <label for="nama" class="form-label">Nama:</label>
                                <input type="text" id="nama" name="nama"
                                    class="form-control" required>
                                <div class="mt-3"> </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>