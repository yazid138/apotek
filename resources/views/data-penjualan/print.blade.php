@php
    function format_date($date)
    {
        return date('d-m-Y', strtotime($date));
    }
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <h4 class="text-center mb-3">Laporan Penjualan Tanggal {{ format_date(request()->startDate) }} sampai
        {{ format_date(request()->endDate) }}
    </h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Id Order</th>
                <th>Nama Pengunggah</th>
                <th>Nama Obat</th>
                <th>No. Batch</th>
                <th>Harga</th>
                <th>qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($order as $o)
                <tr>
                    <td>{{ $o->transaksi->input_date }}</td>
                    <td>{{ $o->transaksi->id }}</td>
                    <td>{{ $o->transaksi->input_name }}</td>
                    <td>{{ $o->obat->name }}</td>
                    <td>{{ $o->obat->no_batch }}</td>
                    <td>{{ Number::currency($o->obat->price, 'IDR', 'id') }}</td>
                    <td>{{ $o->qty }}</td>
                    <td>{{ Number::currency($o->qty * $o->obat->price, 'IDR', 'id') }}</td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
    <script>
        window.print()
    </script>
</body>

</html>
