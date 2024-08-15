<x-main title="Riwayat Pengadaan">
    @push('style')
        <style>
            .container {
                width: 90%;
                margin: auto;
                overflow: hidden;
            }
        </style>
    @endpush

    <div class="container">
        <div class="card mt-4">
            <div class="card-body">
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Tanggal Barang Masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengadaan as $p)
                            <tr>
                                <td>{{ $p->input_date->format('d-m-Y') }}</td>
                                <td><a href="{{ route('barang-masuk.detail') }}?date={{ $p->input_date->format('d-m-Y') }}"
                                        class="btn border-dark"><i class="fas fa-bars"></i></a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-main>
