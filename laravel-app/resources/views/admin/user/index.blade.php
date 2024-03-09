@extends('layouts.admin')

@section('style')
<style>
    h1 {
        background-color: green;
    }
</style>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">User List</h1>
    </div>

    <div class="col-md-12">

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>User No.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><span class="label label-danger">Mark</span></td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td><span class="label label-info">100090</span></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        <td>100090</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Larry</td>
                        <td><span class="label label-danger">the Bird</span> </td>
                        <td>@twitter</td>
                        <td>100090</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><span class="label label-success">Mark</span></td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td><span class="label label-info">100090</span></td>
                    </tr>

                    <tr>
                        <td>5</td>
                        <td>Larry</td>
                        <td><span class="label label-primary">the Bird</span></td>
                        <td>@twitter</td>
                        <td>100090</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td><span class="label label-warning">Jacob</span></td>
                        <td><span class="label label-success">Thornton</span></td>
                        <td>@fat</td>
                        <td><span class="label label-danger">100090</span></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Larry</td>
                        <td><span class="label label-primary">the Bird</span></td>
                        <td>@twitter</td>
                        <td>100090</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td><span class="label label-warning">Jacob</span></td>
                        <td><span class="label label-success">Thornton</span></td>
                        <td>@fat</td>
                        <td><span class="label label-danger">100090</span></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td><span class="label label-success">Mark</span></td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td><span class="label label-info">100090</span></td>
                    </tr>
                </tbody>
            </table>
        </div>




    </div>
</div>



@endsection