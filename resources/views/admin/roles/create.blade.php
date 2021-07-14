@extends('adminlte::page')

@section('title', 'Crate Role')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Role</h1>
            </div>
            <div class="col-sm-6">
                <div class="breadcrumb float-sm-right">
                    {{ Breadcrumbs::render('roles.create') }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Keterangan Role</h3>
                    </div>
                    {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama Role</label>
                            {!! Form::text('name', null, ['placeholder' => 'Nama Role', 'id' => 'name', 'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : null), 'required']) !!}
                            @error('name')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            @foreach ($permission as $value)
                                <div class="custom-control custom-checkbox">
                                    {{ Form::checkbox('permission[]', $value->id, false, ['class' => 'custom-control-input', 'id' => $value->name]) }}
                                    <label for="{{ $value->name }}" class="custom-control-label">{{ $value->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
