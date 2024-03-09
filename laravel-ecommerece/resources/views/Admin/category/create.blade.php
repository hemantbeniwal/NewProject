@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            Category Add
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            @can('category_index')
            <li><a href="{{ route('category.index') }}">Category List</a></li>
            @endcan
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
                        <h3 class="box-title">Category Add</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Category parent id</label>
                                        <select name="category_parent_id" id="" class="form-control">

                                            <option value="">Category parent id</option>
                                            @foreach (getCategory() as $categorys)
                                                <option value="{{ $categorys->id }}">{{ $categorys->name }}</option>
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @foreach (getsubCategory($categorys->id) as $subcategory)
                                                    <option value="{{ $subcategory->id }}">{{$i++}} --{{ $subcategory->name }}</option>
                                                    @php
                                                        $sub = 1;
                                                    @endphp
                                                    @foreach (getsubsubCategory($subcategory->id) as $subsubcategory)
                                                    <option value="{{ $subsubcategory->id }}">{!!'&nbsp; &nbsp; '!!}{{$sub++}} --{{ $subsubcategory->name }}</option>
                                                        
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
                                            placeholder="Enter Category name" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Product name</label>
                                        <select name="products[]" class="form-control" multiple>
                                            @foreach ($product as $_product)
                                            <option value="{{$_product->id}}">{{$_product->name}}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Select status</label>
                                        <select name="status" class="form-control">
                                            <option value="" selected disabled>Select status</option>
                                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Enable
                                            </option>
                                            <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Disable
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
                                            <option value="1"{{ old('show_in_menu') == 1 ? 'selected' : null }}>Yes
                                            </option>
                                            <option value="2"{{ old('show_in_menu') == 2 ? 'selected' : null }}>No
                                            </option>
                                        </select>
                                        @error('show_in_menu')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Short description</label>
                                        <textarea name="short_description" class="form-control" cols="10" rows="2"></textarea>
                                        @error('short_description')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> <!-- col-md-6 end -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="editor" class="form-control" cols="10" rows="4"></textarea>
                                        @error('description')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>URL Key</label>
                                        <input type="text" name="url_key" class="form-control"
                                            placeholder="Product url key">
                                        @error('url_key')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Meta tag</label>
                                        <input type="text" name="meta_tag" class="form-control"
                                            placeholder="Product meta tag">
                                        @error('meta_tag')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Meta title</label>
                                        <input type="text" name="meta_title" class="form-control"
                                            placeholder="Product meta title">
                                        @error('meta_title')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Meta description</label>
                                        <textarea name="meta_description" class="form-control" cols="30" rows="2"></textarea>
                                        @error('meta_description')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Image Upload</label>
                                        <input type="file" name="image[]" multiple>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Thumbnail Image </label>
                                        <input type="file" id="exampleInputFile" name="thumbnail_image">
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" name="save" value="save"
                                            class="btn btn-primary">Save</button>
                                        <button type="submit"class="btn btn-primary">Save
                                            & New</button>
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
