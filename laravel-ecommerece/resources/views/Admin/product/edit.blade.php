@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            Product Edit
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('product.index') }}">Product List</a></li>
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
                        <h3 class="box-title">Product Edit</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('product.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Product name</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter product name" value="{{ $product->name }}">
                                        @error('name')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Category name</label>
                                        <select name="categories[]" class="form-control" multiple>
                                            @foreach ($categories as $_categories)
                                                <option value="{{ $_categories->id }}"
                                                    {{ in_array($_categories->id, $product->categories->pluck('id')->toArray() ?? []) ? 'selected' : '' }}>
                                                    {{ $_categories->name }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" class="form-control" name="name"
                                            placeholder="Enter product name" value="{{ $product->name }}"> --}}
                                        @error('name')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @foreach (getattribute() as $attribute)
                                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                            <input type="hidden" name="attribute[]" value="{{ $attribute->id }}">
                                            <label for="attributes">{{ $attribute->name }}:</label>
                                            <select name="value[{{ $attribute->id }}][]" class="form-control" multiple>
                                                @foreach ($attribute->attribute_value as $_attribute)
                                                    <option
                                                        value="{{ $_attribute->id }}"{{ in_array($_attribute->id, $productAtt) ? 'selected' : '' }}>
                                                        {{ $_attribute->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('value')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endforeach
                                    <div class="form-group">
                                        <label>Select status</label>
                                        <select name="status" class="form-control">
                                            <option value="" selected disabled>Select status</option>
                                            <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Enable
                                            </option>
                                            <option value="2" {{ $product->status == 2 ? 'selected' : '' }}>Disable
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
                                            <option value="1"{{ $product->is_featured == 1 ? 'selected' : null }}>Yes
                                            </option>
                                            <option value="2"{{ $product->is_featured == 2 ? 'selected' : null }}>No
                                            </option>
                                        </select>
                                        @error('is_featured')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label>Stock Keeping Unit(sku)</label>
                                        <input type="text" class="form-control" name="sku" step="any"
                                            placeholder="Product sku" value="{{ $product->sku }}">
                                        @error('sku')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Quantity (qty)</label>
                                        <input type="number" class="form-control" step="any" name="qty"
                                            placeholder="Product qty" value="{{ $product->qty }}">
                                        @error('qty')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Stock status</label>
                                        <select name="stock_status" class="form-control">
                                            <option value="">Stock Status</option>
                                            <option value="1" {{ $product->stock_status == 1 ? 'selected' : null }}>In
                                                Stock</option>
                                            <option value="2"{{ $product->stock_status == 2 ? 'selected' : null }}>Out
                                                of Stock</option>
                                        </select>
                                        @error('stock_status')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Weight</label>
                                        <input type="number" class="form-control" step="any" name="weight"
                                            placeholder="Product weight" value="{{ $product->weight }}">
                                        @error('weight')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" class="form-control" step="any" name="price"
                                            placeholder="Product price" value="{{ $product->price }}">
                                        @error('price')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Special price</label>
                                        <input type="number" class="form-control" step="any" name="special_price"
                                            placeholder="Product special price" value="{{ $product->special_price }}">
                                        @error('special_price')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div> <!-- col-md-6 end -->

                                <div class="col-md-6">





                                    <div class="form-group">
                                        <label>Special price from</label>
                                        <input type="date" class="form-control" name="special_price_from"
                                            value="{{ date('Y-m-d', strtotime($product->special_price_from)) }}">
                                        @error('special_price_from')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Special price to</label>
                                        <input type="date" class="form-control" name="special_price_to"
                                            value="{{ date('Y-m-d', strtotime($product->special_price_to)) }}">
                                        @error('special_price_to')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Short description</label>
                                        <textarea name="short_description" class="form-control" cols="10" rows="2">{{ $product->short_description }}</textarea>
                                        @error('short_description')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="editor" class="form-control" cols="10" rows="4">{{ $product->description }}</textarea>
                                        @error('description')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Related Product</label>
                                        <select name="related_product[]" class="form-control" multiple>
                                            @foreach ($relatedProducts as $_relatedProducts)
                                                <option
                                                    value="{{ $_relatedProducts->id }}"{{ in_array($_relatedProducts->id, explode(',', $product->related_product) ?? []) ? 'selected' : '' }}>
                                                    {{ $_relatedProducts->name }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" name="related_product" class="form-control"
                                            placeholder="Related product" value="{{ $product->related_product }}"> --}}
                                        @error('related_product')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>



                                    <div class="form-group">
                                        <label>Meta tag</label>
                                        <input type="text" name="meta_tag" class="form-control"
                                            placeholder="Product meta tag" value="{{ $product->meta_tag }}">
                                        @error('meta_tag')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Meta title</label>
                                        <input type="text" name="meta_title" class="form-control"
                                            placeholder="Product meta title" value="{{ $product->meta_title }}">
                                        @error('meta_title')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Meta description</label>
                                        <textarea name="meta_description" class="form-control" cols="30" rows="2">{{ $product->meta_description }}</textarea>
                                        @error('meta_description')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Image Upload</label>
                                        <input type="file" id="exampleInputFile" name="image[]"
                                            value='{{ $product->getMedia('image') }}' multiple>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">ThumbNail Upload</label>
                                        <input type="file" id="exampleInputFile" name="thumbnail_image"
                                            value='{{ $product->getFirstMediaUrl('thumbnail_image') }}'>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
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
