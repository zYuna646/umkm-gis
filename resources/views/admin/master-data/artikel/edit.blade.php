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
        <form action="{{ route('admin.artikel.update', $data->id) }}" method="post">
            @csrf
            @method('put')
            <div class="card-body">
                <h5 class="mb-3">{{ $subtitle }} Form</h5>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="control-label mb-1">Kategori Artikel<span class="text-danger">*</span></label>
                            <select name="parent" class="form-select form-select-sm @error('parent') is-invalid @enderror"
                                aria-label="Small select example">
                                <option value="" disabled selected>Select Kategori Artikel</option>
                                @foreach ($KategoriArtikel as $item)
                                    <option value="{{ $item->id }}" {{ old('parent', $data->kategori_artikel_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="control-label mb-1">Pilih Gambar Cover Artikel<span
                                    class="text-danger">*</span></label>
                            <input type="file" name="cover" class="form-control @error('cover') is-invalid @enderror"
                                accept=".png, .jpg, .jpeg" />
                            @error('cover')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="control-label mb-1">Judul<span class="text-danger">*</span></label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                                placeholder="..." value="{{ old('judul', $data->title) }}" />
                            @error('judul')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="control-label mb-1">Keywords<span class="text-danger">*</span></label>
                            <input type="text" name="keywords"
                                class="form-control @error('keywords') is-invalid @enderror" placeholder="..."
                                value="{{ old('keywords', $data->keywords) }}" />
                            @error('keywords')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="control-label mb-1">Deskripsi<span class="text-danger">*</span></label>
                            <input type="text" name="deskripsi"
                                class="form-control @error('deskripsi') is-invalid @enderror" placeholder="..."
                                value="{{ old('deskripsi', $data->deskripsi) }}" />
                            @error('deskripsi')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="control-label mb-1">Isi Artikel/Berita<span class="text-danger">*</span></label>
                            
                            <textarea class="form-control" name="isi_artikel" rows="5" id="editor">
                                {{ old('isi_artikel', $data->isi_artikel) }}
                            </textarea>
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
            ClassicEditor
                .create(document.querySelector('#editor'))
                .then(editor => {
                    editor.model.document.on('change', () => {
                        const keteranganJenisUsaha = editor.getData();
                        document.querySelector('[name="isi_artikel"]').value = keteranganJenisUsaha;
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
@endsection
