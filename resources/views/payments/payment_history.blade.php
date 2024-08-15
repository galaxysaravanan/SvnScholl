@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4>Payment History Details</h4>
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
                                                <th>To User ID</th>
                                                <th>Transaction ID</th>
                                                <th>Amount</th>
                                                <th>Date Time</th>
                                                <th>Remarks</th>
                                                <th>Transaction Type</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($paymenthistory as $key => $paymenthistorys)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                     <td>{{ $paymenthistorys->to_id }}</td>
                                                    <td>{{ $paymenthistorys->transaction_id }}</td>
                                                    <td>{{ $paymenthistorys->pay_amount }}</td>
                                                    <td>{{ $paymenthistorys->payment_date }} {{ $paymenthistorys->payment_time }}</td>
                                                   
                                                    <td>{{ $paymenthistorys->remarks }}</td>
                                                    @if($paymenthistorys->transaction_type == 1)
                                                    <td style="color:green">Credit</td>
                                                    @else
                                                     <td style="color:red">Debit</td>
                                                    @endif
                                                   

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
 
@endpush
