@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            Attribute Add
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            @can('attribute_index')
                <li><a href="{{ route('attribute.index') }}">Attribute List</a></li>
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
                        <h3 class="box-title">Attribute Add</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('attribute.store') }}" method="POST">
                        @csrf
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Attribute name</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter product name" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Attribute name Key</label>
                                        <input type="text" class="form-control" name="name_key"
                                            placeholder="Enter product name" value="{{ old('name_key') }}">
                                        @error('name_key')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Select Is variant</label>
                                        <select name="is_variant" class="form-control">
                                            <option value="" selected disabled>Select Is variant</option>
                                            <option value="1" {{ old('is_variant') == 1 ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="2" {{ old('is_variant') == 2 ? 'selected' : '' }}>No
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
                                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Enable
                                            </option>
                                            <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Disable
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
                                                    <th> Attribute Name</th>
                                                    <th>status</th>
                                                    <th></th>
                                                    <td><button type="button" id="addmore">+</button></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" name ="attribute_name[]">
                                                    </td>
                                                    <td>
                                                        <select name ="attribute_status[]">
                                                            <option value="" selected disabled>action</option>
                                                            <option value="1">Enable</option>
                                                            <option value="2">disable</option>
                                                        </select>
                                                    </td>
                                                    <td></td>
                                                    <td><button class ="remove" type = "button">X</button></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
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
        $(document).ready(function() {
            $("#addmore").click(function() {
                add_more = '<tr>\
                <td><input type="text" name ="attribute_name[]"></td>\
                <td>\
                    <select name ="attribute_status[]">\
                        <option value="">action</option>\
                        <option value="1">Enable</option>\
                        <option value="2">disable</option>\
                    </select>\
                </td>\
                <td></td><td><button class ="remove" type = "button">X</button></td>\
            </tr>'
                $('#add').append(add_more);
            });

            $("#add").delegate(".remove", "click", function() {

                $(this).closest("tr").remove()
            });

        });
    </script>
@endsection
