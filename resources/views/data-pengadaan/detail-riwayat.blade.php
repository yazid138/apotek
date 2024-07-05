<x-main title="Riwayat Transaksi">
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
                            <th>Nama Pengunggah</th>
                            <th>Tanggal Input</th>
                            <th>Nama Obat</th>
                            <th>Harga Obat</th>
                            <th>Jumlah Obat</th>
                            <th>Tanggal Kadaluwarsa</th>
                            <th>Nomor Batch</th>
                            <th>Safety Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Felicia Abigail</td>
                            <td>01 Juni 2024</td>
                            <td>Amoxicillin 500mg</td>
                            <td>Rp 500</td>
                            <td>100</td>
                            <td>10-Oktober-2027</td>
                            <td>1132234</td>
                            <td>500</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-main>
