@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            Attribute Edit
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('attribute.index') }}">Attribute List</a></li>
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
                        <h3 class="box-title">Attribute Edit</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('attribute.update',$attribute->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Attribute name</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter product name" value="{{ $attribute->name }}">
                                        @error('name')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Attribute name Key</label>
                                        <input type="text" class="form-control" name="name_key"
                                            placeholder="Enter product name" value="{{ $attribute->name_key }}">
                                        @error('name_key')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Select Is variant</label>
                                        <select name="is_variant" class="form-control">
                                            <option value="" selected disabled>Select Is variant</option>
                                            <option value="1" {{ ($attribute->is_variant== 1) ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="2" {{ ($attribute->is_variant== 2) ? 'selected' : '' }}>No
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Select status</label>
                                        <select name="status" class="form-control">
                                            <option value="" selected disabled>Select status</option>
                                            <option value="1" {{ ($attribute->status== 1)? 'selected' : '' }}>Enable
                                            </option>
                                            <option value="2" {{ ($attribute->status== 2)? 'selected' : '' }}>Disable
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <tr>
                                        <label>Attribute Values</label>
                                        <td>
                                            <table id="add">
                                                <tr>
                                                    <th></th>
                                                    <th> Attribute Name</th>
                                                    <th>status</th>
                                                    <td><button type="button" id="addmore">+</button></td>
                                                </tr>
                                                @foreach ($attribute->attribute_value as $attrivalue)
                                                <tr>
                                                    <td><input type="hidden" name="atri[]" value="{{$attrivalue->id}}"></td>
                                                        
                                                    <td>
                                                        <input type="text" name ="attribute_name[]" value="{{$attrivalue->name}}">
                                                    </td>
                                                    <td>
                                                        <select name ="attribute_status[]">
                                                            <option value="" selected disabled>action</option>
                                                            <option value="1" {{ ($attrivalue->status== 1)? 'selected' : '' }}>Enable</option>
                                                            <option value="2"{{ ($attrivalue->status== 2)? 'selected' : '' }}>disable</option>
                                                        </select>
                                                    </td>
                                                    <td><button class ="remove" type = "button">X</button></td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                    </tr>
                                    <div class="box-footer">
                                        <button type="submit" name="save" value="save"
                                            class="btn btn-primary">Save</button>
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

        $(document).ready(function () {
            $("#addmore").click(function () {
                add_more = '<tr>\
                    <td></td>\
            <td><input type="text" name ="attribute_name[]"></td>\
            <td>\
                <select name ="attribute_status[]">\
                    <option value="">action</option>\
                    <option value="1">Enable</option>\
                    <option value="2">disable</option>\
                </select>\
            </td>\
            <td><button class ="remove" type = "button">X</button></td>\
        </tr>'
                $('#add').append(add_more);
            });

            $("#add").delegate(".remove", "click", function () {

                $(this).closest("tr").remove()
            });

        });

    </script>   
@endsection
