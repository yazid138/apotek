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
        <div class="row justify-content-between">
            <div class="col">
                <h5 class="fw-bold">Ringkasan : </h5>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label class="fw-semibold">Periode Penjualan:</label>
                    <div class="input-group d-flex justify-content-between mb-3 gap-1">
                        <input type="month" id="periode" class="form-control" value="{{ date('Y-m') }}">
                    </div>
                </div>
            </div>

            <div class="mt-2 row">
                <div class="card col-6 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">Total Pendapatan:</h6>
                        <h4 class="card-text text-center fw-bold" id="totalPendapatan">
                            {{ Number::currency($totalKeuntungan->total ?? 0, 'IDR', 'id') }}</h4>
                    </div>
                </div>
                <div class="card col-6 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">Total Transaksi:</h6>
                        <h4 class="card-text text-center fw-bold" id="jumlahPembelian">{{ $jumlahTransaksi->jumlah }}
                            Pembelian</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card col-6 mt-3 p-4 shadow-sm">
                    <canvas id="barChart"></canvas>
                </div>
                <div class="card col-6 mt-3 p-4 shadow-sm">
                    <canvas id="donutChart" height="250"></canvas>
                </div>
            </div>
        </div>
        @push('scripts')
            <script>
                $(document).ready(function() {
                    const formatter = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                    });
                    const generateChart = (data) => {
                        let barChartStatus = Chart.getChart("barChart");
                        let donutChartStatus = Chart.getChart("donutChart");
                        if (barChartStatus != undefined || donutChartStatus != undefined) {
                            barChartStatus.destroy();
                            donutChartStatus.destroy();
                        }
                        new Chart($('#barChart'), {
                            type: 'bar',
                            data: {
                                labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
                                datasets: [{
                                    label: 'Total Pendapatan',
                                    data,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                        new Chart($('#donutChart'), {
                            type: 'doughnut',
                            data: {
                                labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
                                datasets: [{
                                    label: 'Total Pendapatan',
                                    data,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: false,
                                plugins: {
                                    legend: {
                                        position: 'right'
                                    }
                                }
                            }
                        });
                    }
                    const dataKeuntunganPerMinggu = {!! json_encode($keuntunganPerMinggu) !!}
                    const week = dataKeuntunganPerMinggu.map(e => e.week - 1)
                    let count = -1
                    const dataChart = new Array(4).fill(0).map((e, index) => {
                        if (week.includes(index)) {
                            count++
                            return dataKeuntunganPerMinggu[count].weekly_revenue
                        }
                        return 0
                    })
                    $('#periode').change(function() {
                        $.ajax({
                            url: "{{ route('dashboard.data') }}",
                            data: {
                                periode: $('#periode').val()
                            },
                            success: (res) => {
                                $('#totalPendapatan').html(formatter.format(res.totalKeuntungan.total))
                                $('#jumlahPembelian').html(res.jumlahTransaksi.jumlah + ' Pembelian')
                                const dataKeuntunganPerMinggu = res.keuntunganPerMinggu
                                const week = dataKeuntunganPerMinggu.map(e => e.week - 1)
                                let count = -1
                                const dataChart = new Array(4).fill(0).map((e, index) => {
                                    if (week.includes(index)) {
                                        count++
                                        return dataKeuntunganPerMinggu[count].weekly_revenue
                                    }
                                    return 0
                                })
                                generateChart(dataChart)
                            },
                            error: () => {
                                alert('Api error')
                            }
                        })
                    })
                    generateChart(dataChart)
                })
            </script>
        @endpush
</x-main>
