@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            Page List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            @can('page_create')
                <li><a href="{{ route('page.create') }}">Page Add</a></li>
            @endcan
        </ol>
    </section>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Page List</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @if (session()->has('success'))
                <div class="alert alert-success" id="msg">
                    {{ session()->get('success') }}
                </div>
            @endif
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Titel</th>
                        <th>Heading</th>
                        <th>Ordering</th>
                        <th>Status</th>
                        <th>url_key</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @php
                    $i = 1;
                @endphp
                <tbody>
                    @forelse ($page as $_page)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $_page->title }}</td>
                            <td>{{ $_page->heading }}</td>
                            <td>{{ $_page->ordering }}</td>
                            <td>{{ $_page->status == '1' ? 'Enable' : 'Disable' }}</td>
                            <td>{{ $_page->url_key }}</td>
                            <td><img src="{{ $_page->getFirstMediaUrl('image', 'thumb') }}" / width="120px"></td>

                            <td>
                                @can('page_edit')
                                    <a href="{{ route('page.edit', $_page->id) }}"class="btn btn-primary" style="float: left;margin-right:4px;"><i class="fa fa-edit"></i>Edit</a> 
                                @endcan
                                @can('page_delete')
                                    <form action="{{ route('page.destroy', $_page->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button  class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Data')"><i class="fa fa-trash" aria-hidden="true" ></i> Delete</button> 

                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" align="center">No data found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div>
@endsection
