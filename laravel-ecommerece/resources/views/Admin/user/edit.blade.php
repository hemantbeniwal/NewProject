@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            User Edit
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            @can('user_index')
                <li><a href="{{ route('user.index') }}">User List</a></li>
            @endcan
        </ol>
    </section>
    <div class="panel-body">
        <form role="form" action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Enter Name</label>
                <input class="form-control" type="text" name="name" value="{{ $user->name }}">
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Enter Email</label>
                <input class="form-control" type="email" name="email" value="{{ $user->email }}">
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Enter Password</label>
                <input class="form-control" type="password" name="password">
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Enter Confrm Password</label>
                <input class="form-control" type="password" name="confirm_password">
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div>
                @foreach ($role as $_role)
                    <div class="checkbox">
                        <input type="checkbox" name="roles[]"
                            value="{{ $_role->name }}"{{ in_array($_role->name, $roleData) ? 'checked' : '' }}>{{ $_role->name }}
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-info">Update </button>

        </form>
    </div>
@endsection
