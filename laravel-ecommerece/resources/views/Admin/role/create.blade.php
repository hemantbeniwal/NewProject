@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            Role Create
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('role.index') }}">Role List</a></li>
        </ol>
    </section>
    <div class="col-md-12">
        <div class="box box-primary">
            <form action="{{ route('role.store') }}" method="POST">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Role">
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    @foreach ($permission as $_permission)
                        <div class="checkbox">
                            <input type="checkbox" name="permission[]"
                                value="{{ $_permission->name }}">{{ $_permission->name }}
                        </div>
                    @endforeach
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
