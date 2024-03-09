@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            Slider List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            @can('slider_create')
                <li><a href="{{ route('slider.create') }}">Slider Add</a></li>
            @endcan
        </ol>
    </section>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Slider List</h3>
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
                    @forelse ($slider as $_slider)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $_slider->title }}</td>
                            <td>{{ $_slider->ordering }}</td>
                            <td>{{ $_slider->status == '1' ? 'Enable' : 'Disable' }}</td>
                            <td><img src="{{ $_slider->getFirstMediaUrl('image', 'thumb') }}" / width="120px"></td>
                            <td>
                                @can('slider_edit')
                                    <a href="{{ route('slider.edit', $_slider->id) }}"class="btn btn-primary" style="float: left;margin-right:4px;"><i class="fa fa-edit"></i>Edit</a> 

                                    </a>
                                @endcan
                                @can('slider_delete')
                                    <form action="{{ route('slider.destroy', $_slider->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button  class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Data')"><i class="fa fa-trash" aria-hidden="true" ></i> Delete</button> 

                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" align="center">No data found.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div><!-- /.box-body -->
    </div>
@endsection
