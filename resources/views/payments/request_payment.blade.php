@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4>Request Payments</h4>
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
                                            <th>User Id</th>
                                            <th>Pay Amount</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($requestpayment as $key => $payment)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                @if(Auth::user()->id == $payment->from_id )
                                                <td>{{ $payment->to_id }}</td>
                                                @elseif(Auth::user()->id == $payment->to_id)
                                                <td>{{ $payment->from_id }}</td>
                                                @endif
                                                <td>{{ $payment->amount }}</td>
                                                <td>{{ $payment->req_date }} {{ $payment->req_time }}</td>
                                    @if(Auth::user()->id == $payment->from_id || $payment->status == "Approved")
                                    <td>{{ $payment->status }}</td>
                                    @elseif(Auth::user()->id == $payment->from_id || $payment->status == "Declined")
                                    <td>{{ $payment->status }}</td>
                                     @elseif(Auth::user()->id == $payment->from_id && $payment->status == "Pending")
                                    <td>{{ $payment->status }}</td>
                                    @elseif(Auth::user()->id == $payment->to_id)
                                                <td>
                                                    @if($payment->status == 'Pending')
                                                        <a class="btn btn-success btn-sm" href="#"
                                                            onclick="aproved('{{ $payment->id }}','{{ $payment->amount }}','{{ $payment->from_id }}','{{ $payment->image }}')">Approve</a>
                                                    @elseif($payment->status == 'Approved')
                                                        <h4 class="btn btn-success btn-sm">Approved</h4>
                                                    @elseif($payment->status == 'Declined')
                                                    <h4 class="btn btn-danger btn-sm">Declined</h4>
                                                    @endif
                                                    @endif
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
    <div class="modal fade" id="requestamount">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Approve Payment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('approvepayment') }}" method="post" class="form-horizontal" id="formABC">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input type="hidden" name="from_id" id="reqfromid">
                        <input type="hidden" name="row_id" id="reqid">
                        <center> <img src="" id="reqpaidimage" class="mb-3" style="opacity: .8; width:100%;">
                        </center>
                        <div class="form-group row">
                            <label for="amount" class="col-sm-4 col-form-label"><span style="color:red"></span>Amount
                                <span id="reqamounthidden"></span></label>
                            <div class="col-sm-8">
                                <input type="text" readonly name="amount" class="form-control" id="paymentamount" placeholder="Enter Amount"
                                    required="required">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input id="declinebtn" type="button" value="Decline" class="btn btn-danger">
                        <input type="submit" class="btn btn-primary" value="Add Payment" name="addamount"
                            id="requestamount" />
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('page_scripts')
    <script>
        function aproved(id, pay_amount, from_id, image) {
            $("#reqid").val(id);
            $("#reqamounthidden").html(pay_amount);
            $("#paymentamount").val(pay_amount);
            $("#reqfromid").val(from_id);
            $("#reqpaidimage").attr("src", 'upload/paid_image/' + image);
            $("#requestamount").modal("show");
            var decline = "{{ url('declinerequest_payment') }}";
            $('#declinebtn').click(function(e) {
                var r = confirm("Are you sure to Decline?");
                if (r == true) {
                    var url = decline + "/" + id;
                    window.location.href = url;
                }
            });
        }
    </script>
@endpush
