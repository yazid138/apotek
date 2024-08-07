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
        <h5 class="fw-bold">Ringkasan : </h5>
        <div class="mt-2 d-flex justify-content-between">
            <div class="card col-5 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title fw-bold">Total Pendapatan:</h6>
                    <h4 class="card-text text-center fw-bold">
                        {{ Number::currency($totalKeuntungan->total ?? 0, 'IDR', 'id') }}</h4>
                </div>
            </div>
            <div class="card col-5 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title fw-bold">Total Transaksi:</h6>
                    <h4 class="card-text text-center fw-bold">{{ $jumlahTransaksi }} Pembelian</h4>
                </div>
            </div>
        </div>

        <div class="card col-12 mt-3 p-4 shadow-sm">
            <h5 class="fw-bold text-center">PENJUALAN TERAKHIR</h5>
            <table class="table table-hover table-bordered">
                <thead class="text-center">
                    <tr>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Harga</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse ($dataTransaksi as $data)
                        @if ($data->obat)
                            <tr>
                                <td>{{ $data->transaksi->input_date->format('d-m-Y') }}</td>
                                <td>{{ $data->obat->name }}</td>
                                <td>{{ Number::currency($data->obat->price ?? 0, 'IDR', 'id') }}</td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="3">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-main>
