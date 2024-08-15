@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4>{{ $customer->full_name }} Account Details</h4>
                </div>
                <div class="col-sm-6">

                    {{-- @if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 5 || Auth::user()->user_type_id == 6 || Auth::user()->user_type_id == 7 || Auth::user()->user_type_id == 8) --}}
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><button type="button" class="btn btn-block btn-primary btn-sm"
                                data-toggle="modal" data-target="#addcustomer"><i class="fa fa-plus"> Add </i></button>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-5 col-sm-2">
                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                        aria-orientation="vertical">
                        @foreach ($accounttype as $accounttypelist)
                            <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home"
                                role="tab" aria-controls="vert-tabs-home"
                                aria-selected="true">{{ $accounttypelist->name }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="col-7 col-sm-10">
                    <div class="tab-content" id="vert-tabs-tabContent">
                        <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel"
                            aria-labelledby="vert-tabs-home-tab">
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S No</th>
                                            <th>Name</th>

                                            <th>User Type</th>
                                            <th>Mobile</th>

                                            <th>NonStake</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>ssssssss</td>
                                            <td>ssssssss</td>
                                            <td>ssssssss</td>
                                            <td>ssssssss</td>
                                            <td>ssssssss</td>
                                            <td>ssssssss</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel"
                            aria-labelledby="vert-tabs-profile-tab">
                            Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut
                            ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                            Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus
                            ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc
                            euismod pellentesque diam.
                        </div>
                        <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel"
                            aria-labelledby="vert-tabs-messages-tab">
                            Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue
                            id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac
                            tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit
                            condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus
                            tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet
                            sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum
                            gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend
                            ac ornare magna.
                        </div>
                        <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel"
                            aria-labelledby="vert-tabs-settings-tab">
                            Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis
                            ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate.
                            Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec
                            interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at
                            consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst.
                            Praesent imperdiet accumsan ex sit amet facilisis.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>


        </div>
    </section>
@endsection
@push('page_scripts')
    <script>
        function edit_users(id, full_name, phone, email, aadhaar_no, pan_no, dist_id, taluk_id, panchayath_id, pincode,
            address, nominee_name, nominee_phone, nomine_dob, nomine_aadhaar_no, status) {
            $("#customer_id").val(id);
            $("#editname").val(full_name);
            $("#editphone").val(phone);
            $("#editemail").val(email);
            $("#editaadhar").val(aadhaar_no);
            $("#editpan").val(pan_no);
            $("#editdist").val(dist_id);
            $("#edittaluk").val(taluk_id);
            $("#editpanchayath").val(panchayath_id);
            $("#editpin").val(pincode);
            $("#editaddress").val(address);
            $("#editnomname").val(nominee_name);
            $("#editnomphone").val(nominee_phone);
            $("#editnomdob").val(nomine_dob);
            $("#editnomaadhar").val(nomine_aadhaar_no);
            $("#editstatus").val(status);
            $("#editcustomers").modal("show");
        }

        function edit_usertype(id, dashboard) {
            $('#dashboard').prop('checked', false);
            $("#row_id").val(id);
            if (dashboard == 1) {
                $('#dashboard').prop('checked', true);
            }

            $("#editpermission").modal("show");
        }

        $('#district').on('change', function() {
            var district_id = this.value;
            var url = "{{ url('/gettaluk') }}/" + district_id;
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
            var url = "{{ url('/getpanchayath') }}/" + taluk_id;
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

        //edit
        $('#districts').on('change', function() {
            var district_id = this.value;
            var url = "{{ url('/gettaluk') }}/" + district_id;
            $("#taluks").html('');
            $.ajax({
                url: url,
                type: "GET",
                dataType: 'json',
                success: function(result) {
                    $('#taluks').html('<option value="">-- Select Taluk Name --</option>');
                    $.each(result, function(key, value) {
                        $("#taluks").append('<option value="' + value
                            .id + '">' + value.taluk_name + '</option>');
                    });
                    $('#panchayaths').html('<option value="">-- Select Panchayath --</option>');
                }
            });
        });

        $('#taluks').on('change', function() {
            var taluk_id = this.value;
            $("#panchayaths").html('');
            var url = "{{ url('/getpanchayath') }}/" + taluk_id;
            $.ajax({
                url: url,
                type: "GET",
                dataType: 'json',
                success: function(result) {
                    $('#panchayaths').html('<option value="">-- Select Panchayath Name --</option>');
                    $.each(result, function(key, value) {
                        $("#panchayaths").append('<option value="' + value
                            .id + '">' + value.panchayath_name + '</option>');
                    });
                }
            });
        });
    </script>
@endpush
