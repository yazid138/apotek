<x-main title="Stock Obat">
    @push('style')
        <style>
            .header {
                margin-top: 20px;
            }
        </style>
    @endpush

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

    @push('scripts')
        <script>
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
                            url: 'obat-delete/' + id,
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
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-main>
