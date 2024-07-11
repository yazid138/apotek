<x-main title="Stock Obat">
    @push('style')
        <style>
            .header {
                margin-top: 20px;
            }
        </style>
    @endpush

    <div class="container">
        <div class="card mt-4">
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-main>
