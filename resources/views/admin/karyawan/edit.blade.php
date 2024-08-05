@php
    $optionRole = [
        [
            'label' => 'Karyawan',
            'value' => 'karyawan',
        ],
        [
            'label' => 'Apoteker',
            'value' => 'apoteker',
        ],
    ];
@endphp
<x-main title="Edit Karyawan">
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
            <h4 class="fw-bold">Edit Karyawan</h4>
        </div>
        <div class="card">
            <div class="card-body p-4">
                @error('failed')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
                <form id="form" method="POST" action="{{ route('admin.karyawan.update', $user) }}">
                    @method('PUT')
                    @csrf
                    <div class="form-row">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label fw-semibold">Nama
                                :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" placeholder="masukkan Nama" name="name"
                                    value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="username" class="col-sm-3 col-form-label fw-semibold">Username
                                :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" placeholder="masukkan Username" name="username"
                                    value="{{ old('username', $user->username) }}">
                                @error('username')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="role" class="col-sm-3 col-form-label fw-semibold">Role
                                :</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="role" id="role"
                                    class="form-control @error('role') is-invalid @enderror">
                                    <option value="" selected disabled>Pilih Role</option>
                                    @foreach ($optionRole as $option)
                                        <option value="{{ $option['value'] }}" @selected($user->role === $option['value'])>
                                            {{ $option['label'] }}</option>
                                    @endforeach
                                </select>
                                @error('role')
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
