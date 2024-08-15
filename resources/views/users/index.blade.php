@extends('layouts.app')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4>Users Details</h4>
                </div>
                <div class="col-sm-6">
@if(Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2 || Auth::user()->user_type_id == 3)

                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><button type="button" class="btn btn-block btn-primary btn-sm"
                                data-toggle="modal" data-target="#adduser"><i class="fa fa-plus"> Add </i></button>
                        </li>
                    </ol>
@endif
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissable" style="margin: 15px;">
                                    <a href="#" style="color:white !important" class="close" data-dismiss="alert"
                                        aria-label="close">&times;</a>
                                    <strong> {{ session('success') }} </strong>
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-danger alert-dismissable" style="margin: 15px;">
                                    <a href="#" style="color:white !important" class="close" data-dismiss="alert"
                                        aria-label="close">&times;</a>
                                    <strong> {{ session('error') }} </strong>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S No</th>
                                            <th>Full Name</th>
                                            <th>Designation</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Phone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($viewusers as $key => $user)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $user->full_name }}</td>
                                                <td>{{ $user->user_type_name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->cpassword }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>
                                                    <a onclick="edit_usertype('{{ $user->usersID }}','{{ $user->full_name }}','{{ $user->aadhaar_no }}','{{ $user->pan_no }}','{{ $user->phone }}','{{ $user->user_type_id }}','{{ $user->email }}','{{ $user->pincode }}','{{ $user->address }}')"class="btn btn-info btn-sm"><i
                                                            class="fa fa-eye">Edit</i></a>
                                                    <a onclick="return confirm('Do you want to perform delete operation?')" href="{{ url('/deleteuser' ,$user->usersID) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"title="Delete"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="adduser">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add User Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/saveuser') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group row">
                                    <label for="full_name" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Staff Name</label>
                                    <div class="col-sm-8">
                                        <input required="required" type="text" class="form-control" name="full_name"
                                            maxlength="30" placeholder="Full Name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="aadhaar_no" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Aadhar No</label>
                                    <div class="col-sm-8">
                                        <input required="required" type="text" class="form-control number"
                                            name="aadhaar_no" maxlength="12" placeholder="Aadhar No">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="aadharfile" class="col-sm-4 col-form-label"><span style="color:red"></span>Aadhaar Img</label>
                                    <div class="col-sm-8">
                                        <input required="required" type="file" class="form-control" name="aadharfile">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pan_no" class="col-sm-4 col-form-label"><span style="color:red"></span>Pan
                                        Card No</label>
                                    <div class="col-sm-8">
                                        <input required="required" type="text" class="form-control" name="pan_no"
                                            maxlength="10" placeholder="Pan No">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="profile" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Profile Img</label>
                                    <div class="col-sm-8">
                                        <input required="required" type="file" class="form-control" name="profile"
                                            maxlength="6">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Phone</label>
                                    <div class="col-sm-8">
                                        <input required="required" type="text" class="form-control number"
                                            name="phone" maxlength="10" placeholder="Phone Number">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="user_type_id" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Designation</label>
                                    <div class="col-sm-8">
                                        <select required="required" type="text" class="form-control"
                                            name="user_type_id" maxlength="50" placeholder="Designation">
                                            <option>Select</option>
                                            @foreach ($usertypes as $desgin)
                                                <option value="{{ $desgin->id }}">
                                                    {{ $desgin->user_type_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Email</label>
                                    <div class="col-sm-8">
                                        <input required="required" type="text" class="form-control" name="email"
                                            maxlength="30" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Password</label>
                                    <div class="col-sm-8">
                                        <input required="required" type="text" class="form-control" name="password"
                                            maxlength="20" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pincode" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Pin Code</label>
                                    <div class="col-sm-8">
                                        <input required="required" type="text" class="form-control number"
                                            name="pincode" maxlength="6" placeholder="Pin Code">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Address</label>
                                    <div class="col-sm-8">
                                        <textarea required="required" type="file" class="form-control" name="address" maxlength="200" rows="3"
                                            placeholder="Address"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input class="btn btn-primary" type="submit" value="Submit" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editusers">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update User Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/updateuser') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                        <input type="hidden" name="userid" id="row_id" >
                                <div class="form-group row">
                                    <label for="full_name" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Staff Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="full_name" id="editname"
                                            maxlength="30" placeholder="Full Name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="aadhaar_no" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Aadhar No</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control number" id="editaadhar"
                                            name="aadhaar_no" maxlength="12" placeholder="Aadhar No">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="aadharfile" class="col-sm-4 col-form-label"><span style="color:red"></span>Aadhaar Img</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control" name="aadharfile">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pan_no" class="col-sm-4 col-form-label"><span style="color:red"></span>Pan
                                        Card No</label>
                                    <div class="col-sm-8">
                                        <input id="editpan" type="text" class="form-control" name="pan_no"
                                            maxlength="10" placeholder="Pan No">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="profile" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Profile Img</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control" name="profile">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Phone</label>
                                    <div class="col-sm-8">
                                        <input id="editphone" type="text" class="form-control number"
                                            name="phone" maxlength="10" placeholder="Phone Number">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="user_type_id" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Designation</label>
                                    <div class="col-sm-8">
                                        <select required="required" type="text" class="form-control"
                                            name="user_type_id" maxlength="50" id="editusertype" placeholder="Designation">
                                            <option>Select</option>
                                            @foreach ($usertypes as $desgin)
                                                <option value="{{ $desgin->id }}">
                                                    {{ $desgin->user_type_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Email</label>
                                    <div class="col-sm-8">
                                        <input id="editemail" type="text" class="form-control" name="email"
                                            maxlength="30" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pincode" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Pin Code</label>
                                    <div class="col-sm-8">
                                        <input id="editpin" type="text" class="form-control number"
                                            name="pincode" maxlength="6" placeholder="Pin Code">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Address</label>
                                    <div class="col-sm-8">
                                        <textarea id="editaddress" type="file" class="form-control" name="address" maxlength="200" rows="3"
                                            placeholder="Address"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input class="btn btn-primary" type="submit" value="Submit" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('page_scripts')
    <script>
        function edit_usertype(id, full_name, aadhaar_no, pan_no, phone, user_type_id , email, pincode, address) {
            $("#row_id").val(id);
            $("#editname").val(full_name);
            $("#editaadhar").val(aadhaar_no);
            $("#editpan").val(pan_no);
            $("#editphone").val(phone);
            $("#editusertype").val(user_type_id);
            $("#editemail").val(email);
            $("#editpin").val(pincode);
            $("#editaddress").val(address);
            $("#editusers").modal("show");
        }
    </script>
@endpush
