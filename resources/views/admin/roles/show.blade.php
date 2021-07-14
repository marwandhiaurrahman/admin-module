
@extends('adminlte::page')

@section('title', $role->name.' Role')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Roles {{$role->name}}</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <div class="breadcrumb float-sm-right">
            {{ Breadcrumbs::render('roles.show',$role) }}
        </div>
    </div><!-- /.col -->
</div>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $role->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permissions:</strong>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <label class="label label-success">{{ $v->name }},</label>
                @endforeach
            @endif
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop
