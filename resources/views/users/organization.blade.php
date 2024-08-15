@extends('layouts.app')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4>Organization</h4>
                </div>
                <div class="col-sm-6">

@if(Auth::user()->user_type_id == 2 || Auth::user()->user_type_id == 3 || Auth::user()->user_type_id == 4 || Auth::user()->user_type_id == 5 || Auth::user()->user_type_id == 5 || Auth::user()->user_type_id == 6)
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><button type="button" class="btn btn-block btn-primary btn-sm"
                            data-toggle="modal" data-target="#addorg"><i class="fa fa-plus"> Add </i></button>
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
                                            <th>Org Type</th>
                                            <th>Organization</th>
                                            <th>User Name</th>
                                            <th>Phone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getorg as $key => $org)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $org->center_name }}</td>
                                                <td>{{ $org->org_name }}</td>
                                                <td>{{ $org->full_name }}</td>
                                                <td>{{ $org->phone }}</td>
                                                <td> <a onclick="return confirm('Do you want to perform delete operation?')" href="{{ url('/deleteorg' ,$org->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"title="Delete"></i></a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
    </section>

    <div class="modal fade" id="addorg">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Organization</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/saveorganization') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="org_type" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Org Type</label>
                                    <div class="col-sm-8">
                                        <select required="required" type="text" class="form-control" id="usertype_id" name="org_id"
                                            maxlength="50">
                                            @foreach ($getorgtype as $type)
                                                <option value="{{ $type->id }}">
                                                    {{ $type->org_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
								
                                <div class="form-group row">
                                    <label for="center_name" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Center Name</label>
                                    <div class="col-sm-8">
                                        <input required="required" type="text" class="form-control" name="center_name"
                                            maxlength="50" placeholder="Center Name">
                                    </div>
                                </div>
								
                                 <div class="form-group row">
                                    <label for="full_name" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>User Name</label>
                                    <div class="col-sm-8">
                                        <input required="required" type="text" class="form-control" name="full_name"
                                            maxlength="50" placeholder="Full Name">
                                    </div>
                                </div> 
								
                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Email</label>
                                    <div class="col-sm-8">
                                        <input onkeyup="duplicateemail(0)" required="required" type="text" class="form-control" name="email" maxlength="50" id="email" placeholder="Email">
                                            <span id="dupemail" style="color:red"></span>
                                    </div>
                                </div>
								<div class="form-group row">
                                    <label for="phone" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Phone</label>
                                    <div class="col-sm-8">
                                        <input onkeyup="duplicatephone(0)" id="phone" required="required" type="text" class="form-control number"
                                            name="phone" maxlength="10" placeholder="Phone Number">
                                            <span id="dupmobile" style="color:red"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
							<div class="form-group row">
                                    <label for="dist_id" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>District</label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2" name="dist_id" id="district"
                                            style="width: 100%;" >
                                            <option value="">District</option>
                                            @foreach ($getdistrict as $district)
                                                <option value="{{ $district->id }}">
                                                    {{ $district->district_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
								  <div class="form-group row">
                                    <label for="taluk_id" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Taluk</label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2" name="taluk_id" id="taluk"
                                            style="width: 100%;" required="required">
                                            <option value="">Taluk</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="panchayath_id" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Vao Area</label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2" name="panchayath_id" id="panchayath"
                                            style="width: 100%;" required="required">
                                            <option value="">Vao Area</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-4 col-form-label"><span
                                            style="color:red"></span>Address</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="address" placeholder="Address"
                                            rows="3" required="required" maxlength="250"></textarea>
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

        $('#usertype_id').on('change', function() {
            var org_type = this.value;
            $('#district').removeAttr('required');
            $('#taluk').removeAttr('required');
            $('#panchayath').removeAttr('required');
            if(org_type == 3 || org_type == 4 || org_type == 5){
                $("#district").attr("required", true);
            }
            if(org_type == 4 || org_type == 5){
                $("#taluk").attr("required", true);
            }
            if(org_type == 5){
                $("#panchayath").attr("required", true);
            }
            var url = "{{ url('/getparentorganization') }}/"+org_type;
            $("#parentorg").html('');
            $.ajax({
                url: url,
                type: "GET",
                dataType: 'json',
                success: function(result) {
                    $('#parentorg').html('<option value="">-- Select --</option>');
                    $.each(result, function(key, value) {
                        $("#parentorg").append('<option value="' + value
                            .id + '">' + value.org_name  + '</option>');
                    });
                }
            });
        });

        $('#district').on('change', function() {
            var district_id = this.value;
            var url = "{{ url('/gettaluk') }}/"+district_id;
            $("#taluk").html('');
            $.ajax({
                url: url,
                type: "GET",
                dataType: 'json',
                success: function(result) {
                    $('#taluk').html('<option value="">-- Select Taluk Name --</option>');
                    $.each(result, function(key, value) {
                        $("#taluk").append('<option value="' + value
                            .id + '">' + value.taluk_name + '</option>');
                    });
                    $('#panchayath').html('<option value="">-- Select Panchayath --</option>');
                }
            });
        });

        $('#taluk').on('change', function() {
            var taluk_id = this.value;
            $("#panchayath").html('');
            var url = "{{ url('/getpanchayath') }}/"+taluk_id;
            $.ajax({
                url: url,
                type: "GET",
                dataType: 'json',
                success: function(result) {
                    $('#panchayath').html('<option value="">-- Select Panchayath Name --</option>');
                    $.each(result, function(key, value) {
                        $("#panchayath").append('<option value="' + value
                            .id + '">' + value.panchayath_name + '</option>');
                    });
                }
            });
        });
    </script>
@endpush
