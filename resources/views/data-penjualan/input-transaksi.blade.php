<x-main title="Input Transaksi" role={{ $role }}>
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
                <form method="POST" action="{{ route('create-transaksi') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="namaPengunggah" class="fw-semibold">Nama Pengunggah</label>
                            <input type="text" class="form-control @error('input_name') is-invalid @enderror"
                                id="namaPengunggah" placeholder="Nama Pengunggah" name="input_name"
                                value="{{ old('input_name') }}">
                            @error('input_name')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 mt-2">
                            <label for="tanggal" class="fw-semibold">Tanggal</label>
                            <input value="{{ old('input_date', date('Y-m-d')) }}" type="date"
                                class="form-control @error('input_date') is-invalid @enderror" id="tanggal"
                                name="input_date">
                            @error('input_date')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id='table-body'>
                                <tr data-id="1">
                                    <td>
                                        <select class="nama-obat" name="obat[]" style="width: 100%">
                                            <option selected disabled>Pilih Obat</option>
                                            @foreach ($obat as $o)
                                                <option value="{{ $o->id }}">{{ $o->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="no-batch"></td>
                                    <td class="price"></td>
                                    <td style="width: 10%"><input class="qty" style="width: 100%" type="number"
                                            name="qty[]" max="999" min="1">
                                    </td>
                                    <td class="total-row"></td>
                                    <td><button type="button" class="btn btn-success" id="btn-add"><i
                                                class="fas fa-plus"></i></button></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-right">Total:</td>
                                    <td id="total"></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            let row = 1
            const dataObat = {!! $obat !!}

            $('#btn-add').click((e) => {
                e.preventDefault()
                $('#table-body').append(`<tr data-id="${++row}" id="row-${row}">
                                    <td>
                                        <select class="nama-obat" name="obat[]" style="width: 100%">
                                            <option selected disabled>Pilih Obat</option>
                                            @foreach ($obat as $o)
                                                <option value="{{ $o->id }}">{{ $o->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="no-batch"></td>
                                    <td class="price"></td>
                                    <td style="width: 10%"><input class="qty" style="width: 100%" type="number" name="qty[]" max="999" min="1"></td>
                                    <td class="total-row"></td>
                                    <td><button type="button" class="btn btn-danger btn-remove" onclick="remove(${row})"><i class="fas fa-minus"></i></button>
                                    </td>
                                </tr>`)
            })

            $('#table-body').on('change', '.nama-obat', function(e) {
                e.preventDefault()
                let total = 0;
                const id = $(this).val()
                const obat = dataObat.find(e => e.id === +id)
                const tr = $(this).parent().parent()
                tr.find('.price').html(obat.price)
                tr.find('.no-batch').html(obat.no_batch)
                tr.find('.qty').val(1)
                tr.find('.total-row').html(obat.price)
                $('.total-row').each(function(e) {
                    total += +$(this).html()
                    $('#total').html(total)
                })
            })

            $('#table-body').on('change', '.qty', function(e) {
                e.preventDefault()

                let total = 0;
                const tr = $(this).parent().parent()
                const id = tr.find('.nama-obat').val()
                const obat = dataObat.find(e => e.id === +id)
                if (obat) {
                    tr.find('.total-row').html(obat.price * +$(this).val())
                }
                $('.total-row').each(function(e) {
                    total += +$(this).html()
                    $('#total').html(total)
                })
            })

            const remove = (id) => {
                $(`[data-id='${id}']`).remove()
            }
        </script>
    @endpush
</x-main>
