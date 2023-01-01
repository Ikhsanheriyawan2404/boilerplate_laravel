@extends('layouts.app', ['title' => 'Users'])

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('Pengguna') }}</h1>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container-fluid mb-3 d-flex justify-content-end">
    <div class="row">
        <div class="col-12">
            @can('user-create')
            <a class="btn btn-sm btn-primary" id="createNewItem">Tambah <em class="fa fa-plus"></em></a>
            @endcan
        </div>
    </div>
</div>

<div class="container">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Pengguna</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            {{ $dataTable->table(['class' => 'table table-sm table-striped']) }}
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- Modal -->
<div class="modal fade" id="modal-md">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="itemForm" name="itemForm" method="post">
        @csrf
        <input type="hidden" name="item_id" id="item_id">
        <div class="modal-body">
            <div class="form-group">
                <label for="name">Nama <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm mr-2" name="name" id="name">
            </div>
            <div class="form-group">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm mr-2" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="password">Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control form-control-sm mr-2" name="password" id="password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control form-control-sm mr-2" name="password_confirmation" id="password_confirmation">
            </div>
            <div class="form-group">
                <label for="role">Role <span class="text-danger">*</span></label>
                <select class="form-control form-control-sm mr-2" name="role" id="role">
                    <option selected disabled>{{ __('Pilih Role Pengguna') }}</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-primary float-right" id="saveBtn">Simpan</button>
        </div>
        </form>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection

@push('custom-styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/toastr/toastr.min.css">
@endpush

@push('custom-scripts')

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('asset') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <script src="{{ asset('asset') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/toastr/toastr.min.js"></script>

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function () {

            $('#createNewItem').click(function() {
                setTimeout(function() {
                    $('#name').focus();
                }, 500);
                $('#saveBtn').removeAttr('disabled');
                $('#saveBtn').html("Simpan");
                $('#item_id').val('');
                $('#itemForm').trigger("reset");
                $('.modal-title').html("Tambah Pengguna");
                $('#modal-md').modal('show');
            });

            $('body').on('click', '#editItem', function() {
                var item_id = $(this).data('id');
                $.get("{{ route('users.index') }}" + '/' + item_id + '/edit', function(data) {
                    $('#modal-md').modal('show');
                    setTimeout(function() {
                        $('#name').focus();
                    }, 500);
                    $('.modal-title').html("Edit Pengguna");
                    $('#saveBtn').removeAttr('disabled');
                    $('#saveBtn').html("Simpan");
                    $('#item_id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#role').val(data.roles[0].id);
                })
            });

            $('#saveBtn').click(function(e) {
                e.preventDefault();
                var formData = new FormData($('#itemForm')[0]);
                $.ajax({
                    data: formData,
                    url: "{{ route('users.store') }}",
                    contentType: false,
                    processData: false,
                    type: "POST",
                    success: function(data) {
                        $('#saveBtn').attr('disabled', 'disabled');
                        $('#saveBtn').html('Simpan ...');
                        $('#itemForm').trigger("reset");
                        $('#modal-md').modal('hide');
                        $('#users-table').DataTable().draw();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                        });
                    },
                    error: function(data) {
                        console.log(data.responseJSON.message)
                        Swal.fire({
                            icon: 'error',
                            title: 'Oppss',
                            text: data.responseJSON.message,
                        });
                        $.each(data.responseJSON.errors, function (index, value) {
                            toastr.error(value);
                        });
                    }
                });
            });
        });
    </script>
@endpush
