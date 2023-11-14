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
        <form action="{{ route('admin.KlasifikasiUsaha.update', $data->id) }}" method="post">
            @csrf
            @method('put')
            <div class="card-body">
                <h5 class="mb-3">{{ $subtitle }} Form</h5>
                <div class="row">
                    <div class="col-12">
                        <div>
                            <label class="control-label mb-1">{{$title ?? " "}}</label>
                            <input type="text" name="KlasifikasiUsaha_name"
                                class="form-control @error('KlasifikasiUsaha_name') is-invalid @enderror" placeholder="..." value="{{ old('KlasifikasiUsaha_name', $data->name) }}" />
                            @error('KlasifikasiUsaha_name')
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
@endsection
