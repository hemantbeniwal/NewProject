@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            Managecustomer List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Managecustomer List</li>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @forelse ($users as $_user)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $_user->name }}</td>
                                    <td>{{ $_user->email }}</td>
                                    
                                    <td><a href="{{ route('managecustomer.show', $_user->id) }}"
                                            class="btn btn-primary btn-success">Show</a></td>

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
