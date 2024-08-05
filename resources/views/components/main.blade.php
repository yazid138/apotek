@extends('layouts.app2', ['title' => $title])

@php
    $user = Auth::user();
    $menu = [];
    if ($user->role === 'karyawan' || $user->role === 'apoteker') {
        $menu = [
            [
                'label' => 'Dashboard',
                'path' => 'dashboard',
            ],
            [
                'label' => 'Data Penjualan',
                'submenu' => [
                    [
                        'label' => 'Tambah Tranksaksi',
                        'path' => 'input-transaksi',
                    ],
                    [
                        'label' => 'Riwayat Transaksi',
                        'path' => 'riwayat-transaksi',
                    ],
                ],
            ],
            [
                'label' => 'Obat',
                'path' => 'stock-obat',
            ],
            [
                'label' => 'Data Pengadaan',
                'submenu' => [
                    [
                        'label' => 'Rencana Pengadaan',
                        'path' => 'rencana-pengadaan',
                    ],
                    [
                        'label' => 'Riwayat Pengadaan',
                        'path' => 'riwayat-pengadaan',
                    ],
                ],
            ],
        ];
    } else {
        $menu = [
            [
                'label' => 'Dashboard',
                'path' => 'dashboard',
            ],
            [
                'label' => 'Data Penjualan',
                'submenu' => [
                    [
                        'label' => 'Tambah Tranksaksi',
                        'path' => 'input-transaksi',
                    ],
                    [
                        'label' => 'Riwayat Transaksi',
                        'path' => 'riwayat-transaksi',
                    ],
                ],
            ],
            [
                'label' => 'Obat',
                'submenu' => [
                    [
                        'label' => 'Tambah Obat',
                        'path' => 'admin.input-obat',
                    ],
                    [
                        'label' => 'Stok Obat',
                        'path' => 'stock-obat',
                    ],
                ],
            ],
            [
                'label' => 'Data Pengadaan',
                'submenu' => [
                    [
                        'label' => 'Rencana Pengadaan',
                        'path' => 'rencana-pengadaan',
                    ],
                    [
                        'label' => 'Riwayat Pengadaan',
                        'path' => 'riwayat-pengadaan',
                    ],
                ],
            ],
        ];
        if ($user->role === 'admin') {
            $menu[] = [
                'label' => 'Karyawan',
                'submenu' => [
                    [
                        'label' => 'Tambah Karyawan',
                        'path' => 'admin.karyawan.create',
                    ],
                    [
                        'label' => 'Daftar Karyawan',
                        'path' => 'admin.karyawan',
                    ],
                ],
            ];
        }
    }
@endphp

@prepend('style')
    <style>
        body {
            background: linear-gradient(to bottom right, #d3e5d2, #a7c5a6);
            height: 100vh;
            width: 100%;
            overflow: hidden;
        }

        nav {
            background-color: #D9D9D9;
            padding-top: 20px;
        }

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav ul li a {
            color: black;
            display: block;
            padding: 10px;
            text-decoration: none;
        }

        nav ul li a:hover {
            background-color: #c0d9c0;
        }

        .active {
            background-color: #c0d9c0;
        }

        nav li ul li {
            padding-left: 20px
        }
    </style>
@endprepend

@section('content')
    <div class="container-fluid overflow-auto">
        <div style="background: #A1C398; width: 100%;z-index: 99" class="row position-absolute top-0">
            <div class="row" style="padding: 15px 0">
                <div class="col-2 text-center">
                    <img src="{{ asset('img/logo.png') }}" alt="" width="150">
                </div>
                <div class="col-10 d-flex justify-content-end align-items-center">
                    <div><i class="fas fa-user"></i>
                        {{ Auth::user()->name }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="height: 100vh; padding-top: 70px">
            <nav class="col-2 p-2 d-flex flex-column justify-content-between">
                <ul>
                    @foreach ($menu as $m)
                        @if (isset($m['submenu']))
                            <li x-data="{ open: {{ Request::routeIs(array_map(fn($sub) => $sub['path'], $m['submenu'])) ? 'true' : 'false' }} }">
                                <a href="#" @click="open = !open">{{ $m['label'] }}</a>
                                <ul x-show="open">
                                    @foreach ($m['submenu'] as $sub)
                                        <li><a class="{{ Request::routeIs($sub['path']) ? 'active' : '' }}"
                                                href="{{ route($sub['path']) }}">{{ $sub['label'] }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="{{ Request::routeIs($m['path']) ? 'active' : '' }}"><a
                                    href="{{ route($m['path']) }}">{{ $m['label'] }}</a></li>
                        @endif
                    @endforeach
                </ul>
                <form action="{{ route('logout') }}" class="d-grid" method="post">
                    @csrf
                    <button class="btn btn-success" type="submit">
                        Keluar
                    </button>
                </form>
            </nav>
            <div class="col-10">{{ $slot }}</div>
        </div>
    </div>
@endsection
