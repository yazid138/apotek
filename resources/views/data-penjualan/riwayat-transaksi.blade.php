<x-main title="Riwayat Transaksi" role={{ $role }}>
    @push('style')
        <style>
            .header {
                margin-top: 20px;
            }
        </style>
    @endpush

    <div class="container">
        <div class="header row justify-content-end">
            <div class="col-6">
                <form action="{{ route('riwayat-transaksi.print') }}" method="get" target="_blank">
                    <div class="form-group">
                        <label for="startDate" class="fw-semibold">Rentang Penjualan:</label>
                        <div class="input-group d-flex justify-content-between mb-3 gap-1">
                            <input type="date" id="startDate" class="form-control" name="startDate"
                                value="{{ old('startDate', date('Y-m-d')) }}">
                            <input type="date" id="endDate" class="form-control" name="endDate"
                                value="{{ old('endDate', date('Y-m-d')) }}">
                            <button type="submit" class="btn btn-primary btn-print p-2">Print</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
    </div>
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-main>
