@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            Attribute List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            @can('attribute_create')
                <li><a href="{{ route('attribute.create') }}">Attribute Add</a></li>
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
                        <th>Attribute name</th>
                        <th>Attribute name Key</th>
                        <th>Is variant</th>
                        <th>Status</th>
                        <th>Action</th>

                </thead>
                @php
                    $i = 1;
                @endphp
                <tbody>
                    @forelse ($attribute as $_attribute)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $_attribute->name }}</td>
                            <td>{{ $_attribute->name_key }}</td>
                            <td>{!! $_attribute->status == 1
                                ? '<span class = "btn btn-block btn-success btn-xs">Enable</span>'
                                : '<span class="btn btn-block btn-danger btn-xs">Disable</span>' !!}</td>
                            <td>{!! $_attribute->is_variant == 1
                                ? '<span class="btn btn-block btn-success btn-xs">Yes</span>'
                                : '<span class="btn btn-block btn-danger btn-xs">No</span>' !!}</td>
                            <td>
                                @can('attribute_edit')
                                    <a href="{{ route('attribute.edit', $_attribute->id) }}"class="btn btn-primary"
                                        style="float: left;margin-right:4px;"><i class="fa fa-edit"></i>Edit</a>
                                @endcan
                                @can('attribute_delete')
                                    <form action="{{ route('attribute.destroy', $_attribute->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this Data')"><i
                                                class="fa fa-trash" aria-hidden="true"></i> Delete</button>

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
