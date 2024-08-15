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
                        <label class="fw-semibold">Rentang Penjualan:</label>
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
            <table id="data-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Id Transaksi</th>
                        <th>Id User</th>
                        <th>Nama Obat</th>
                        <th>No. Batch</th>
                        <th>Harga</th>
                        <th>qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                const table = $('#data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('riwayat-transaksi.dataTable') }}',
                        data: function(d) {
                            d.startDate = $('#startDate').val()
                            d.endDate = $('#endDate').val()
                        }
                    },
                    buttons: [],
                    columns: [{
                            data: 'transaksi.input_date',
                        },
                        {
                            data: 'transaksi.id',
                        },
                        {
                            data: 'transaksi.input_name',
                        },
                        {
                            data: 'obat.name'
                        },
                        {
                            data: 'obat.no_batch'
                        },
                        {
                            data: 'obat.price',
                            render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                        },
                        {
                            data: 'qty'
                        },
                        {
                            data: 'total',
                            render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                        },
                    ],
                });

                $('#startDate').change(function() {
                    table.draw();
                })
                $('#endDate').change(function() {
                    table.draw();
                })
            })
        </script>
    @endpush
</x-main>
