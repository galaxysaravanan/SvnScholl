@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Students Details</h1>
                </div>
                <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><button type="button" class="btn btn-block btn-primary btn-sm"
                                    data-toggle="modal" data-target="#addstudents"><i class="fa fa-plus"> Add </i></button>
                            </li>
                        </ol>
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
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Aadharr No</th>
                                                <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($viewstudents as $key => $students)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                    <td>{{ $students->full_name }}</td>
                                                    <td>{{ $students->phone }}</td>
                                                    <td>{{ $students->email }}</td>
                                                    <td>{{ $students->aadhaar_no }}</td>
                                                <td>
                                                    <a onclick="edit_students('{{ $students->id }}','{{ $students->full_name }}','{{ $students->email }}','{{ $students->caste }}','{{ $students->religion }}','{{ $students->phone }}','{{ $students->aadhaar_no }}','{{ $students->pin_code }}','{{ $students->address }}','{{ $students->father_name }}','{{ $students->mother_name }}','{{ $students->father_occupation }}','{{ $students->mother_occupation }}','{{ $students->father_mobile }}')"
                                                        href="#" class="btn btn-sm btn-primary"><i
                                                            class="fa fa-edit"></i>Edit</a>

                                                    <a onclick="return confirm('Do you want to perform delete operation?')" href="{{ url('/deletestudent' ,$students->studentsID) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"title="Delete"></i></a>
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
    <div class="modal fade" id="addstudents">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4><i class="modal-title">Add students</i></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ url('/savestudents') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#basic" data-toggle="tab">Basic Details</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#comunication" data-toggle="tab">Family Details</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="basic">
                                        <div class="form-group row">
                                            <label for="full_name" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Student Name</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text" class="form-control"
                                                    name="full_name" maxlength="30" placeholder="Full Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Email</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text" class="form-control"
                                                    name="email" maxlength="30" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="caste" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Caste</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text" class="form-control"
                                                    name="caste" maxlength="10" placeholder="Caste">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="religion" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Religion</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text" class="form-control"
                                                    name="religion" maxlength="10" placeholder="Religion">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="phone" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Mobile</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text" class="form-control number"
                                                    name="phone" maxlength="10" placeholder="Mobile Number">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="aadhaar_no" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Aadhaar No</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text" class="form-control number"
                                                    name="aadhaar_no" maxlength="12" placeholder="Aadhaar No">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="pin_code" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>PinCode</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text" class="form-control"
                                                    name="pin_code" maxlength="6" placeholder="PinCode">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="aadhaar_file" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Aadhaar</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="file" class="form-control"
                                                    name="aadhaar_file" maxlength="30" placeholder="Aadhaar Front">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="photo" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Profile Image</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="file" class="form-control"
                                                    name="photo" maxlength="30" placeholder="Profile Image">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="address" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Address</label>
                                            <div class="col-sm-8">
                                                <textarea required="required" type="file" class="form-control" name="address" maxlength="200" rows="2"
                                                    placeholder="Address"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="comunication">
                                        <div class="form-group row">
                                            <label for="father_name" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Father Name</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text" class="form-control"
                                                    name="father_name" maxlength="30" placeholder="Father Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="father_mobile" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Mobile No</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text" class="form-control"
                                                    name="father_mobile" maxlength="10" placeholder="Father Mobile No">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="father_occupation" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Father Occupation</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text" class="form-control"
                                                    name="father_occupation" maxlength="30" placeholder="Father Occupat">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="mother_name" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Mother Name</label>
                                            <div class="col-sm-8">
                                                <input required="required" maxlength="30" type="text" class="form-control"
                                                    name="mother_name" placeholder="Mother Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="mother_occupation" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Mother Occupation</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text" class="form-control"
                                                    name="mother_occupation" maxlength="30"
                                                    placeholder="Mother Occupation">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="father_aadhaar" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Father Aadhaar</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="file" class="form-control"
                                                    name="father_aadhaar">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="mother_aadhaar" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Mother Aadhaar</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="file" class="form-control"
                                                    name="mother_aadhaar">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="smart_card" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Smart Card</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="file" class="form-control"
                                                    name="smart_card">
                                            </div>
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
    </div>

    <div class="modal fade" id="editstudents">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4><i class="modal-title">Update students</i></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ url('/updatestudents') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#editbasic" data-toggle="tab">Basic Details</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#editcomunication" data-toggle="tab">Family Details</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="editbasic">
                                        <div class="form-group row">
                                            <label for="full_name" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Student Name</label>
                                            <div class="col-sm-8">
                                                <input id="editname" type="text" class="form-control"
                                                    name="full_name" maxlength="30" placeholder="Full Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Email</label>
                                            <div class="col-sm-8">
                                                <input id="editemal" type="text" class="form-control"
                                                    name="email" maxlength="30" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="caste" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Caste</label>
                                            <div class="col-sm-8">
                                                <input id="editcaste" type="text" class="form-control"
                                                    name="caste" maxlength="10" placeholder="Caste">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="religion" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Religion</label>
                                            <div class="col-sm-8">
                                                <input id="editreligion" type="text" class="form-control"
                                                    name="religion" maxlength="10" placeholder="Religion">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="phone" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Mobile</label>
                                            <div class="col-sm-8">
                                                <input id="editphone" type="text" class="form-control number"
                                                    name="phone" maxlength="10" placeholder="Mobile Number">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="aadhaar_no" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Aadhaar No</label>
                                            <div class="col-sm-8">
                                                <input id="editaadhaar" type="text" class="form-control number"
                                                    name="aadhaar_no" maxlength="12" placeholder="Aadhaar No">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="pin_code" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>PinCode</label>
                                            <div class="col-sm-8">
                                                <input id="editpin" type="text" class="form-control"
                                                    name="pin_code" maxlength="6" placeholder="PinCode">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="aadhar_file" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Aadhaar</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control"
                                                    name="aadhar_file" maxlength="30" placeholder="Aadhaar Front">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="photo" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Profile Image</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control"
                                                    name="photo" maxlength="30" placeholder="Profile Image">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="address" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Address</label>
                                            <div class="col-sm-8">
                                                <textarea id="editaddress" type="file" class="form-control" name="address" maxlength="200" rows="2"
                                                    placeholder="Address"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="editcomunication">
                                        <div class="form-group row">
                                            <label for="father_name" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Father Name</label>
                                            <div class="col-sm-8">
                                                <input id="editfathername" type="text" class="form-control"
                                                    name="father_name" maxlength="30" placeholder="Father Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="father_mobile" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>FatherMobile No</label>
                                            <div class="col-sm-8">
                                                <input id="editfamobile" type="text" class="form-control"
                                                    name="father_mobile" maxlength="30" placeholder="Father Mobile No">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="father_occupation" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Father Occupation</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control"
                                                    name="father_occupation" id="editfather" maxlength="30" placeholder="Father Occupat">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="mother_name" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Mother Name</label>
                                            <div class="col-sm-8">
                                                <input maxlength="30" type="text" class="form-control" id="editmothername"
                                                    name="mother_name" placeholder="Mother Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="mother_occupation" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Mother Occupation</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control"
                                                    name="mother_occupation" id="editmother" maxlength="30"
                                                    placeholder="Mother Occupation">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="father_aadhaar" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Father Aadhaar</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control"
                                                    name="father_aadhaar">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="mother_aadhaar" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Mother Aadhaar</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control"
                                                    name="mother_aadhaar">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="smart_card" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Smart Card</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control"
                                                    name="smart_card">
                                            </div>
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
        function edit_students(id, full_name, email, caste, religion, phone,
        aadhaar_no, pin_code, address, father_name, mother_name, father_occupation, mother_occupation, father_mobile) {
            $("#students_id").val(id);
            $("#editname").val(full_name);
            $("#editemail").val(email);
            $("#editcaste").val(caste);
            $("#editreligion").val(religion);
            $("#editphone").val(phone);
            $("#editaadhaar").val(aadhaar_no);
            $("#editpin").val(pin_code);
            $("#editaddress").val(address);
            $("#editfathername").val(father_name);
            $("#editmothername").val(mother_name);
            $("#editfather").val(father_occupation);
            $("#editmother").val(mother_occupation);
            $("#editfamobile").val(father_mobile);
            $("#editstudents").modal("show");
        }

    </script>
@endpush
