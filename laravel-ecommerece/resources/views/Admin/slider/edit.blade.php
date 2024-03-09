@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <div class="box box-primary">
            <section class="content-header">
                <h1>
                    Slider Edit
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    @can('slider_index')
                        <li><a href="{{ route('slider.index') }}">Page List</a></li>
                    @endcan
                </ol>
            </section>
            <form action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="box-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Title"
                            value="{{ $slider->title }}">
                        @error('title')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Ordering</label>
                        <input type="number" name="ordering" class="form-control"placeholder="Ordering"
                            value="{{ $slider->ordering }}">
                        @error('ordering')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="" selected disabled>Action</option>
                            <option value="1"{{ $slider->status == 1 ? 'selected' : null }}>Enable</option>
                            <option value="2" {{ $slider->status == 2 ? 'selected' : null }}>Disable</option>
                        </select>
                        @error('status')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile"></label>
                        <input type="file" name="image" value="{{ $slider->getFirstMediaUrl('image') }}">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
