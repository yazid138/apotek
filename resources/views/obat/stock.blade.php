<x-main title="Stock Obat">
    @push('style')
        <style>
            .header {
                margin-top: 20px;
            }
        </style>
    @endpush
    @if (Auth::user()->role !== 'karyawan')
        @push('style')
            <style>
                tr.red td:not(:last-child) {
                    background-color: var(--bs-danger);
                }

                tr.green td:not(:last-child) {
                    background-color: var(--bs-success);
                }

                tr.yellow td:not(:last-child) {
                    background-color: var(--bs-warning);
                }
            </style>
        @endpush
    @endif

    <div class="container">

        @if (Session::has('success'))
            <div class="alert alert-success mt-4" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="card mt-4">
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    <!-- Order Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Pesan Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-pesan">
                        @csrf
                        <input type="hidden" name="obatId" id="id-obat">
                        <table class="table">
                            <thead class="text-center">
                                <tr>
                                    <th>Nama Obat</th>
                                    <th>Jumlah Obat</th>
                                    <th>Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" id="nama-obat" readonly>
                                    </td>
                                    <td style="width: 180px">
                                        <div class="input-group">
                                            <input type="number" class="form-control text-center" name="jumlah"
                                                id="jumlahObat" value="1" min="1">
                                        </div>
                                    </td>
                                    <td><input type="text" class="form-control text-center" id="satuan"
                                            name="satuan" placeholder="--"></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-warning" id="btn-simpan">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    @if (Auth::user()->role !== 'karyawan')
        @push('scripts')
            <script>
                const orderModal = new bootstrap.Modal('#orderModal')
                const openModal = (id, obat) => {
                    $('#nama-obat').val(obat)
                    $('#id-obat').val(id)
                    $('#jumlahObat').val(1)
                    $('#satuan').val("")
                    orderModal.show()
                }
                $('#btn-simpan').on('click', function() {
                    const fd = new FormData(document.getElementById('form-pesan'))
                    console.log(Object.fromEntries(fd.entries()))
                    $.ajax({
                        url: '{{ route('tambah-pengadaan') }}',
                        method: 'POST',
                        data: $('#form-pesan').serialize(),
                        success: (response) => {
                            Swal.fire(
                                'Berhasil!',
                                response.message,
                                'success'
                            );
                            orderModal.hide()
                            if (LaravelDataTables["obat-table"]) {
                                LaravelDataTables["obat-table"].draw()
                            }
                        },
                        error: (response) => {
                            Swal.fire(
                                'Gagal!',
                                response.message,
                                'error'
                            );
                            orderModal.hide()
                        }
                    })
                })
                const remove = (id) => {
                    let tokenElement = document.head.querySelector('meta[name="csrf-token"]');
                    if (!tokenElement) {
                        console.error('CSRF token meta tag not found.');
                        return;
                    }

                    let token = tokenElement.content;
                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Ingin menghapus data",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{ route('admin.obat.destroy', ['id' => '#']) }}'.replace('#', id),
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': token
                                },
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire(
                                            'Berhasil!',
                                            'Data berhasil dihapus.',
                                            'success'
                                        );
                                        if (LaravelDataTables["obat-table"]) {
                                            LaravelDataTables["obat-table"].draw()
                                        }
                                    } else {
                                        Swal.fire(
                                            'Gagal!',
                                            'Data gagal dihapus.',
                                            'error'
                                        )
                                    }
                                },
                                error: function(xhr, status, error) {
                                    Swal.fire(
                                        'Gagal!',
                                        'Terjadi Kesalahan saat menghapus data.',
                                        'error'
                                    );
                                }
                            })
                        }
                    });
                }
            </script>
        @endpush
    @endif
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-main>
