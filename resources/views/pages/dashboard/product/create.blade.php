@extends('templates.dashboard.app')

@section('content')
<form action="{{ route('dashboard.product.store') }}" method="post">
    <div class="card-body">
        @csrf

        @if (auth()->user()->role == 'admin')
        <div class="form-group">
            <label for="store_id">ID Toko</label>
            <select name="store_id" class="form-control">
                <option>-- Pilih salah satu --</option>
                @foreach (\App\Models\Store::all() as $item)
                <option value="{{ $item->id }}" {{ old('store_id') == $item->id ? 'selected' : '' }}>{{ $item->id }}
                </option>
                @endforeach
            </select>
        </div>
        @endif
        <div class="form-group">
            <label for="product_category_id">Kategori
                Produk</label>
            <select name="product_category_id" class="form-control select2" id="kt_select2_3" multiple="multiple">
                @foreach (\App\Models\ProductCategory::all() as $item)
                <option value="{{ $item->id }}"
                    {{ in_array($item->id, old('product_category_id', [])) ? 'selected' : '' }}>{{ $item->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" class="form-control" placeholder="Masukkan nama produk"
                value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="kt-ckeditor-1" id="kt-ckeditor-1">{{ old('kt-ckeditor-1') }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Harga</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                </div>
                <input type="text" name="price" class="form-control currency-format"
                    placeholder="Masukkan nominal diskon"
                    value="{{ old('price') ? number_format(old('price'),0,',','.') : '' }}">
            </div>
        </div>
        <div class="form-group">
            <label for="stock">Stok</label>
            <input type="text" name="stock" class="form-control" placeholder="Masukkan stok produk"
                value="{{ old('stock') }}">
        </div>
        <div class="form-group">
            <form action="image">Gambar</form>
            <div class="dropzone dropzone-default" id="kt_dropzone_3">
                <div class="dropzone-msg dz-message needsclick">
                    <h3 class="dropzone-msg-title">
                        Jatuhkan gambar di sini atau klik untuk mengunggah.
                    </h3>
                    <span class="dropzone-msg-desc">
                        Unggah satu atau lebih gambar dengan ekstensi yang didukung.
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="">-- Pilih salah satu --</option>
                {{-- draft --}}
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                {{-- active --}}
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                {{-- inactive --}}
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>
    </div>
    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        <a href="{{ route('dashboard.product.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection

@section('js')
<script>
    // Class definition
    var KTCkeditor = function () {
        // Private functions
        var demos = function () {
            ClassicEditor
                .create( document.querySelector( '#kt-ckeditor-1' ), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'underline', 'strikethrough', '|', 'bulletedList', 'numberedList', '|', 'alignment', 'indent', 'outdent', '|', 'undo', 'redo'],
                    removePlugins: ['ImageUpload', 'MediaEmbed', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed', 'Table', 'TableToolbar'],
                } )
                .then( editor => {
                    console.log( editor );
                } )
                .catch( error => {
                    console.error( error );
                } );
        }

        return {
            // public functions
            init: function() {
                demos();
            }
        };
    }();

    // Initialization
    jQuery(document).ready(function() {
        KTCkeditor.init();
    });

    $('form').on('submit', function(e) {
        e.preventDefault();
        let price = $('.currency-format').val();
        $('input[name="price"]').val(formatCurrency.cleanValue(price));
        console.log(price);
        $(this).unbind('submit').submit();
    });

    var uploadedFiles = [];

    var myDropzone = new Dropzone('#kt_dropzone_3', {
        url: "{{ route('dashboard.product.upload-temp') }}",
        paramName: "file",
        maxFilesize: 5,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        acceptedFiles: 'image/*',
        dictInvalidFileType: "Hanya file gambar yang dapat diunggah.",
        init: function() {
            @if(old('image_files'))
                @foreach(old('image_files') as $image)
                    var mockFile = { name: "{{ $image }}", size: 0 };
                    this.options.addedfile.call(this, mockFile);
                    this.options.thumbnail.call(this, mockFile, "{{ asset('storage/temp/'. $image) }}");
                    mockFile.previewElement.classList.add('dz-success');
                    mockFile.previewElement.classList.add('dz-complete');
                    uploadedFiles.push(mockFile);
                @endforeach
            @endif
        },
        success: function(file, response) {
            uploadedFiles.push(response.filename);
            $('input[name="image_files[]"]').val(uploadedFiles);
        }
    });

    $('form').append('<input type="hidden" name="image_files[]" value="">');
</script>
@endsection