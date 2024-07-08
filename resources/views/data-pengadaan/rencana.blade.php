<x-main title="Rencana Pengadaan" role={{ $role }}>
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
        <div class="mt-4 mb-2 d-flex justify-content-end">
            <button type="button" class="btn btn-primary btn-print">Print</button>
        </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Obat</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>01 Juni 2024</td>
                        <td>Ibuprofen 400mg</td>
                        <td>10</td>
                        <td>Box</td>
                    </tr>
                    <tr>
                        <td>10 Juni 2024</td>
                        <td>Acetylcystein 200mg</td>
                        <td>20</td>
                        <td>Box</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</x-main>
