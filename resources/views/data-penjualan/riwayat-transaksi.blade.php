<x-main title="Riwayat Transaksi">
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
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>ID Order</th>
                            <th>Nama Penginput</th>
                            <th>Nama Obat</th>
                            <th>Nomor Batch</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>10 Juni 2024</td>
                            <td>OO001</td>
                            <td>Felicia Abigail</td>
                            <td>Amoxicillin 500mg</td>
                            <td>1132234</td>
                            <td>Rp 500</td>
                            <td>10</td>
                            <td>Rp 5.000</td>
                        </tr>
                        <tr>
                            <td>10 Juni 2024</td>
                            <td>OO002</td>
                            <td>Felicia Abigail</td>
                            <td>Paracetamol 500mg</td>
                            <td>1132234</td>
                            <td>Rp 300</td>
                            <td>10</td>
                            <td>Rp 3.000</td>
                        </tr>
                        <tr>
                            <td>10 Juni 2024</td>
                            <td>OO003</td>
                            <td>Felicia Abigail</td>
                            <td>Antasida Doen 200mg</td>
                            <td>1132234</td>
                            <td>Rp 200</td>
                            <td>10</td>
                            <td>Rp 2.000</td>
                        </tr>
                        <tr>
                            <td>10 Juni 2024</td>
                            <td>OO004</td>
                            <td>Felicia Abigail</td>
                            <td>Ibuprofen 400mg</td>
                            <td>1132234</td>
                            <td>Rp 400</td>
                            <td>10</td>
                            <td>Rp 4.000</td>
                        </tr>
                        <tr>
                            <td>10 Juni 2024</td>
                            <td>OO005</td>
                            <td>Felicia Abigail</td>
                            <td>Acetylcysteine 200mg</td>
                            <td>1132234</td>
                            <td>Rp 500</td>
                            <td>10</td>
                            <td>Rp 5.000</td>
                        </tr>
                        <tr>
                            <td>10 Juni 2024</td>
                            <td>OO006</td>
                            <td>Felicia Abigail</td>
                            <td>Samnol Sirup 120mg/60ml</td>
                            <td>1132234</td>
                            <td>Rp 2.000</td>
                            <td>10</td>
                            <td>Rp 20.000</td>
                        </tr>
                        <tr>
                            <td>10 Juni 2024</td>
                            <td>OO007</td>
                            <td>Felicia Abigail</td>
                            <td>Antalgin 500mg</td>
                            <td>1132234</td>
                            <td>Rp 300</td>
                            <td>10</td>
                            <td>Rp 3.000</td>
                        </tr>
                        <tr>
                            <td>10 Juni 2024</td>
                            <td>OO008</td>
                            <td>Felicia Abigail</td>
                            <td>Balsem Otot Geliga 20gram</td>
                            <td>1132234</td>
                            <td>Rp 1.500</td>
                            <td>10</td>
                            <td>Rp 15.000</td>
                        </tr>
                        <tr>
                            <td>10 Juni 2024</td>
                            <td>OO009</td>
                            <td>Felicia Abigail</td>
                            <td>Asam Mefenamat 500mg</td>
                            <td>1132234</td>
                            <td>Rp 400</td>
                            <td>10</td>
                            <td>Rp 4.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-main>
