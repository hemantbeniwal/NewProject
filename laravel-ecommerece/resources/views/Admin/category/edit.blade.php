@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            Category Edit
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('category.index') }}">Category List</a></li>
        </ol>
    </section>
    @if (session()->has('success'))
        <div class="alert alert-success" id="msg">
            {{ session()->get('success') }}
        </div>
    @endif
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Category Edit</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Category parent id</label>
                                        <select name="category_parent_id" id="" class="form-control">

                                            <option value=""selected disabled>Category parent id</option>
                                            @foreach (getCategory() as $categorys)
                                                <option value="{{ $categorys->id }}"
                                                    {{ $category->category_parent_id == $categorys->id ? 'selected' : '' }}>
                                                    {{ $categorys->name }}</option>
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @foreach (getsubCategory($categorys->id) as $subcategory)
                                                    <option value="{{ $subcategory->id }}"
                                                        {{ $category->category_parent_id == $subcategory->id ? 'selected' : '' }}>
                                                        {{ $i++ }} --{{ $subcategory->name }}</option>
                                                    @php
                                                        $sub = 1;
                                                    @endphp
                                                    @foreach (getsubsubCategory($subcategory->id) as $subsubcategory)
                                                        <option value="{{ $subsubcategory->id }}"
                                                            {{ $category->category_parent_id == $subsubcategory->id ? 'selected' : '' }}>
                                                            {!! '&nbsp; &nbsp; ' !!}{{ $sub++ }}
                                                            --{{ $subsubcategory->name }}</option>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>
                                        @error('name')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Category name</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter product name" value="{{ $category->name }}">
                                        @error('name')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Product name</label>
                                        <select name="products[]" class="form-control" multiple>
                                            @foreach ($products as $_product)
                                            <option value="{{$_product->id}}"{{ in_array($_product->id, $category->products->pluck('id')->toArray() ?? []) ? 'selected' : ''}}>{{$_product->name}}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Select status</label>
                                        <select name="status" class="form-control">
                                            <option value="" selected disabled>Select status</option>
                                            <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Enable
                                            </option>
                                            <option value="2" {{ $category->status == 2 ? 'selected' : '' }}>
                                                Disable
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Show in menu</label>
                                        <select name="show_in_menu" class="form-control">
                                            <option value="" selected disabled>Select featured</option>
                                            <option value="1"{{ $category->show_in_menu == 1 ? 'selected' : null }}>
                                                Yes
                                            </option>
                                            <option value="2"{{ $category->show_in_menu == 2 ? 'selected' : null }}>
                                                No
                                            </option>
                                        </select>
                                        @error('show_in_menu')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Short description</label>
                                        <textarea name="short_description" class="form-control" cols="10" rows="2"> {{ $category->short_description }}</textarea>
                                        @error('short_description')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> <!-- col-md-6 end -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="editor" class="form-control" cols="10" rows="4">{{ $category->description }}</textarea>
                                        @error('description')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Meta tag</label>
                                        <input type="text" name="meta_tag" class="form-control"
                                            placeholder="Product meta tag" value="{{ $category->meta_tag }}">
                                        @error('meta_tag')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Meta title</label>
                                        <input type="text" name="meta_title" class="form-control"
                                            placeholder="Product meta title" value="{{ $category->meta_title }}">
                                        @error('meta_title')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Meta description</label>
                                        <textarea name="meta_description" class="form-control" cols="30" rows="2">{{ $category->meta_description }}</textarea>
                                        @error('meta_description')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Image Upload</label>
                                        <input type="file" id="exampleInputFile" name="image[]" 
                                        value='{{ $category->getMedia('image') }}' multiple>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">ThumbNail Upload</label>
                                        <input type="file" id="exampleInputFile" name="thumbnail_image" 
                                        value='{{ $category->getFirstMediaUrl('thumbnail_image') }}'>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">update</button>
                                    </div>
                                </div>
                            </div> <!-- row end -->

                        </div><!-- /.box-body -->


                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
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
