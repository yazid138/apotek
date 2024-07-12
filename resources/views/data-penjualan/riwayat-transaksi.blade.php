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
                <div class="form-group">
                    <label for="startDate" class="fw-semibold">Rentang Penjualan:</label>
                    <div class="input-group d-flex justify-content-between mb-3 gap-1">
                        <input type="date" id="startDate" class="form-control">
                        <input type="date" id="endDate" class="form-control">
                        <button type="button" class="btn btn-primary btn-print p-2">Print</button>
                    </div>

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
