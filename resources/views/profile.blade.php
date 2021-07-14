@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <div class="breadcrumb float-sm-right">
                    {{ Breadcrumbs::render('profile') }}
                </div>
            </div><!-- /.col -->
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            @if (config('adminlte.usermenu_image'))
                                <img src="{{ Auth::user()->adminlte_image() }}"
                                    class="profile-user-img img-fluid img-circle" alt="{{ Auth::user()->name }}">
                            @endif
                        </div>
                        <h3 class="profile-username text-center">{{ $user->name }}</h3>
                        <p class="text-muted text-center">
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRoleNames() as $v)
                                    {{ $v }}
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Education</strong>
                        <p class="text-muted">
                            B.S. in Computer Science from the University of Tennessee at Knoxville
                        </p>
                        <hr>
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                        <p class="text-muted">{{ $user->alamat }}
                            {{ $user->desa && $user->kecamatan && $user->kabupaten && $user->provinsi ? ucwords(strtolower('DESA ' . $user->desa->name . ', KECAMATAN ' . $user->kecamatan->name . ', ' . $user->kabupaten->name . ', ' . $user->provinsi->name)) : null }}
                        </p>
                        <hr>
                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                        <p class="text-muted">
                            <span class="tag tag-danger">UI Design</span>
                            <span class="tag tag-success">Coding</span>
                            <span class="tag tag-info">Javascript</span>
                            <span class="tag tag-warning">PHP</span>
                            <span class="tag tag-primary">Node.js</span>
                        </p>
                        <hr>
                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim
                            neque.</p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#biodata" data-toggle="tab">Biodata</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::model($user, ['method' => 'PATCH', 'route' => ['updateprofile', $user->id], 'files' => true]) !!}
                        <div class="tab-content">
                            <div class="tab-pane active" id="biodata">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="form-group row">
                                    {!! Form::label('name', 'Name', ['class' => 'col-sm-2 col-form-label']) !!}
                                    <div class="col-sm-10">
                                        {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control', 'readonly']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {!! Form::label('nik', 'NIK', ['class' => 'col-sm-2 col-form-label']) !!}
                                    <div class="col-sm-10">
                                        {!! Form::text('nik', null, ['placeholder' => 'NIK', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Provinsi</label>
                                    <div class="col-sm-10">
                                        {!! Form::select('province_id', $provinces, null, [
    'class' => 'form-control
                                    select2',
    'id' => 'province',
]) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Kota / Kabupaten</label>
                                    <div class="col-sm-10">
                                        {!! Form::select('city_id', $cities, null, [
    'class' => 'form-control
                                    select2',
    'id' => 'city',
]) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Kecamatan</label>
                                    <div class="col-sm-10">
                                        {!! Form::select('district_id', $districts, null, ['class' => 'form-control select2', 'id' => 'district']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Desa</label>
                                    <div class="col-sm-10">
                                        {!! Form::select('village_id', $villages, null, [
    'class' => 'form-control
                                    select2',
    'id' => 'village',
]) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        {!! Form::textarea('alamat', null, ['class' => 'form-control', 'rows' => '2']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="settings">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="form-group row">
                                    {!! Form::label('name', 'Name', ['class' => 'col-sm-2 col-form-label']) !!}
                                    <div class="col-sm-10">
                                        {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {!! Form::label('username', 'Username', ['class' => 'col-sm-2 col-form-label']) !!}
                                    <div class="col-sm-10">
                                        {!! Form::text('username', null, ['placeholder' => 'Username', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {!! Form::label('telp', 'Telepon / HP', ['class' => 'col-sm-2 col-form-label']) !!}
                                    <div class="col-sm-10">
                                        {!! Form::text('telp', null, ['placeholder' => 'Telepon / HP', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {!! Form::label('email', 'Email', ['class' => 'col-sm-2 col-form-label']) !!}
                                    <div class="col-sm-10">
                                        {!! Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {!! Form::label('role', 'Roles', ['class' => 'col-sm-2 col-form-label']) !!}
                                    <div class="col-sm-10">
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $v)
                                                {!! Form::text('roles', $v, ['class' => 'form-control', 'readonly']) !!}
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                @if (config('adminlte.usermenu_image'))
                                    <div class="form-group row">
                                        {!! Form::label('foto', 'Foto', ['class' => 'col-sm-2 col-form-label']) !!}
                                        <div class="col-sm-10">
                                            {!! Form::file('foto', ['class' => 'form-control']) !!}
                                            @if ($user->foto == null)
                                                <small class="form-text text-muted">Belum memiliki foto</small>
                                            @else
                                                <small class="form-text text-muted">Foto sebelumnya :
                                                    {{ $user->foto }}</small>
                                            @endif
                                            <small class="form-text text-muted">( Kosongkan apabila tidak ingin ada
                                                perubahan
                                                )</small>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row">
                                    {!! Form::label('password', 'Password', ['class' => 'col-sm-2 col-form-label']) !!}
                                    <div class="col-sm-10">
                                        {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {!! Form::label('password', 'Confirm Password', [
    'class' => 'col-sm-2
                                col-form-label',
]) !!}
                                    <div class="col-sm-10">
                                        {!! Form::password('confirm-password', [
    'placeholder' => 'Confirm
                                    Password',
    'class' => 'form-control',
]) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        {!! Form::close() !!}
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@stop

@section('js')
    <script>
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#province').on('change', function() {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: '/city/' + id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#city').empty();
                            $.each(data, function(id, name) {
                                $('#city').append(new Option(name, id));
                            });
                        }
                    });
                } else {
                    $('#city').empty();
                }
            });
            $('#city').on('change', function() {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: '/district/' + id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#district').empty();
                            $.each(data, function(id, name) {
                                $('#district').append(new Option(name, id));
                            });
                        }
                    });
                } else {
                    $('#district').empty();
                }
            });
            $('#district').on('change', function() {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: '/village/' + id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#village').empty();
                            $.each(data, function(id, name) {
                                $('#village').append(new Option(name, id));
                            });
                        }
                    });
                } else {
                    $('#village').empty();
                }
            });
        });
    </script>
@stop
