@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            Role Edit
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            @can('role')
                <li><a href="{{ route('role.index') }}">Role List</a></li>
            @endcan
        </ol>
    </section>
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Role</h3>
            </div>
            <form action="{{ route('role.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="box-body">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Role"
                            value="{{ $role->name }}">
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    @foreach ($permission as $_permissions)
                        <div class="checkbox">
                            <label for=""></label>
                            <input type="checkbox" name=" permission[]" value="{{ $_permissions->name }}"
                                {{ in_array($_permissions->name, $permiData) ? 'checked' : '' }}>{{ $_permissions->name }}
                        </div>
                    @endforeach
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
