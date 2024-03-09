@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            User List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            @can('user_create')
                <li><a href="{{ route('user.create') }}">User Create</a></li>
            @endcan
            <li class="active">User List</li>
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
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @forelse ($user as $_user)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $_user->name }}</td>
                                    <td>{{ $_user->email }}</td>
                                    <td>{{ implode(',', $_user->Roles->pluck('name')->toArray()) }}</td>
                                    <td>
                                        @can('user_edit')
                                            <a href="{{ route('user.edit', $_user->id) }}" class="btn btn-primary"
                                                style="float: left;margin-right:4px;"><i class="fa fa-edit"></i>Edit</a>
                                        @endcan
                                        @can('user_delete')
                                            <form action="{{ route('user.destroy', $_user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Data')"><i class="fa fa-trash" aria-hidden="true"></i>
                                                    Delete</button>

                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" align="center">No data found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
@endsection
