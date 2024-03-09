@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            Permission Edit
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            @can('permission')
                <li><a href="{{ route('permission.index') }}">Permissions List</a></li>
            @endcan
        </ol>
    </section>
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Permission</h3>
            </div>
            <form action="{{ route('permission.update', $permission->id) }}" method="POST">
                @csrf
                @method('PUT');
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Permission</label>
                        <input type="text" name="name" class="form-control" placeholder="Permission"
                            value="{{ $permission->name }}">
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
