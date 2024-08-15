<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;
use App\Models\User;

class PaymentsController extends Controller {

    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function paymenthistory () {
        $loginid = Auth::user()->id;
        $username = Auth::user()->username;
        $getuserid = DB::table( 'customers' )->select('id')->where( 'username', $username )->first();
        $userid = 0;
        if($getuserid){
            $userid = $getuserid->id;
        }
        $paymenthistory = DB::table( 'payment_history' )->where( 'from_id', $userid )->orderBy( 'id', 'Asc' )->get();
        return view( 'payments/payment_history', compact( 'paymenthistory' ) );
    }

     public function customerhistory ($id) {

        $statements = DB::table( 'payment_history' )->where( 'from_id', $id )->orderBy( 'id', 'Asc' )->get();
        return view( 'payments/customer_history', compact( 'statements' ) );
    }

    public function requestpayment() {
        $loginid = Auth::user()->id;
        $requestpayment = DB::table( 'payment_request' )->orderBy( 'id', 'Asc' )->get();
        return view( 'payments/request_payment', compact( 'requestpayment' ) );
    }

    public function approvepayment( Request $request ) {

        $amount = $request->amount;
        $from_id = $request->from_id;
        $row_id = $request->row_id;
        $login_id = Auth::user()->id;
        $transaction_id = uniqid();
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $status = 'Approved';
        $sql = "update payment_request set status = '$status' where id = $row_id";
        DB::update( DB::raw( $sql ) );
        $remarks = 'Fund Transfer';
        $getwallet = DB::table( 'users' )->select('wallet','username')->where('id',$from_id)->first();
        $balance = 0;
        if($getwallet){
            $balance = $getwallet->wallet;
            $username = $getwallet->username;
        }
        $newbalance = $balance + $amount;
        $getuserid = DB::table( 'customers' )->select('id')->where('username',$username)->first();
        $userid = 0;
        if($getuserid){
            $userid = $getuserid->id;
        }
        DB::table( 'payment_history' )->insert( [
            'from_id'                   => $userid,
            'to_id'                     => $login_id,
            'transaction_id'            => $transaction_id,
            'old_balance'               => $balance,
            'pay_amount'                => $amount,
            'new_balance'               => $newbalance,
            'payment_type_id'           => 1,
            'transaction_type'          => 1,
            'remarks'                   => $remarks,
            'login_id'                   => $login_id,
            'payment_date'               => $date,
            'payment_time'                   => $time,
        ] );
        $sql = "update users set wallet = wallet + $amount where id = '$from_id'";
        DB::update( DB::raw( $sql ) );
        
        $getwallet = DB::table( 'users' )->select('wallet','username')->where('id',$login_id)->first();
        $balance = 0;
        if($getwallet){
            $balance = $getwallet->wallet;
            $username = $getwallet->username;
        }
        $newbalance = $balance - $amount;
        $getuserid = DB::table( 'customers' )->select('id')->where('username',$username)->first();
        $debitlogin_id = 0;
        if($getuserid){
            $debitlogin_id = $getuserid->id;
        }
       DB::table( 'payment_history' )->insert( [
            'from_id'                   => $debitlogin_id,
            'to_id'                     => $userid,
            'transaction_id'            => $transaction_id,
            'old_balance'               => $balance,
            'pay_amount'                => $amount,
            'new_balance'               => $newbalance,
            'payment_type_id'           => 1,
            'transaction_type'          => 2,
            'remarks'                   => $remarks,
            'login_id'                   => $login_id,
            'payment_date'                   => $date,
            'payment_time'                   => $time,
        ] );
        $sql = "update users set wallet = wallet - $amount where id = $login_id";
        DB::update( DB::raw( $sql ) );

        return redirect()->back()->with( 'success', 'Amount Approved  Successfully' );
    }

    public function addfunds( Request $request ) {

        $amount = $request->pay_amount;
        $username = Auth::user()->username;
        $balance = Auth::user()->wallet;
        $authuserid = Auth::user()->id;
        $transaction_id = uniqid();
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $remarks = 'Add Funds';
        $newbalance = $balance + $amount;
        $getuserid = DB::table( 'customers' )->select('id')->where('username',$username)->first();
        $userid = 0;
        if($getuserid){
            $userid = $getuserid->id;
        }
        DB::table( 'payment_history' )->insert( [
            'from_id'                   => $userid,
            'to_id'                     => $userid,
            'transaction_id'            => $transaction_id,
            'old_balance'               => $balance,
            'pay_amount'                => $amount,
            'new_balance'               => $newbalance,
            'payment_type_id'           => 1,
            'transaction_type'          => 1,
            'remarks'                   => $remarks,
            'login_id'                   => $userid,
            'payment_date'               => $date,
            'payment_time'               => $time,
        ] );
        $sql = "update users set wallet = wallet + $amount where id = '$authuserid'";
        DB::update( DB::raw( $sql ) );

        return redirect()->back()->with( 'success', 'Amount Added to the wallet Successfully' );
    }

    public function declinerequest_payment( $toid ) {

        $sql = "update payment_request set status = 'Declined' where id = $toid";
        DB::update( DB::raw( $sql ) );
        return redirect()->back()->with( 'success', 'Request Amount Declined  Successfullyy' );
    }

}
