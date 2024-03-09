@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <div class="box box-primary">
            <section class="content-header">
                <h1>
                    Slider Create
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="{{ route('slider.index') }}">Page List</a></li>
                </ol>
            </section>
            <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Title"
                            value="{{ old('title') }}">
                        @error('title')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Ordering</label>
                        <input type="number" name="ordering" class="form-control"placeholder="Ordering"
                            value="{{ old('ordering') }}">
                        @error('ordering')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="" selected disabled>Action</option>
                            <option value="1"{{ old('status') == 1 ? 'selected' : null }}>Enable</option>
                            <option value="2" {{ old('status') == 2 ? 'selected' : null }}>Disable</option>
                        </select>
                        @error('status')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile"></label>
                        <input type="file" name="image">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
