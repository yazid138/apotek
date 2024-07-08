<x-main title="Input Obat">
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
            <h4 class="fw-bold">Input Obat</h4>
        </div>
        <div class="card">
            <div class="card-body p-4">
                <form>
                    <div class="form-row">
                        <div class="form-group row">
                            <label for="namaPengunggah" class="col-sm-3 col-form-label fw-semibold">Nama Pengunggah
                                :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="namaPengunggah"
                                    placeholder="masukkan nama anda">
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="tanggalInput" class="col-sm-3 col-form-label fw-semibold">Tanggal Input
                                :</label>
                            <div class="col-sm-9">
                                <input value="{{ date('Y-m-d') }}" type="date" class="form-control" id="tanggalInput"
                                    placeholder="masukkan tanggal input">
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="namaObat" class="col-sm-3 col-form-label fw-semibold">Nama Obat :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="namaObat"
                                    placeholder="masukkan nama obat">
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="hargaObat" class="col-sm-3 col-form-label fw-semibold">Harga Obat :</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" class="form-control" id="hargaObat" placeholder="0,00">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="jumlahObat" class="col-sm-3 col-form-label fw-semibold">Jumlah Obat :</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="jumlahObat" placeholder="0">
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="tanggalKadaluwarsa" class="col-sm-3 col-form-label fw-semibold">Tanggal
                                Kadaluwarsa
                                :</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggalKadaluwarsa"
                                    placeholder="masukkan tanggal input">
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="nomorBatch" class="col-sm-3 col-form-label fw-semibold">Nomor Batch :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nomorBatch"
                                    placeholder="masukkan nomor batch">
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="safetyStock" class="col-sm-3 col-form-label fw-semibold">Safety Stock :</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="safetyStock" placeholder="0">
                            </div>
                        </div>

                        <div class="form-group d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-danger btn-ubah">Ubah</button>
                            <button type="submit" class="btn btn-primary btn-simpan">Simpan</button>
                        </div>
                    </div>
            </div>


            </form>
        </div>
    </div>
    </div>
</x-main>
