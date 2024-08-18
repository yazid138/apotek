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
                <th>Id Transaksi</th>
                <th>Id User</th>
                <th>Obat</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi as $t)
                @php
                    $total = 0
                @endphp
                    <tr>
                        <td>{{ $t->input_date->format('d-m-Y') }}</td>
                        <td>{{ $t->id }}</td>
                        <td>{{ $t->input_name }}</td>
                        <td>
                            <ol>
                                @forelse ($t->orders as $o)
                                    @if ($o->obat)
                                        @php
                                            $total += $o->obat->price * $o->qty
                                        @endphp
                                        <li>
                                            {{$o->obat->name}}<br>
                                            {{Number::currency($o->obat->price, 'IDR', 'id')}} x {{$o->qty}}
                                        </li>
                                    @endif
                                @empty
                                    -
                                @endforelse
                            </ol>
                        </td>
                        <td>{{ Number::currency($total, 'IDR', 'id') }}</td>
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
