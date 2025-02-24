@extends('templates.dashboard.app')

@section('content')
<form action="{{ route('dashboard.data-master.product-category.store') }}" method="post">
    <div class="card-body">
        @csrf

        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" class="form-control" placeholder="Masukkan nama kategori"
                value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <input type="text" name="description" class="form-control" placeholder="Masukkan deskripsi"
                value="{{ old('description') }}">
        </div>
    </div>
    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        <a href="{{ route('dashboard.data-master.user.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection