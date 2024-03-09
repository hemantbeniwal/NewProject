@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            Permission List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('permission.index') }}">Permissions List</a></li>
        </ol>
    </section>
    <div class="col-md-12">
        <div class="box box-primary">
            <form action="{{ route('permission.store') }}" method="POST">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>Permission</label>
                        <input type="text" name="name" class="form-control" placeholder="Permission">
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <input type="submit" class="btn btn-success" name="save_new" value="Save New">
                </div>
            </form>
        </div>
    </div>
@endsection
