<x-main title="Riwayat Transaksi" role={{ $role }}>
    @push('style')
        <style>
            .container {
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
                            <th>Id User</th>
                            <th>Tanggal Input</th>
                            <th>Nama Obat</th>
                            <th>Harga Obat</th>
                            <th>Jumlah Obat</th>
                            <th>Tanggal Kedaluwarsa</th>
                            <th>Nomor Batch</th>
                            <th>Safety Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengadaan as $p)
                            <tr>
                                <td>{{ $p->input_name }}</td>
                                <td>{{ $p->input_date->format('d-m-Y') }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ Number::currency($p->price, 'IDR', 'id') }}</td>
                                <td>{{ $p->stock }}</td>
                                <td>{{ $p->expired_date->format('d-m-Y') }}</td>
                                <td>{{ $p->no_batch }}</td>
                                <td>{{ $p->safety_stock }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-main>
