@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4>Account Statement</h4>
                </div>
                <div class="col-sm-6">
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
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Deposit</th>
                                            <th>Withdrawal</th>
                                            <th>Available Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($statements as $key => $state)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $state->from_id }}</td>
                                                <td>{{ $state->remarks }}</td>
                                                <td>{{ $state->new_balance }}</td>
                                                <td>{{ $state->pay_amount }}</td>
                                                <td>{{ $state->old_balance }}</td>
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
@endsection
@push('page_scripts')
    <script>
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
    </script>
@endpush
