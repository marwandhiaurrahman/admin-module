@extends('adminlte::page')

@section('title', 'Role')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Role</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <div class="breadcrumb float-sm-right">
                    {{ Breadcrumbs::render('roles') }}
                </div>
            </div><!-- /.col -->
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Role</h3>
                        <div class="card-tools">
                            @can('role-manage')
                            <a href="{{ route('roles.create') }}" class="btn btn-sm btn-success">Tambah Role</a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="DataTable" class="table table-bordered table-striped dataTable dtr-inline"
                                        role="grid" aria-describedby="example1_info" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Permission</th>
                                                <th>Jumlah User</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $role)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $role->name }}</td>
                                                    <td>{{ $role->name }}</td>
                                                    <td>{{ $role->users->count() }}</td>
                                                    <td>
                                                        @can('role-manage')
                                                            {{-- <a class="btn btn-xs btn-success"
                                                                href="{{ route('roles.show', $role->id) }}">Show</a> --}}
                                                            <a class="btn btn-xs btn-primary"
                                                                href="{{ route('roles.edit', $role->id) }}">Edit</a>
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role], 'style' => 'display:inline']) !!}
                                                            {!! Form::submit('Delete', ['class' => 'btn btn-xs btn-danger', 'onclick' => "return confirm('Apakah anda yakin akan menghapus $role->name ?')"]) !!}
                                                            {!! Form::close() !!}
                                                        @endcan
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection

@section('js')
    <script src="//cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    {{-- <script src="//cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script> --}}
    <script src="//cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#DataTable').DataTable({
                scrollX: true,
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'colvis',
                    {
                        extend: 'excelHtml5',
                        autoFilter: true,
                        sheetName: 'Exported data'
                    }, 'pdfHtml5'
                ]
            });
        });
    </script>
@stop
