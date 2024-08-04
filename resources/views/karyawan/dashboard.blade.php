<x-main title="Dashboard">
    @push('style')
        <style>
            .container {
                width: 90%;
                margin: auto;
                overflow: hidden;
            }

            .header {
                padding: 20px 0;
                text-align: center;
            }

            .header h3 {
                border-bottom: 1px solid #00796b;
            }
        </style>
    @endpush
    <div class="header">
        <h3 class="fw-bold pb-3 mb-3">Dashboard</h3>
        <p><strong>Selamat Datang {{ Auth::user()->name }},</strong> Berikan yang terbaik untuk kesehatan pelanggan!</p>
    </div>
    <div class="container">
        <div class="card col-12 mt-3 p-4 shadow-sm">
            <div class="card-body">
                <table class="table table-hover table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Nama Obat</th>
                            <th>Harga</th>
                            <th>No Batch</th>
                            <th>Stock</th>
                            <th>Kedaluwarsa</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($obats as $obat)
                            <tr>
                                <td>{{ $obat->name }}</td>
                                <td>{{ Number::currency($obat->price, 'IDR', 'id') }}</td>
                                <td>{{ $obat->no_batch }}</td>
                                <td>{{ $obat->stock }}</td>
                                <td>{{ $obat->expired_date->format('d-m-Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <a class="btn btn-secondary" href="{{ route('stock-obat') }}">Lihat Semua</a>
            </div>
        </div>
    </div>
</x-main>
