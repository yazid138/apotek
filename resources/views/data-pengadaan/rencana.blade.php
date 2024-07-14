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
                        @forelse ($pengadaan as $p)
                            <tr>
                                <td>{{ $p->created_at->format('d-m-Y') }}</td>
                                <td>{{ $p->obat->name }}</td>
                                <td>{{ $p->jumlah }}</td>
                                <td>{{ $p->satuan }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-main>
