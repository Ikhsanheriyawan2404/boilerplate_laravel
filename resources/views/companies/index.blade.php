@extends('layouts.app', ['title' => 'Perusahaan'])

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data Perusahaan</h1>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container-fluid mb-3 d-flex justify-content-end">
    <div class="row">
        <div class="col-12">
            @can('user-create')
            <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">Tambah</a>
            @endcan
        </div>
    </div>
</div>

<div class="container">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Perusahaan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            {{ ($dataTable->table(['class' => 'table table-sm table-striped'], true)) }}
            {{-- {{ $dataTable->table(['class' => 'table table-sm']) }} --}}
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <ul class="list-group">
                <li class="list-group-item" id="name"></li>
                <li class="list-group-item" id="email"></li>
                <li class="list-group-item" id="address"></li>
            </ul>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
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
@endpush

@push('custom-scripts')

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('asset') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
