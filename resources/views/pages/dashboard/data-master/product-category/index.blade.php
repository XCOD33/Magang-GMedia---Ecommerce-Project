@extends('templates.dashboard.app')

@section('content')
<div class="table-responsive">
    <table class="table table-bordered table-checkable" id="dataTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Slug</th>
                <th>Deskripsi</th>
                <th>Total Product</th>
                <th><i class="fas fa-cog text-dark"></i></th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@section('js')
<script>
    let table;

    $(document).ready(function() {
        table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('data-table.product-category') }}",
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
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'slug',
                    name: 'slug',
                },
                {
                    data: 'description',
                    name: 'description',
                },
                {
                    data: 'total_product',
                    name: 'total_product',
                    className: 'text-center',
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