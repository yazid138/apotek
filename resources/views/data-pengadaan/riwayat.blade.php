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
                        @forelse ($pengadaan as $p)
                            <tr>
                                <td>{{ $p->input_date->format('d-m-Y') }}</td>
                                <td><a href="{{ route('riwayat-pengadaan.detail') }}?date={{ $p->input_date->format('d-m-Y') }}"
                                        class="btn border-dark"><i class="fas fa-bars"></i></a></td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-main>
