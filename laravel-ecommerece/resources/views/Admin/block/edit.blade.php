@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <div class="box box-primary">
            <section class="content-header">
                <h1>
                    Block Edit
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    @can('block_index')
                        <li><a href="{{ route('block.index') }}">Block List</a></li>
                    @endcan
                </ol>
            </section>
            <form action="{{ route('block.update', $block->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="box-body">
                    <div class="form-group">
                        <label>Identifier</label>
                        <input type="text" name="identifier" class="form-control" placeholder="identifier"
                            value="{{ $block->identifier }}">
                        @error('identifier')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Title"
                            value="{{ $block->title }}">
                        @error('title')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Heading</label>
                        <input type="text" name="heading" class="form-control" placeholder="Heading"
                            value="{{ $block->heading }}">
                        @error('title')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Ordering</label>
                        <input type="number" name="ordering" class="form-control"placeholder="Ordering"
                            value="{{ $block->ordering }}">
                        @error('ordering')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="" selected disabled>Action</option>
                            <option value="1"{{ $block->status == 1 ? 'selected' : null }}>Enable</option>
                            <option value="2" {{ $block->status == 2 ? 'selected' : null }}>Disable</option>
                        </select>
                        @error('status')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label>description</label>
                        <textarea name="description" id="editor" cols="30" rows="10">{{$block->description}}</textarea>
                        {{-- <input type="text" name="description" class="form-control"placeholder="description" value="{{ $block->description}}"> --}}
                        @error('description')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" name="image" id="exampleInputFile"
                            value="{{ $block->getFirstMediaUrl('image') }}">
                        <p class="help-block">Example block-level help text here.</p>
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: '{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}',
                }
            })
            .catch(error => {

            });
    </script>
@endsection
