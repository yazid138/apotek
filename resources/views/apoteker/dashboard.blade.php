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

            tr.red td:not(:last-child) {
                    background-color: var(--bs-danger);
                }

            tr.yellow td:not(:last-child) {
                background-color: var(--bs-warning);
            }
        </style>
    @endpush
    <div class="header">
        <h3 class="fw-bold pb-3 mb-3">Dashboard</h3>
        <p><strong>Selamat Datang {{ Auth::user()->name }},</strong> Berikan yang terbaik untuk kesehatan pelanggan!</p>
    </div>
    <div class="container">
        <div class="card mt-4">
            <div class="card-body">
                <table class="table table-hover table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Nama Obat</th>
                            <th>Harga</th>
                            <th>Safety Stock</th>
                            <th>Stock</th>
                            <th>Nomor Batch</th>
                            <th>Kedaluwarsa</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($obats as $obat)
                            <tr class="{{ $obat->stock - $obat->safety_stock <= 0 ? 'red' : 'yellow'}}">
                                <td>{{ $obat->name }}</td>
                                <td>{{ Number::currency($obat->price, 'IDR', 'id') }}</td>
                                <td>{{ $obat->safety_stock }}</td>
                                <td>{{ $obat->stock }}</td>
                                <td>{{ $obat->no_batch }}</td>
                                <td>{{ $obat->expired_date->format('d-m-Y') }}</td>
                                <td><span class="badge text-bg-secondary">Terbatas</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <a class="btn btn-secondary" href="{{ route('stock-obat') }}">Lakukan Pengadaan</a>
            </div>
        </div>
    </div>
</x-main>
