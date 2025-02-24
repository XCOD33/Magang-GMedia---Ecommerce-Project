@extends('templates.dashboard.app')

@section('content')
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
@endsection

@section('js')
<script>
    let table;

    $(document).ready(function() {
        table = $('#dataTable').DataTable({
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
    })

    function deleteData(id, url) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if (response.success === true) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'Oke',
                            }).then((result) => {
                                if (result.value) {
                                    table.ajax.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'Oke',
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan pada server.',
                            icon: 'error',
                            confirmButtonText: 'Oke',
                        });
                    }
                });
            }
        });
    }
</script>
@endsection