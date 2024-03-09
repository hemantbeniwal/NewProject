@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <div class="box box-primary">
            <section class="content-header">
                <h1>
                    Page Edit
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    @can('page_index')
                        <li><a href="{{ route('page.index') }}">Page List</a></li>
                    @endcan
                </ol>
            </section>
            <form action="{{ route('page.update', $page->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="box-body">
                    <div class="form-group">
                        <label>parent page</label>
                        <select name="parent_id" class="form-control">
                            <option value="" selected disabled>select</option>
                            @foreach (getpages() as $_page)
                                <option value="{{ $_page->id }}"{{ ($_page == $page->title) ? 'selected' : '' }}>{{ $_page->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Title"
                            value="{{ $page->title }}">
                        @error('title')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Heading</label>
                        <input type="text" name="heading" class="form-control" placeholder="Heading"
                            value="{{ $page->heading }}">
                        @error('title')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Ordering</label>
                        <input type="number" name="ordering" class="form-control" placeholder="Ordering" value="{{$page->ordering}}">
                        @error('ordering')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="" selected disabled>Action</option>
                            <option value="1"{{ $page->status == 1 ? 'selected' : null }}>Enable</option>
                            <option value="2" {{ $page->status == 2 ? 'selected' : null }}>Disable</option>
                        </select>
                        @error('status')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                        <label>url_key</label>
                        <input type="text" name="url_key" class="form-control"placeholder="url_key"
                            value="{{ $page->url_key }}">
                        @error('url_key')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div> --}}
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="editor" cols="30" rows="10">{{ $page->description }}</textarea>
                        {{-- <input type="text" name="description" class="form-control"placeholder="description" value=""> --}}
                        @error('description')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile"></label>
                        <input type="file" name="image" value="{{ $page->getFirstMediaUrl('image') }}">
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
