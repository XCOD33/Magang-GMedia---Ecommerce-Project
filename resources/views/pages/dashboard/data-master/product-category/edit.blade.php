@extends('templates.dashboard.app')

@section('content')
<form action="{{ route('dashboard.data-master.product-category.update', $productCategory->id) }}" method="post">
    <div class="card-body">
        @csrf

        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" class="form-control" placeholder="Masukkan nama kategori"
                value="{{ old('name', $productCategory->name) }}">
        </div>
        <div class="form-group">
            <label for="image">Gambar</label>
            <div class="dropzone dropzone-default" id="dz_image">
                <div class="dropzone-msg dz-message needsclick">
                    <h3 class="dropzone-msg-title">Jatuhkan gambar disini</h3>
                    <span class="dropzone-msg-desc">atau klik untuk mengunggah</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <input type="text" name="description" class="form-control" placeholder="Masukkan deskripsi"
                value="{{ old('description', $productCategory->description) }}">
        </div>
    </div>
    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        <a href="{{ route('dashboard.data-master.user.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#dz_image').dropzone({
            url: "{{ route('dashboard.data-master.product-category.upload-image') }}",
            paramName: "image",
            maxFiles: 1,
            maxFilesize: 5,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                // Tampilkan pesan sukses
                toastr.success('Gambar berhasil diunggah');
            },
            error: function(file, response) {
                let message = response;
                if (typeof response === 'object') {
                    message = response.error || 'Terjadi kesalahan saat mengunggah gambar';
                }
                toastr.error(message);
                this.removeFile(file);
            },
            init: function() {
                // Tampilkan gambar yang sudah ada jika ada
                @if($productCategory->image)
                    var mockFile = { name: "{{ $productCategory->image }}" };
                    this.displayExistingFile(mockFile, "{{ Storage::url('product-category/' . $productCategory->image) }}");
                @endif

                // Cek apakah ada file yang sudah diupload sementara
                @if(session()->has('temp_product_category_image'))
                    var mockFile = { name: "{{ session('temp_product_category_image') }}" };
                    this.displayExistingFile(mockFile, "{{ Storage::url('temp/' . session('temp_product_category_image')) }}");
                @endif
            }
        })
    });
</script>
@endsection