@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            Block List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            @can('block_create')
                <li><a href="{{ route('block.create') }}">Block Add</a></li>
            @endcan
        </ol>
    </section>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Block List</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @if (session()->has('success'))
                <div class="alert alert-success" id="msg">
                    {{ session()->get('success') }}
                </div>
            @endif
            <table id="myTable" class="table table-bordered table-striped display">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Identifier</th>
                        <th>Titel</th>
                        <th>Heading</th>
                        <th>Ordering</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @php
                    $i = 1;
                @endphp
                <tbody>
                    @forelse ($block as $_block)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $_block->identifier }}</td>
                            <td>{{ $_block->title }}</td>
                            <td>{{ $_block->heading }}</td>
                            <td>{{ $_block->ordering }}</td>
                            <td>{{ $_block->status == '1' ? 'Enable' : 'Disable' }}</td>
                            <td><img src="{{ $_block->getFirstMediaUrl('image', 'thumb') }}" / width="120px"></td>

                            <td>
                                @can('block_edit')
                                    <a href="{{ route('block.edit', $_block->id) }}"class="btn btn-primary"
                                        style="float: left;margin-right:4px;"><i class="fa fa-edit"></i>Edit</a>
                                    </a>
                                @endcan
                                @can('block_delete')
                                    <form action="{{ route('block.destroy', $_block->id) }}" method="post">
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
                            <td colspan="6" align="center">No data found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
