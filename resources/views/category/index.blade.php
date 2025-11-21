<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Kategori
        </h2>
    </x-slot>

    <div class="row">
        <div class="col-lg mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Judul di kiri -->
                                <h5 class="card-title text-primary mb-0">Daftar Kategori</h5>

                                <div class="d-flex align-items-center gap-3">

                                    <a href="{{ route('categories.create') }}" class="btn btn-primary">Buat Kategori Baru</a>

                                    <!-- Form pencarian -->
                                    <form method="GET" action="{{ route('categories.index') }}" class="d-flex">
                                        <input type="text" name="search" class="form-control" placeholder="Cari kategori..." value="{{ $search ?? '' }}" style="max-width: 200px;">
                                        <button type="submit" class="btn btn-secondary">Cari</button>
                                    </form>
                                </div>
                            </div>

                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            <div class="card-datatable pt-0">
                                <div class="table-responsive text-nowrap px-4 pb-4">
                                    <table class="table" id="categoryTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($categories as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->nama }}</td>
                                                <td>
                                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;" id="deleteForm{{ $category->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $category->id }}')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(categoryId) {
            // Menampilkan konfirmasi SweetAlert
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data yang dihapus tidak bisa dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                // Jika pengguna memilih Hapus
                if (result.isConfirmed) {
                    // Cari form berdasarkan ID kategori dan kirim form tersebut
                    document.getElementById('deleteForm' + categoryId).submit();
                }
            });
        }
    </script>
</x-app-layout>