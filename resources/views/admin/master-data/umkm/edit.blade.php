@extends('admin.layouts.app')

@section('content')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <h4 class="fw-semibold mb-8">{{ $title ?? '' }}</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.KlasifikasiUsaha') }}" class="text-muted">{{ $title ?? '' }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $subtitle ?? '' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <form action="{{ route('admin.umkm.update', $data->id) }}" method="post">
            @csrf
            @method('put')
            <div class="card-body">
                <h5 class="mb-3">{{ $subtitle }} Form</h5>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="control-label mb-1">Alamat<span class="text-danger">*</span></label>
                            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                placeholder="..." value="{{ old('alamat', $data->alamat) }}" />
                            @error('alamat')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Pilih Foto UMKM<span
                                    class="text-danger">*</span></label>
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror"
                                accept=".png, .jpg, .jpeg" />
                            @error('foto')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Link Lokasi Pada Google Maps<span class="text-danger">*</span></label>
                            <input type="text" name="linkDisplay" class="form-control @error('linkDisplay') is-invalid @enderror" id="link"
                                placeholder="..." value="{{ old('linkDisplay', $data->link) }}" disabled />
                            @error('linkDisplay')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="hidden" name="link" class="form-control @error('link') is-invalid @enderror" id="link"
                                placeholder="..." value="{{ old('link', $data->link) }}" />
                            @error('link')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Koordinat Maps<span class="text-danger">*</span></label>
                            <input type="hidden" name="kordinat_maps" id="kordinat_maps"
                                class="form-control @error('kordinat_maps') is-invalid @enderror" placeholder=""
                                value="{{ old('kordinat_maps') }}" />
                            @error('kordinat_maps')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="control-label mb-1">Koordinat Maps<span class="text-danger">*</span></label>
                            <input name="kordinat_maps_display" id="kordinat_maps_display"
                                class="form-control @error('kordinat_maps') is-invalid @enderror" placeholder=""
                                value="{{ old('kordinat_maps') }}" disabled />
                            @error('kordinat_maps')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3" style="height: 400px" id="map"></div>

                        <div class="mb-3">
                            <input type="checkbox" name="is-aktif"
                                class="form-check-input @error('is-aktif') is-invalid @enderror" value="1"
                                {{ old('is-aktif', $data->is_Aktif) ? 'checked' : '' }} />
                            <label class="control-label mb-1">Aktif<span class="text-danger">*</span></label>

                            @error('is-aktif')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="checkbox" name="is-umum"
                                class="form-check-input @error('is-umum') is-invalid @enderror" value="1"
                                {{ old('is-umum', $data->is_Umum) ? 'checked' : '' }} />
                            <label class="control-label mb-1">Tampilkan Untuk Umum<span class="text-danger">*</span></label>

                            @error('is-umum')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Nama Pemilik<span class="text-danger">*</span></label>
                            <input type="text" name="nama_pemilik"
                                class="form-control @error('nama_pemilik') is-invalid @enderror" placeholder="..."
                                value="{{ old('nama_pemilik', $data->nama_pemilik) }}" />
                            @error('nama_pemilik')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Desa - Kelurahan<span class="text-danger">*</span></label>
                            <input type="text" name="desa" class="form-control @error('desa') is-invalid @enderror"
                                placeholder="..." value="{{ old('desa', $data->desa) }}" />
                            @error('desa')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Kecamatan<span class="text-danger">*</span></label>
                            <input type="text" name="kecamatan"
                                class="form-control @error('kecamatan') is-invalid @enderror" placeholder="..."
                                value="{{ old('kecamatan', $data->kecamatan) }}" />
                            @error('kecamatan')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Kabupaten<span class="text-danger">*</span></label>
                            <input type="text" name="kabupaten"
                                class="form-control @error('kabupaten') is-invalid @enderror" placeholder="..."
                                value="{{ old('kabupaten', $data->kabupaten) }}" />
                            @error('kabupaten')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Jenis Usaha<span class="text-danger">*</span></label>
                            <select name="jenis_usaha"
                                class="form-select form-select-sm @error('jenis_usaha') is-invalid @enderror"
                                aria-label="Small select example">
                                <option value="" disabled selected>Select Jenis Usaha</option>
                                @foreach ($JenisUsaha as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('jenis_usaha', $data->jenis_usaha_id) == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_usaha')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="control-label mb-1">Klasifikasi Usaha<span class="text-danger">*</span></label>
                            <select name="klasifikasi_usaha"
                                class="form-select form-select-sm @error('klasifikasi_usaha') is-invalid @enderror"
                                aria-label="Small select example">
                                <option value="" disabled selected>Select Klasifikasi Usaha</option>
                                @foreach ($KlasifikasiUsaha as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('klasifikasi_usaha', $data->klasifikasi_usaha_id) == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('klasifikasi_usaha')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="control-label mb-1">Pendapatan - Aset</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                <input type="number" id="priceInput" name="pendapatan-aset" class="form-control" value="{{ old('pendapatan-aset', $data->pendapatan_aset) }}" placeholder="0" />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="control-label mb-1">Pendapatan - Omset</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                <input type="number" id="priceInput" name="pendapatan-omset" class="form-control" value="{{ old('pendapatan-omset', $data->pendapatan_omset) }}" placeholder="0" />
                            </div>
                        </div>


                        <div class="mb-3">
                            <label class="control-label mb-1">Tenaga Kerja (Laki-Laki)<span
                                    class="text-danger">*</span></label>
                            <input type="number" name="tenaga-kerja-l"
                                class="form-control @error('tenaga-kerja-l') is-invalid @enderror" placeholder="..."
                                value="{{ old('tenaga-kerja-l', $data->tenaga_kerja_l) }}" />
                            @error('tenaga-kerja-l')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Tenaga Kerja (Perempuan)<span
                                    class="text-danger">*</span></label>
                            <input type="number" name="tenaga-kerja-p"
                                class="form-control @error('tenaga-kerja-p') is-invalid @enderror" placeholder="..."
                                value="{{ old('tenaga-kerja-p', $data->tenaga_kerja_p) }}" />
                            @error('tenaga-kerja-p')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1"> Jumlah Tenaga Kerja
                                <span class="text-danger">*</span></label>
                            <input type="number" name="jumlah-tenaga-kerja"
                                class="form-control @error('jumlah-tenaga-kerja') is-invalid @enderror" placeholder="..."
                                value="{{ old('jumlah-tenaga-kerja', $data->jumlah_tenaga_kerja) }}" />
                            @error('jumlah-tenaga-kerja')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="checkbox" name="is-umum"
                                class="form-check-input @error('bantuan') is-invalid @enderror" value="1"
                                {{ old('bantuan', $data->is_Bantuan) ? 'checked' : '' }} />
                            <label class="control-label mb-1">Bantuan Yang Telah Diterima Dari Pemerintah<span
                                    class="text-danger">*</span></label>

                            @error('bantuan')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="control-label mb-1">Keterangan Jenis Usaha<span
                                    class="text-danger">*</span></label>

                            <textarea class="form-control" name="keterangan-jenis-usaha" rows="5" id="editor">
                                {{ old('keterangan-jenis-usaha', $data->keterangan_jenis_usaha) }}
                            </textarea>
                        </div>


                        <div class="mb-3">
                            <label class="control-label mb-1">Keterangan<span class="text-danger">*</span></label>
                            <input type="text" name="keterangan"
                                class="form-control @error('keterangan') is-invalid @enderror" placeholder="..."
                                value="{{ old('keterangan', $data->keterangan) }}" />
                            @error('keterangan')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="card-body border-top">
                    <button type="submit" class="btn btn-success rounded-pill px-4">
                        <div class="d-flex align-items-center">
                            <i class="ti ti-device-floppy me-1 fs-4"></i>
                            Update
                        </div>
                    </button>
                    <button type="reset" class="btn btn-danger rounded-pill px-4 ms-2 text-white">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            var map = L.map('map').setView([0.556174, 123.058548], 13);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            var marker = L.marker([0.556174, 123.058548]).addTo(map);
            var popup = L.popup();
            document.getElementById("kordinat_maps").value = "Lat: 0.556174  Lang: 123.058548"
            document.getElementById("kordinat_maps_display").value = "Lat: 0.556174  Lang: 123.058548"
            document.getElementById("link").value = "https://www.google.com/maps?q=0.556174,123.058548";
            document.getElementById("linkDisplay").value = "https://www.google.com/maps?q=0.556174,123.058548";

            function onMapClick(e) {
                if (marker) {
                    map.removeLayer(marker);
                }
                marker = L.marker(e.latlng).addTo(map);
                popup
                    .setLatLng(e.latlng)
                    .setContent(e.latlng.toString())
                    .openOn(map);

                var lat = e.latlng.lat.toFixed(6);
                var lng = e.latlng.lng.toFixed(6);

                document.getElementById("kordinat_maps").value = "Lat: " + lat + "  Lang: " + lng;
                document.getElementById("kordinat_maps_display").value = "Lat: " + lat + "  Lang: " + lng;
                document.getElementById("link").value = "https://www.google.com/maps?q=" + lat +","+lng;
                document.getElementById("linkDisplay").value = "https://www.google.com/maps?q=" + lat +","+lng;
            }

            map.on('click', onMapClick);

            ClassicEditor
                .create(document.querySelector('#editor'))
                .then(editor => {
                    editor.model.document.on('change', () => {
                        const keteranganJenisUsaha = editor.getData();
                        document.querySelector('[name="keterangan-jenis-usaha"]').value = keteranganJenisUsaha;
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
@endsection
