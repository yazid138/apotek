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
                @error('failed')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
                <form id="form" method="POST" action="{{ route('admin.input-obat.save') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group row">
                            <label for="namaPengunggah" class="col-sm-3 col-form-label fw-semibold">Nama Pengunggah
                                :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('input_name') is-invalid @enderror"
                                    id="namaPengunggah" placeholder="masukkan nama anda" name="input_name"
                                    value="{{ old('input_name') }}">
                                @error('input_name')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="tanggalInput" class="col-sm-3 col-form-label fw-semibold">Tanggal Input
                                :</label>
                            <div class="col-sm-9">
                                <input value="{{ old('input_date', date('Y-m-d')) }}" type="date"
                                    class="form-control @error('input_date') is-invalid @enderror" id="tanggalInput"
                                    placeholder="masukkan tanggal input" name="input_date">
                                @error('input_date')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="namaObat" class="col-sm-3 col-form-label fw-semibold">Nama Obat :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="namaObat" placeholder="masukkan nama obat" name="name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="hargaObat" class="col-sm-3 col-form-label fw-semibold">Harga Obat :</label>
                            <div class="col-sm-9">
                                <div class="input-group has-validation">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                        id="hargaObat" placeholder="0,00" name="price" value="{{ old('price') }}">
                                    @error('price')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="jumlahObat" class="col-sm-3 col-form-label fw-semibold">Jumlah Obat :</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                    id="jumlahObat" placeholder="0" name="stock" value="{{ old('stock') }}">
                                @error('stock')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="tanggalKadaluwarsa" class="col-sm-3 col-form-label fw-semibold">Tanggal
                                Kadaluwarsa
                                :</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control @error('expired_date') is-invalid @enderror"
                                    id="tanggalKadaluwarsa" placeholder="masukkan tanggal input" name="expired_date"
                                    value="{{ old('expired_date') }}">
                                @error('expired_date')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="nomorBatch" class="col-sm-3 col-form-label fw-semibold">Nomor Batch :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('no_batch') is-invalid @enderror"
                                    id="nomorBatch" placeholder="masukkan nomor batch" name="no_batch"
                                    value="{{ old('no_batch') }}">
                                @error('no_batch')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="safetyStock" class="col-sm-3 col-form-label fw-semibold">Safety Stock
                                :</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control @error('safety_stock') is-invalid @enderror"
                                    id="safetyStock" placeholder="0" name="safety_stock"
                                    value="{{ old('safety_stock') }}">
                                @error('safety_stock')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group d-flex justify-content-end mt-3">
                            {{-- <button type="button" class="btn btn-danger btn-ubah">Ubah</button> --}}
                            <button type="submit" class="btn btn-primary btn-simpan">Simpan</button>
                        </div>
                    </div>
            </div>


            </form>
        </div>
    </div>
    </div>
</x-main>
