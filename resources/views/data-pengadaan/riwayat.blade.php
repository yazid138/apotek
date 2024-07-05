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
        <div class="mt-4 mb-2 d-flex justify-content-end">
            <button type="button" class="btn btn-primary btn-print">Print</button>
        </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th>Tanggal Pengadaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>01 Juni 2024</td>
                        <td><a href="#" class="btn border-dark"><i class="fas fa-bars"></i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</x-main>
