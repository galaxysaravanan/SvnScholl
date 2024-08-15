@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Update My Profile</h1>
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
                            <form action="{{ url('/updateusers') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $editusers->id }}" name="user_id" />
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="organization" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Org Type</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="organization" style="width: 100%;"
                                                    required="required">
                                                    <option value="">Select</option>
                                                    @foreach ($org as $g)
                                                        <option {{ $editusers->org_id == $g->id ? 'selected' : '' }} value="{{ $g->id }}">
                                                            {{ $g->org_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="branch_name" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Branch Name</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text"
                                                    value="{{ $editusers->branch_name }}" class="form-control"
                                                    name="branch_name" maxlength="30" placeholder="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="aadhaar_no" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Aadhar No</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text"
                                                    value="{{ $editusers->aadhaar_no }}" class="form-control number"
                                                    name="aadhaar_no" maxlength="12" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="aadharfile" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Aadhaar Front</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="file"
                                                    value="{{ $editusers->aadharfile }}" class="form-control"
                                                    name="aadharfile">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="pan_no" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Pan
                                                Card No</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text" value="{{ $editusers->pan_no }}"
                                                    class="form-control" name="pan_no" maxlength="10" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="transaction_code" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>TransactionCode</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text"
                                                    value="{{ $editusers->transaction_code }}" class="form-control"
                                                    name="transaction_code" maxlength="30" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="caution_deposit_amount" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>CDA</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text"
                                                    value="{{ $editusers->caution_deposit_amount }}" class="form-control"
                                                    name="caution_deposit_amount" maxlength="6" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="photo" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Profile Img</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="file" class="form-control"
                                                    name="photo" maxlength="6">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="user_type_id" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Designation</label>
                                            <div class="col-sm-8">
                                                <select required="required" type="text" class="form-control"
                                                    name="user_type_id" maxlength="50" placeholder="">
                                                    <option>Select</option>
                                                    @foreach ($usertypes as $desgin)
                                                        <option {{ $editusers->user_type_id == $desgin->id ? 'selected' : '' }}
                                                            value="{{ $desgin->id }}">
                                                            {{ $desgin->user_type_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Name</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text"
                                                    value="{{ $editusers->full_name }}" class="form-control"
                                                    name="full_name" maxlength="30" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Email</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text"
                                                    value="{{ $editusers->email }}" class="form-control" name="email"
                                                    maxlength="30" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="aadharback" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Aadhaar Back</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="aadharback"
                                                    value="{{ $editusers->aadharback }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="panfile" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Pan Img</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="file"
                                                    value="{{ $editusers->panfile }}" class="form-control"
                                                    name="panfile">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="pincode" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Pin Code</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text"
                                                    value="{{ $editusers->pincode }}" class="form-control number"
                                                    name="pincode" maxlength="6" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="caution_image" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>CDA Image</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="file"
                                                    value="{{ $editusers->caution_image }}" class="form-control"
                                                    name="caution_image">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="phone" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Phone</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text"
                                                    value="{{ $editusers->phone }}" class="form-control number"
                                                    name="phone" maxlength="10" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="address" class="col-sm-4 col-form-label"><span
                                                    style="color:red"></span>Address</label>
                                            <div class="col-sm-8">
                                                <textarea required="required" type="file" class="form-control" name="address" placeholder="Address"
                                                    maxlength="200" rows="3">{{ $editusers->address }}
                                        </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <input class="btn btn-primary" type="submit" value="Submit" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('page_scripts')
    <script>
        $(document).ready(function() {
            populate_taluk(dist_id);
            populate_panchayath(ta_id);
        });

        function populate_taluk(district_id) {
            $("#taluk").html('');
            $.ajax({
                url: "{{ url('/gettaluk') }}",
                type: "POST",
                data: {
                    district_id: district_id,
                    _token: '{{ csrf_token() }}'
                },
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
        }

        $('#district').on('change', function() {
            var district_id = this.value;
            populate_taluk(district_id);
        });

        function populate_panchayath(taluk_id) {
            $("#panchayath").html('');
            $.ajax({
                url: "{{ url('/getpanchayath') }}",
                type: "POST",
                data: {
                    taluk_id: taluk_id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#panchayath').html('<option value="">-- Select Panchayath Name --</option>');
                    $.each(result, function(key, value) {
                        $("#panchayath").append('<option value="' + value
                            .id + '">' + value.panchayath_name + '</option>');
                    });
                }
            });
        }

        $('#taluk').on('change', function() {
            var taluk_id = this.value;
            populate_panchayath(taluk_id);
        });
    </script>
@endpush
