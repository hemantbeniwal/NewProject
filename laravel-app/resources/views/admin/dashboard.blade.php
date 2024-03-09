@extends('layouts.admin')

@section('style')
<style>
    h1 {
        background-color: yellow;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">DASHBOARD</h1>
        <h1 class="page-subhead-line">This is dummy text , you can replace it with your original text. </h1>

    </div>
</div>

<!--/.Row-->
<hr />
<div class="row">

    <div class="col-md-8">

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
    <div class="col-md-4">
        <div class="panel panel-success">
            <div class="panel-heading">
                Recent Comments Example
            </div>
            <div class="panel-body">
                <ul class="media-list">

                    <li class="media">

                        <div class="media-body">

                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-circle img-comments" src="assets/img/user.png" />
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Nulla gravida vitae  </h4>
                                    Donec sit amet ligula enim. Duis vel condimentum massa.

                                    <!-- Nested media object -->
                                    <div class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object img-circle img-comments" src="assets/img/user.gif" />
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">Amet ligula enim</h4>
                                            Donec sit amet ligula enim .
                                        </div>
                                    </div>
                                    <div class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object img-circle img-comments" src="assets/img/user.png" />
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">Donec t ligula enim</h4>
                                            Donec sit amet  amet ligula enim . 
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
<!--/.Row-->
<hr />
<div class="row" style="padding-bottom: 100px; `">
    <div class="col-md-6">
        <div id="comments-sec">
            <h4><strong>Compose Support Ticket </strong></h4>
            <hr />


            <div class="form-group  ">
                <label>Please Write a Subject Line</label>
                <input type="text" class="form-control" required="required" placeholder="Enter Subject Of Ticket" />
            </div>
            <div class="form-group ">
                <label>Please Enter Issue</label>
                <textarea class="form-control" rows="8"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Compose &amp; Send Ticket</button>
            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-black">
                <i class="fa fa-bicycle"></i>
            </span>
            <div class="text-box">
                <p class="main-text">52 Important Issues to Fix </p>
                <p>Please fix these issues to work smooth</p>
                <p>Time Left: 30 mins</p>
                <hr />
                <p>
                    <span class=" color-bottom-txt"><i class="fa fa-edit"></i>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit gthn. 
              Lorem ipsum dolor sit amet, consectetur adipiscing elit gthn. 
               Lorem ipsum dolor sit amet, consectetur adipiscing elit gthn.
             
                    </span>


                </p>
                <hr />
                Lorem ipsum dolor sit amet, consectetur adipiscing elit gthn. 
               Lorem ipsum dolor sit amet, consectetur adipiscing elit gthn.
            </div>
        </div>
    </div>
</div>
<!--/.ROW-->
@endsection
