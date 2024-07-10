<x-main title="Stock Obat">
    @push('style')
        <style>
            .header {
                margin-top: 20px;
            }

            /* Remove up and down arrows from number input */
            input[type=number]::-webkit-outer-spin-button,
            input[type=number]::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            input[type=number] {
                -moz-appearance: textfield;
            }
        </style>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    @endpush

    <div class="container">
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
                                <td><input type="text" class="form-control" id="namaObat" value="Amoxicillin 500mg">
                                </td>
                                <td style="width: 180px">
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary" type="button"
                                            id="decreaseQuantity">-</button>
                                        <input type="number" class="form-control text-center" id="jumlahObat"
                                            value="0">
                                        <button class="btn btn-outline-secondary" type="button"
                                            id="increaseQuantity">+</button>
                                    </div>
                                </td>
                                <td><input type="text" class="form-control text-center" id="satuan"
                                        placeholder="--"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-warning">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            const remove = (id) => {
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
                        // Add your deletion logic here
                        Swal.fire(
                            'Berhasil!',
                            'Data berhasil dihapus.',
                            'success'
                        );
                    }
                });
            }
        </script>
    @endpush
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                const increaseButton = document.getElementById('increaseQuantity');
                const decreaseButton = document.getElementById('decreaseQuantity');
                const quantityInput = document.getElementById('jumlahObat');

                increaseButton.addEventListener('click', () => {
                    let value = parseInt(quantityInput.value);
                    if (isNaN(value)) {
                        value = 0;
                    }
                    quantityInput.value = value + 1;
                });

                decreaseButton.addEventListener('click', () => {
                    let value = parseInt(quantityInput.value);
                    if (isNaN(value) || value <= 0) {
                        value = 1; // Prevent negative values
                    }
                    quantityInput.value = value - 1;
                });
                document.querySelectorAll('.btn-delete').forEach(button => {
                    button.addEventListener('click', (event) => {
                        event.preventDefault();
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
                                // Add your deletion logic here
                                Swal.fire(
                                    'Berhasil!',
                                    'Data berhasil dihapus.',
                                    'success'
                                );
                            }
                        });
                    });
                });
            });
        </script>
    @endpush
</x-main>
