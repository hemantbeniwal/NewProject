@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            Role List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            @can('role')
                <li><a href="{{ route('role.create') }}">Role Create</a></li>
            @endcan
            <li class="active">Role List</li>
        </ol>
    </section>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                @if (session()->has('success'))
                    <div class="alert alert-success" id="msg">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="box-header">
                    <div class="box-tools">
                        <div class="input-group">
                            <input type="text" name="table_search" class="form-control input-sm pull-right"
                                style="width: 150px;" placeholder="Search" />
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        @php
                            $i = 1;
                        @endphp
                        @forelse ($role as $_role)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $_role->name }}</td>
                                @can('role')
                                    <td>
                                        <a href="{{ route('role.edit', $_role->id) }}"
                                            class="btn btn-primary" style="float: left;margin-right:4px;"><i class="fa fa-edit"></i>Edit
                                        </a>
                                        <form action="{{ route('role.destroy', $_role->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button  class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Data')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button> 

                                        </form>
                                    </td>
                                @endcan
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" align="center">No data found.</td>
                            </tr>
                        @endforelse

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
@endsection
