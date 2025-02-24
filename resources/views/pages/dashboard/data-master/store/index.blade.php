@extends('templates.dashboard.app')

@section('content')
<table class="table table-bordered table-checkable" id="dataTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Pemilik</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Logo</th>
            <th>Total Produk</th>
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
            ajax: "{{ route('data-table.store') }}",
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
                    data: 'owner',
                    name: 'owner'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'description',
                    name: 'description',
                    className: 'text-center'
                },
                {
                    data: 'logo_url',
                    name: 'logo_url',
                    className: 'text-center'
                },
                {
                    data: 'total_product',
                    name: 'total_product',
                    className: 'text-center'
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