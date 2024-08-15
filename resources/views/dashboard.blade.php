@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-info">
                <span class="info-box-icon"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Amount</span>
                    <span style="cursor:pointer;" class="info-box-number" data-toggle="modal"
                        @if(Auth::user()->user_type_id == 1)data-target="#modal-addpayment" @else data-target="#modal-default" @endif>{{ Auth::user()->wallet }}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>

                    <span class="progress-description">
                        70% Increase in 30 Days
                    </span>
                </div>

            </div>

        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
                <span class="info-box-icon"><i class="fas fa-user-friends"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Students</span>
                    <span class="info-box-number">{{ $Customers }}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                        70% Increase in 30 Days
                    </span>
                </div>

            </div>

        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-warning">
                <span class="info-box-icon"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Organization</span>
                    <span class="info-box-number"></span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                        70% Increase in 30 Days
                    </span>
                </div>

            </div>

        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-danger">
                <span class="info-box-icon"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">User</span>
                    <span class="info-box-number">{{ $Users }}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                        70% Increase in 30 Days
                    </span>
                </div>

            </div>

        </div>

    </div>

            <div class="row">
                @if(Auth::user()->user_type_id == 1)
            <div class="col-12 col-sm-6 col-md-3">
                 <div class="info-box">
                   <a href="{{ url('/requestpayment') }}"  class="info-box-icon bg-warning elevation-1"><i class="fa fa-credit-card"></i></a>
                    <div class="info-box-content">
                        <span class="info-box-number">
                           Payment Request
                        </span>
                        <span class="info-box-number"></span>

                    </div>
                </div>
            </div>
            @endif
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                   <a href="{{ url('/accounts') }}"  class="info-box-icon bg-olive elevation-1"><i class="fa fa-address-book"></i></a>
                    <div class="info-box-content">
                        <span class="info-box-number">
                           Accounts
                            <small><a href="{{ url('/accounts') }}"
                                    class="small-box-footer float-sm-right"><i class="fas fa-arrow-circle-right"></i></a>
                            </small>
                        </span>
                    </div>
                </div>
            </div>


            </div>
        </div>

 <!--   <div class="row">
        @foreach ($accounttype as $key => $taskstyps)
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon {{ $taskstyps['color'] }} elevation-1"><i class="fas fa-heart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ $taskstyps['account_type_name'] }}</span>
                        <span class="info-box-number">
                            {{ $taskstyps['accountcount'] }}

                            <small><a onclick="accounttype('{{ $taskstyps['account_type_id'] }}')"
                                    class="small-box-footer float-sm-right"><i class="fas fa-arrow-circle-right"></i></a>

                            </small>
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

-->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Amount Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/addtopup') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="modal-body">
                        <center>
                            <img src="{{ asset('/upload/pan_image/upi.jpg') }}" width="400" height="500"
                                class="brand-image">
                            <h2></h2>
                        </center>
                        <div class="form-group row">
                            <label for="old_balance" class="col-sm-3 col-form-label"><span style="color:red"></span>Our
                                Balance</label>
                            <div class="col-sm-8">
                                <input required="required" type="text" class="form-control"
                                    value="{{ Auth::user()->wallet }}" name="old_balance" maxlength="10"
                                    placeholder="Our Balance" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pay_amount" class="col-sm-3 col-form-label"><span style="color:red"></span>Pay
                                Amount</label>
                            <div class="col-sm-8">
                                <input required="required" type="text" class="form-control" name="pay_amount"
                                    maxlength="10" placeholder="Pay Amount">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-sm-3 col-form-label"><span
                                    style="color:red"></span>Image</label>
                            <div class="col-sm-8">
                                <input required="required" type="file" class="form-control" name="image">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input class="btn btn-primary" type="submit" value="Submit" />
                    </form>
                    </div>
            </div>

        </div>
    </div>

      <div class="modal fade" id="modal-addpayment">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Funds</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/addfunds') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="old_balance" class="col-sm-3 col-form-label"><span style="color:red"></span>Balance</label>
                            <div class="col-sm-8">
                                <input required="required" type="text" class="form-control"
                                    value="{{ Auth::user()->wallet }}" name="old_balance" maxlength="10"
                                    placeholder="Our Balance" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pay_amount" class="col-sm-3 col-form-label"><span style="color:red"></span>Add Funds</label>
                            <div class="col-sm-8">
                                <input required="required" type="text" class="form-control" name="pay_amount"
                                    maxlength="10" placeholder="Pay Amount">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input class="btn btn-primary" type="submit" value="Submit" />

                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="modal fade" id="addaccounttype">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Find Account</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ url('/addtopup') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="text" id="acount" class="form-control" name="account_no"
                                    maxlength="13" placeholder="Enter Account Number">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="full_name" class="col-sm-5 col-form-label"><span style="color:red"></span></label>
                            <div class="col-sm-8">
                                <span style="color: green" id="acname" class="col-form-label"></span>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <a id="showbtn" href="{{ url('/useraccount/{id}') }}" class="btn btn-sm btn-primary" style="display:none">Next</a>
                        </div>
                    </div>

            </div>
        </div>
    </div>

@endsection
