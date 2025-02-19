@extends('templates.dashboard.app')

@section('content')
<div class="card card-custom gutter-b">
    <div class="card-header flex-wrap py-">
        <div class="card-title">
            <h3 class="card-label">Kelola User</h3>
        </div>
        <div class="card-toolbar">
            <a href="#" class="btn btn-primary font-weight-bolder">
                <i class="fas fa-plus-square"></i> Tambah Data
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-checkable" id="dataTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th><i class="fas fa-cog text-dark"></i></th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        dataTable();
    })

    function dataTable() {
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('data-table.user') }}",
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
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'role',
                    name: 'role',
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
    }
</script>
@endsection