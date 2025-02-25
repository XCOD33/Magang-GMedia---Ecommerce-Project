@extends('templates.dashboard.app')

@section('content')
<table class="table table-bordered table-checkable" id="dataTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Toko</th>
            <th>Kategori Produk</th>
            <th>Slug</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Status</th>
            <th><i class="fas fa-cog text-dark"></i></th>
        </tr>
    </thead>
</table>
@endsection

@section('js')
<script>
    let table;

    $(document).ready(function() {
        table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('data-table.product') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    width: '5%',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                },
                {
                    data: 'store',
                    name: 'store'
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'slug',
                    name: 'slug',
                    className: 'text-center'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'stock',
                    name: 'stock'
                },
                {
                    data: 'action',
                    name: 'action',
                    width: '15%',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                }
            ]
        });
    })
</script>
@endsection