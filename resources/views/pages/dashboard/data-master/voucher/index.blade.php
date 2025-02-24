@extends('templates.dashboard.app')

@section('content')
<table class="table table-bordered table-checkable" id="dataTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Kode</th>
            <th>Diskon</th>
            <th>Kadaluarsa</th>
            <th><i class="fas fa-cog text-dark"></i></th>
        </tr>
    </thead>
</table>
@endsection

@section('js')
<script>
    var table

    $(document).ready(function() {
        table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('data-table.voucher') }}",
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
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'discount',
                    name: 'discount'
                },
                {
                    data: 'expired_at',
                    name: 'expired_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                }
            ]
        });
    })

</script>
@endsection