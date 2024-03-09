@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            @can('coupon_create')
                <li><a href="{{ route('coupon.create') }}">>> Coupon create</a></li>
            @endcan
        </ol>
    </section>
    <div class="panel-body">
        <div class="table-responsive">
            @if (session()->has('success'))
                <div id="msg" class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <table class="table table-bordered  display" id="myTable">
                <thead>
                    <tr>
                        <th>SrNo.</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Coupon Code</th>
                        <th>Valid Form</th>
                        <th>Valid To</th>
                        <th>Discount Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @php
                    $i = 1;
                @endphp
                @forelse ($coupons as $_coupon)
                    <tr>
                        <td>{{ $i++ . '.' }}</td>
                        <td>{{ $_coupon->title }}</td>
                        <td>{{ $_coupon->status == '1' ? 'Enable' : 'Disable' }}</td>
                        <td>{{ $_coupon->coupon_code }}</td>
                        <td>{{ $_coupon->valid_from }}</td>
                        <td>{{ $_coupon->valid_to }}</td>
                        <td>{{ $_coupon->discount_amount }}</td>

                        {{-- <td>{{$_page->description}}</td> --}}
                        <td>
                            @can('coupon_edit')
                                <a href="{{ route('coupon.edit', $_coupon->id) }}"class="btn btn-primary"><i
                                        class="glyphicon glyphicon-edit"></i>Edit</a>
                            @endcan
                            @can('coupon_delete')
                                <form action="{{ route('coupon.destroy', $_coupon->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="delete" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this Data')"><i
                                            class="glyphicon glyphicon-trash"></i>DELETE</button>
                                </form>
                            @endcan
                        </td>



                    @empty
                    <tr>
                        <td colspan="5" align="center">No data found.</td>
                    </tr>
                @endforelse
                </tr>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
