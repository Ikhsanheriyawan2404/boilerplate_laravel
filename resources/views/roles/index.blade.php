@extends('layouts.app', ['title' => 'Roles'])

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('Roles') }}</h1>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<div class="container-fluid mb-3 d-flex justify-content-end">
    <div class="row">
        <div class="col-12">
            @can('user-create')
            <a class="btn btn-sm btn-primary" href="{{ route('roles.create') }}">Tambah <em class="fa fa-plus"></em></a>
            @endcan
        </div>
    </div>
</div>

<div class="container">
    @include('components.alerts')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Role</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            {{ $dataTable->table(['class' => 'table table-sm table-striped']) }}
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

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

        });
    </script>
@endpush
