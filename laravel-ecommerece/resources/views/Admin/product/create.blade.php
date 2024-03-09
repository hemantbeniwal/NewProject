@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            Product Add
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            @can('product_index')
            <li><a href="{{ route('product.index') }}">Product List</a></li>
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
                        <h3 class="box-title">Product Add</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Product name</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter product name" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Categories name</label>
                                        <select name="categories[]" class="form-control" multiple>
                                            <option value="">Select category</option>
                                            @foreach ($category as $_category)
                                                <option value="{{ $_category->id }}">{{ $_category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                        @foreach (getattribute() as $attribute)
                                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                                <input type="hidden" name="attribute[]" value="{{ $attribute->id }}">
                                                <label >{{ $attribute->name }}:</label>
                                                <select name="value[{{ $attribute->id }}][]" class="form-control" multiple>
                                                    @foreach ($attribute->attribute_value as $_attribute)
                                                        <option value="{{ $_attribute->id }}">{{ $_attribute->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endforeach
                                 
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
                                        <label>Is featured</label>
                                        <select name="is_featured" class="form-control">
                                            <option value="" selected disabled>Select featured</option>
                                            <option value="1"{{ old('is_featured') == 1 ? 'selected' : null }}>Yes
                                            </option>
                                            <option value="2"{{ old('is_featured') == 2 ? 'selected' : null }}>No
                                            </option>
                                        </select>
                                        @error('is_featured')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label>Stock Keeping Unit(sku)</label>
                                        <input type="text" class="form-control" name="sku" step="any"
                                            placeholder="Product sku">
                                        @error('sku')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Quantity (qty)</label>
                                        <input type="number" class="form-control" step="any" name="qty"
                                            placeholder="Product qty">
                                        @error('qty')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Stock status</label>
                                        <select name="stock_status" class="form-control">
                                            <option value="">Stock Status</option>
                                            <option value="1">In Stock</option>
                                            <option value="2">Out of Stock</option>
                                        </select>
                                        @error('stock_status')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Weight</label>
                                        <input type="number" class="form-control" step="any" name="weight"
                                            placeholder="Product weight">
                                        @error('weight')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" class="form-control" step="any" name="price"
                                            placeholder="Product price">
                                        @error('price')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Special price</label>
                                        <input type="number" class="form-control" step="any" name="special_price"
                                            placeholder="Product special price">
                                        @error('special_price')
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

                                </div> <!-- col-md-6 end -->

                                <div class="col-md-6">





                                    <div class="form-group">
                                        <label>Special price from</label>
                                        <input type="date" class="form-control" name="special_price_from">
                                        @error('special_price_from')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Special price to</label>
                                        <input type="date" class="form-control" name="special_price_to">
                                        @error('special_price_to')
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

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="editor" class="form-control" cols="10" rows="4"></textarea>
                                        @error('description')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Related Product</label>
                                        <select name="related_product[]" multiple class="form-control">
                                            <option value="">Select related products</option>
                                            @foreach ($products as $_products)
                                                <option value="{{ $_products->id }}">{{ $_products->name }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" name="related_product" class="form-control"
                                            placeholder="Related product"> --}}
                                        @error('related_product')
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
                                        <button type="submit" name="save_new" value="save_new"
                                            class="btn btn-primary">Save & New</button>
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
