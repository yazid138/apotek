<x-main title="Input Transaksi">
    @push('style')
        <style>
            .container {
                width: 90%;
                margin: auto;
                overflow: hidden;
            }

            .header {
                padding-top: 20px;
                padding-bottom: 5px;
                text-align: center;
            }
        </style>
    @endpush

    <div class="container">
        <div class="header">
            <h4 class="fw-bold">Pesanan</h4>
        </div>
        <div class="card">
            <div class="card-body p-4">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="namaPengunggah" class="fw-semibold">Nama Pengunggah</label>
                            <input type="text" class="form-control" id="namaPengunggah"
                                placeholder="Nama Pengunggah">
                        </div>
                        <div class="form-group col-md-6 mt-2">
                            <label for="tanggal" class="fw-semibold">Tanggal</label>
                            <input value="{{ date('Y-m-d') }}" type="date" class="form-control" id="tanggal">
                        </div>
                    </div>
                    <div class="mt-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Obat</th>
                                    <th>Nomor Batch</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Paracetamol 500 mg</td>
                                    <td>1132234</td>
                                    <td>Rp 300</td>
                                    <td>10</td>
                                    <td>Rp 6.000</td>
                                </tr>
                                <tr>
                                    <td>Antasida Doen 200 mg</td>
                                    <td>1132234</td>
                                    <td>Rp 200</td>
                                    <td>10</td>
                                    <td>Rp 2.000</td>
                                </tr>
                                <tr>
                                    <td>Acetylcysteine 200 mg</td>
                                    <td>1132234</td>
                                    <td>Rp 500</td>
                                    <td>10</td>
                                    <td>Rp 5.000</td>
                                </tr>
                                <tr class="total-row">
                                    <td colspan="4" class="text-right">Total:</td>
                                    <td>Rp 13.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <button type="button" class="btn btn-danger btn-ubah">Ubah</button>
                        <button type="submit" class="btn btn-primary btn-simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-main>
