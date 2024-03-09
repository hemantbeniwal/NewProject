@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            Category List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            @can('category_create')
                <li><a href="{{ route('category.create') }}">Category Add</a></li>
            @endcan
        </ol>
    </section>
    <div class="box">
        @if (session()->has('success'))
            <div class="alert alert-success" id="msg">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="box-body">
            <table id="myTable" class="table table-bordered display">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Product Name</th>
                        <th>Status</th>
                        <th>Show in menu</th>
                        <th>Meta tag</th>
                        <th>Meta title</th>
                        <td>Image</td>
                        <th>Action</th>

                </thead>
                @php
                    $i = 1;
                @endphp
                <tbody>
                    @forelse ($category as $_category)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $_category->name }}</td>
                            <td>{!! $_category->status == 1
                                ? '<span class = "btn btn-block btn-success btn-xs">Enable</span>'
                                : '<span class="btn btn-block btn-danger btn-xs">Disable</span>' !!}</td>
                            <td>{!! $_category->show_in_menu == 1
                                ? '<span class="btn btn-block btn-success btn-xs">Yes</span>'
                                : '<span class="btn btn-block btn-danger btn-xs">No</span>' !!}</td>
                            <td>{{ $_category->meta_tag }}</td>
                            <td>{{ $_category->meta_title }}</td>
                            <td><img src="{{ $_category->getFirstMediaUrl('image', 'thumb') }}" / width="120px"></td>
                            <td>
                                @can('category_edit')
                                    <a href="{{ route('category.edit', $_category->id) }}"class="btn btn-primary"
                                        style="float: left;margin-right:4px;"><i class="fa fa-edit"></i>Edit</a>
                                @endcan
                                @can('category_delete')
                                    <form action="{{ route('category.destroy', $_category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this Data')"><i
                                                class="fa fa-trash" aria-hidden="true"></i>
                                            Delete</button>

                                    </form>
                                @endcan
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8" align="center">No data found.</td>
                        </tr>
                    @endforelse
            </table>
        </div><!-- /.box-body -->
    </div>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
