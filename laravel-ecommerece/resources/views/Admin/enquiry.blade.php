@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Enquiry List</h1>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Enquiry List</h3>
                        @if (session()->has('success'))
                            <div class="callout callout-success" style="float:left;width:100%;margin-top:5px;">
                                {{ session()->get('success') }}</div>
                        @endif
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="myTable" class="table table-bordered display">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>phone</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @forelse($enquiry as $_enquiry)
                                    <tr>
                                        <td>{{ $i++ . '.' }}</td>
                                        <td>{{ $_enquiry->name }}</td>
                                        <td>{{ $_enquiry->email }}</td>
                                        <td>{{ $_enquiry->phone }}</td>
                                        <td>{{ $_enquiry->message }}</td>

                                        <td id="status_id{{ $_enquiry->id }}">
                                            @if ($_enquiry->status == 1)
                                                <button data-id="{{ $_enquiry->id }}"
                                                    class="btn btn-danger status_unred">Unread</button>
                                            @else
                                                <button class="btn btn-success">Read</button>
                                            @endif

                                        </td>
                                        <td>
                                                <form action="{{ route('enqry.destroy', $_enquiry->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-block btn-danger" onclick="return confirm('Are you sure you want to delete this Data')"><i
                                                            class="fa fa-trash"></i>Delete</button>
                                                </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" align="center">No data found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });
        </script>
        <script>
            $(document).ready(function() {
                $(".status_unred").click(function() {
                    enqId = $(this).attr('data-id');

                    $.ajax({
                        url: '{{ route('enqry.status') }}',
                        type: 'POST',
                        data: {
                            enqueryId: enqId,
                            "_token": "{{ csrf_token() }}"
                        },

                        success: function(resutl) {

                            $("#status_id" + enqId).html(resutl);

                        },
                        error: function(er) {
                            alert(er);
                        }
                    });
                });
            });
        </script>
    </section>
@endsection