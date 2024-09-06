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
                        <label class="fw-semibold">Periode Penjualan:</label>
                        <div class="input-group d-flex justify-content-between mb-3 gap-1">
                            <input type="month" id="periode" class="form-control" value="{{ date('Y-m') }}">
                            <button type="submit" class="btn btn-primary btn-print p-2">Print</button>
                        </div>
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
                        <th>Obat</th>
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
                const formatter = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                    });
                const table = $('#data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('riwayat-transaksi.dataTable') }}',
                        data: function(d) {
                            d.periode = $('#periode').val()
                        }
                    },
                    buttons: [],
                    columns: [{
                            data: 'input_date',
                        },
                        {
                            data: 'id',
                        },
                        {
                            data: 'input_name',
                        },
                        {
                            data: 'orders',
                            render: (data, type, row) => {
                                let html = '<ol>'
                                data.forEach(e => {
                                    if (e.obat) {
                                        html += `<li>
                                            ${e.obat.name}<br>
                                            ${formatter.format(e.obat.price)} x ${e.qty}
                                            </li>`
                                    }
                                });
                                html += '</ol>'
                                return html
                            }
                        },
                        {
                            data: 'total',
                            render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                        },
                    ],
                });

                $('#periode').change(function() {
                    table.draw();
                })
            })
        </script>
    @endpush
</x-main>
