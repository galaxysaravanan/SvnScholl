@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h4>Users Details</h4>
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
                        <div class="row">
                            <div class="col-4"> 
                                <button type="button" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#Deposit">Deposit</button>
                           </div>
                            <div class="col-4">
                                <button type="button" class="btn btn-block btn-success btn-sm" data-toggle="modal" data-target="#Withdraw">Withdraw</button>
</div>
                            <div class="col-4">
                                <button type="button" class="btn btn-block btn-danger btn-sm" data-toggle="modal" data-target="#LoanRepayment">Loan Repayment</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<div class="modal fade" id="Deposit">
         <form onsubmit="return validatedeposit()" method="post" action="{{ url('savedeposit') }}" id="form1">
            @csrf
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Deposit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label>Account Number</label>
                        <input type="text" id="depositaccount" class="form-control" name="account_no" maxlength="13" placeholder="Enter Account Number" required>
                        <label id="acname"></label>
                        <input type="hidden" id="customerid" name="customerid">
                        <input type="hidden" id="wallet" name="wallet">
                    </div>
                </div>
                <div class="form-group">
                    <label>Minimal</label>
                    <select class="form-control select2bs4" name="payment_type" id="payment_type" style="width: 100%;" required="required">
                        <option value="" >Select Mode of Pay Name</option>
                        @foreach($modeofpay as $modeofpaylist)
                        <option value="{{ $modeofpaylist->id }}" >{{ $modeofpaylist->mode_of_pay_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label>Amount</label>
                        <input type="text" id="amount" class="form-control" name="amount" maxlength="8" placeholder="Enter Amount" required>
                        <p style="color: red;" id="amountstatus"></p>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label>Transaction Pin</label>
                        <input type="text" class="form-control" id="transaction_pin" name="transaction_pin" maxlength="8" placeholder="Enter Transaction Pin" required >
                        <p style="color: red;" id="transactionstatus"></p>

                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
        </form>
</div>
<div class="modal fade" id="Withdraw">
    <form onsubmit="return validatewithdrawal()" method="post" action="{{ url('savewithdrawal') }}" id="form1">
            @csrf
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Withdrawal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label>Account Number</label>
                        <input type="text" id="withdrawalaccount" class="form-control" name="account_no" maxlength="13" placeholder="Enter Account Number" required>
                        <label id="withdrawalacname"></label>
                        <input type="hidden" id="withdrawalcustomerid" name="customerid">
                       
                    </div>
                </div>
                <div class="form-group">
                    <label>Minimal</label>
                    <select class="form-control select2bs4" name="payment_type" id="payment_type" style="width: 100%;" required="required">
                        <option value="" >Select Mode of Pay Name</option>
                        @foreach($modeofpay as $modeofpaylist)
                        <option value="{{ $modeofpaylist->id }}" >{{ $modeofpaylist->mode_of_pay_name }}</option>
                        @endforeach
                    </select>
                </div>
                 <div class="form-group row" id="customerbalance" style="display:none;">
                    <div class="col-sm-12">
                        <label>Balance</label>
                        <input type="text" id="withdrawalwallet" class="form-control" name="wallet" readonly maxlength="8" placeholder="Enter Amount" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label>Amount</label>
                        <input type="text" id="withdrawalamount" class="form-control" name="amount" maxlength="8" placeholder="Enter Amount" required>
                        <p style="color: red;" id="withdrawalamountstatus"></p>

                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <label>Transaction Pin</label>
                        <input type="text" class="form-control" id="withdrawaltransaction_pin" name="transaction_pin" maxlength="13" placeholder="Enter Transaction Pin" required>
                        <p style="color: red;" id="withdrawaltransactionstatus"></p>

                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
        </form>
</div>
<div class="modal fade" id="LoanRepayment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Loan Repayment</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('page_scripts')
<script>

var userbalance = "{{ Auth::user()->wallet }}";
var usertransaction_code = "{{ Auth::user()->transaction_code }}";
function validatedeposit(){
    var balance = parseFloat(userbalance);
    var amount = $("#amount").val().trim();
    var transcode = $("#transaction_pin").val().trim();
    if(balance == ""){
        alert("Please Check Your Funds");
        return false;
    }
    if(usertransaction_code == ""){
        alert("Please Check Your Transaction Code");
        return false;
    }
    if(amount > balance){
        $("#amountstatus").html("Insufficient Funds.")
        return false;
    }
    if(transcode != usertransaction_code){
         $("#transactionstatus").html("Wrong Transaction Code");
        return false;
    }

    }

    function validatewithdrawal(){
    $("#withdrawalamountstatus").html("");
    $("#withdrawaltransactionstatus").html("");
    var amount = $("#withdrawalamount").val().trim();
    var cusbalance = $("#withdrawalwallet").val().trim();
    cusbalance = parseFloat(cusbalance);
    var transcode = $("#withdrawaltransaction_pin").val().trim();
    if(usertransaction_code == ""){
        alert("Please Check Your Transaction Code");
        return false;
    }
    if(cusbalance == 0){
        alert("NO Balance In Account.Please Deposit");
        return false;
    }
    if(amount < 100){
         alert("Please Enter The Amount Greater Than 100");
        return false;
    }
    if(amount > cusbalance){
        $("#withdrawalamountstatus").html("Insufficient Funds.")
        return false;
    }
    if(transcode != usertransaction_code){
         $("#withdrawaltransactionstatus").html("Wrong Transaction Code");
        return false;
    }

    }

    $('#depositaccount').on('keyup', function() {
            $("#customerid").val("");
            $("#wallet").val("");
            $("#acname").html("");
            var id = this.value;
            if ($(this).val().length < 13) {
                return;
            }
            var url = "{{ url('/getname') }}/" + id;
            $.ajax({
                url: url,
                type: "GET",
                dataType: 'json',
                success: function(result) {
                    if(result.length == 0){
                        $("#acname").html("NO Data Found").css("color","red");
                    }
                    $.each(result, function(key, value) {
                        $("#customerid").val(value.id);
                        $("#wallet").val(value.wallet);
                        $("#acname").html(value.full_name).css("color","green");
                    });
                }
            });
        });
   
    $('#withdrawalaccount').on('keyup', function() {
            $("#withdrawalacname").html("");
            $("#withdrawalcustomerid").val("");
            $("#withdrawalwallet").val("");
            $("#customerbalance").hide();
            var id = this.value;
            if ($(this).val().length < 13) {
                return;
            }
            var url = "{{ url('/getname') }}/" + id;
            $.ajax({
                url: url,
                type: "GET",
                dataType: 'json',
                success: function(result) {
                    if(result.length == 0){
                        $("#withdrawalacname").html("NO Data Found").css("color","red");
                    }
                    $.each(result, function(key, value) {
                        $("#withdrawalcustomerid").val(value.id);
                        $("#withdrawalwallet").val(value.wallet);
                        $("#customerbalance").show();
                        $("#withdrawalacname").html(value.full_name).css("color","green");
                    });
                }
            });
        });
</script>
@endpush