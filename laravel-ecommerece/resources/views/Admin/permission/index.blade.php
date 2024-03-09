@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            Permissions List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            @can('permission')
                <li><a href="{{ route('permission.create') }}">Permissions Add</a></li>
            @endcan
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
                    <h3 class="box-title"></h3>
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
                    <table  id="myTable" class="table table-hover display">
                        <tr>
                            <th>ID</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </tr>
                        @php
                            $i = 1;
                        @endphp
                        @forelse ($permission as $_permission)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $_permission->name }}</td>
                                @can('permission')
                                    <td>
                                        <a href="{{ route('permission.edit', $_permission->id) }}"
                                             class="btn btn-primary" style="float: left;margin-right:4px;"><i class="fa fa-edit"></i>Edit</a> 
                                        
                                        <form action="{{ route('permission.destroy', $_permission->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button  class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Data')"><i class="fa fa-trash" aria-hidden="true" ></i> Delete</button> 
                                               
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
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
