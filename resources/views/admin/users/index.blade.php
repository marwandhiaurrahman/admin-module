@extends('adminlte::page')

@section('title', 'User')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">User</h1>
            </div>
            <div class="col-sm-6">
                <div class="breadcrumb float-sm-right">
                    {{ Breadcrumbs::render('users') }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data User</h3>
                        <div class="card-tools">
                            @can('user-manage')
                                <a href="{{ route('users.create') }}" class="btn btn-sm btn-success">Tambah Pengguna</a>
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
                                                <th>Username</th>
                                                <th>Telepon</th>
                                                <th>Email</th>
                                                <th>Roles</th>
                                                <th>Created at</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $user)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->username }}</td>
                                                    <td>{{ $user->telp }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        @if (!empty($user->getRoleNames()))
                                                            @foreach ($user->getRoleNames() as $v)
                                                                <label
                                                                    class="badge badge-success">{{ $v }}</label>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td>{{ $user->created_at }}</td>
                                                    <td>

                                                        @can('user-manage')

                                                            {{-- <a class="btn btn-xs btn-success"
                                                            href="{{ route('users.show', $user->id) }}">Show</a> --}}
                                                            <a class="btn btn-xs btn-primary"
                                                                href="{{ route('users.edit', $user->id) }}">Edit</a>
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                                                            {!! Form::submit('Delete', ['class' => 'btn btn-xs btn-danger', 'onclick' => "return confirm('Apakah anda yakin akan menghapus $user->name ?')"]) !!}
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
