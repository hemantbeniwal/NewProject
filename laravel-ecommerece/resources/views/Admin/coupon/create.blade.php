@extends('layouts.admin')
@section('content')
        <section class="content-header">
            <h1>
                <small>Coupon</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                @can('coupon_index')
                <li><a href="{{ route('coupon.index') }}">Coupon List</a></li>
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
                        <h3 class="box-title">Coupon Add</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('coupon.store') }}" method="post">
                        @csrf
                        <div class="box-body">
                                <div class="form-group">
                                    <label for="title">Title:</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                        {{ old('title') }}>
                                    @error('title')
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

                                <div class="form-group">
                                    <label for="coupon_code">Coupon Code:</label>
                                    <input type="text" name="coupon_code" id="coupon_code" class="form-control"
                                        {{ old('coupon_code') }}>
                                    @error('coupon_code')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="valid_from">Valid From:</label>
                                    <input type="datetime-local" name="valid_from" id="valid_from" class="form-control"
                                        {{ old('valid_from') }}>
                                    @error('valid_from')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="valid_to">Valid To:</label>
                                    <input type="datetime-local" name="valid_to" id="valid_to" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="discount_amount">Discount Amount:</label>
                                    <input type="number" step="0.01" name="discount_amount" id="discount_amount"
                                        class="form-control">
                                </div>

                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
