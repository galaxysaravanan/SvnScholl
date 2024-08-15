<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;
use App\Models\User;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware( 'auth' );
    }

       public function accounts() {
        $modeofpay = DB::table( 'mode_of_pay' )->get();
        return view( 'users/accounts', compact( 'modeofpay' ) );

        }

        public function importusers(){
             $sql = "select username,branch_id,org_id from users where username not in (select username from customers where username is not NULL) order by id";
        $result = DB::select($sql);
        foreach ($result as $res) {
            echo $res->username." ".$res->branch_id."<br>";
            DB::table('customers')->insert( [
                'username' => $res->username,
                'branch_id' => $res->branch_id,
                'org_id' => $res->org_id,
                'status' => 1,
            ]);
        }
        
        }

        //Transaction Type 1 - Credit,2 - Debit
        public function savedeposit( Request $request ) {
        $wallet = $request->wallet;
        $amount = $request->amount;
        $newbalance = $wallet + $amount;
        $userwallet = Auth::user()->wallet;
        $branch_id = Auth::user()->branch_id;
        $authuserid = Auth::user()->id;
        $username = Auth::user()->username;
        $transaction_id = uniqid();
        $remarks = "Deposited by branch.Branch Code".' '.$branch_id." Transaction Id".' '.$transaction_id;
        $paydate = date("Y-m-d");
        $paytime = date("H:i:s");
        $getid = DB::table( 'customers' )->select('id')->where('username',$username)->first();
        $userid = 0;
        if($getid){
            $userid = $getid->id;
        }
        DB::table( 'payment_history' )->insert( [
            'from_id'                   => $request->customerid,
            'to_id'                     => $userid,
            'transaction_id'            => $transaction_id,
            'old_balance'               => $request->wallet,
            'pay_amount'                => $request->amount,
            'new_balance'               => $newbalance,
            'transaction_pin'          => $request->transaction_pin,
            'payment_type_id'           => $request->payment_type,
            'transaction_type'          => 1,
            'remarks'                   => $remarks,
            'login_id'                   => $userid,
            'payment_date'                   => $paydate,
            'payment_time'                   => $paytime,
        ] );

        $sql = "update customers set wallet = wallet + $amount where id = '$request->customerid'";
        DB::update(DB::raw($sql));
        $usernewbalance = $userwallet - $amount;
         $remarks = "Transfered To Customer Account.Account Number".' '.$request->account_no;
        DB::table( 'payment_history' )->insert( [
            'from_id'                   => $userid,
            'to_id'                     => $request->customerid,
            'transaction_id'            => $transaction_id,
            'old_balance'               => $userwallet,
            'pay_amount'                => $amount,
            'new_balance'               => $usernewbalance,
            'transaction_pin'          => $request->transaction_pin,
            'payment_type_id'           => $request->payment_type,
            'transaction_type'          => 2,
            'remarks'                   => $remarks,
            'login_id'                   => $userid,
            'payment_date'                   => $paydate,
            'payment_time'                   => $paytime,

        ] );

        $sql = "update users set wallet = wallet - $amount where id = '$authuserid'";
        DB::update(DB::raw($sql));

        $checkfirstpayment = DB::table( 'payment_history' )->select('id')->where('from_id',$request->customerid)->get();
        if(count($checkfirstpayment) == 1){
            $firstcom = $amount * 5 / 100;
            $usercombalance = $usernewbalance + $firstcom;
            $remarks = "Customer First Top UP Commission.Customer Account No".' '.$request->account_no;
            DB::table( 'payment_history' )->insert( [
            'from_id'                   => $userid,
            'to_id'                     => $request->customerid,
            'transaction_id'            => $transaction_id,
            'old_balance'               => $usernewbalance,
            'pay_amount'                => $firstcom,
            'new_balance'               => $usercombalance,
            'transaction_pin'          => $request->transaction_pin,
            'payment_type_id'           => $request->payment_type,
            'transaction_type'          => 1,
            'remarks'                   => $remarks,
            'login_id'                   => $userid,
            'payment_date'                   => $paydate,
            'payment_time'                   => $paytime,

        ] );

            $sql = "update users set wallet = wallet + $firstcom where id = '$authuserid'";
            DB::update(DB::raw($sql));
        }else{
            $getcommission =  DB::table('deposit_commission')->select('own_commission')->where('id', \DB::raw("(select max(`id`) from deposit_commission where amount < $amount)"))->first();
            if($getcommission){
                $commission_amount = $getcommission->own_commission;
                $userdepositcombalance = $usernewbalance + $commission_amount;

                $remarks = "Customer Deposit Commission.Customer Account No".' '.$request->account_no;
            DB::table( 'payment_history' )->insert( [
            'from_id'                   => $userid,
            'to_id'                     => $request->customerid,
            'transaction_id'            => $transaction_id,
            'old_balance'               => $usernewbalance,
            'pay_amount'                => $commission_amount,
            'new_balance'               => $userdepositcombalance,
            'transaction_pin'          => $request->transaction_pin,
            'payment_type_id'           => $request->payment_type,
            'transaction_type'          => 1,
            'remarks'                   => $remarks,
            'login_id'                   => $userid,
            'payment_date'                   => $paydate,
            'payment_time'                   => $paytime,

        ] );

            $sql = "update users set wallet = wallet + $commission_amount where id = '$authuserid'";
            DB::update(DB::raw($sql));
            }
                   
        }
        return redirect('/accounts')->with('success','Amount Deposited Successflly');


    }

    public function savewithdrawal( Request $request ) {
        $wallet = $request->wallet;
        $amount = $request->amount;
        $newbalance = $wallet - $amount;
        $userwallet = Auth::user()->wallet;
        $branch_id = Auth::user()->branch_id;
        $username = Auth::user()->username;
        $authuserid = Auth::user()->id;
        $transaction_id = uniqid();
        $remarks = "Withdrawed from branch.Branch Code".' '.$branch_id." Transaction Id".' '.$transaction_id;
        $paydate = date("Y-m-d");
        $paytime = date("H:i:s");
         $getid = DB::table( 'customers' )->select('id')->where('username',$username)->first();
        $userid = 0;
        if($getid){
            $userid = $getid->id;
        }
        DB::table( 'payment_history' )->insert( [
            'from_id'                   => $request->customerid,
            'to_id'                     => $userid,
            'transaction_id'            => $transaction_id,
            'old_balance'               => $request->wallet,
            'pay_amount'                => $request->amount,
            'new_balance'               => $newbalance,
            'transaction_pin'           => $request->transaction_pin,
            'payment_type_id'           => $request->payment_type,
            'transaction_type'          => 2,
            'remarks'                   => $remarks,
            'login_id'                   => $userid,
            'payment_date'               => $paydate,
            'payment_time'               => $paytime,
        ] );

        $sql = "update customers set wallet = wallet - $amount where id = '$request->customerid'";
        DB::update(DB::raw($sql));

        $newbalance = $userwallet + $amount;
        $remarks = "Customer Withdrawed amount".' '.$amount.".Customer Account No".' '.$request->account_no; 
        DB::table( 'payment_history' )->insert( [
            'from_id'                   => $userid,
            'to_id'                     => $request->customerid,
            'transaction_id'            => $transaction_id,
            'old_balance'               => $userwallet,
            'pay_amount'                => $amount,
            'new_balance'               => $newbalance,
            'transaction_pin'           => $request->transaction_pin,
            'payment_type_id'           => $request->payment_type,
            'transaction_type'          => 1,
            'remarks'                   => $remarks,
            'login_id'                   => $userid,
            'payment_date'               => $paydate,
            'payment_time'               => $paytime,
        ] );

        $sql = "update users set wallet = wallet + $amount where id = '$authuserid'";
        DB::update(DB::raw($sql));

        $getcommission =  DB::table('withdrawal_commission')->select('commission')->where('id', \DB::raw("(select max(`id`) from withdrawal_commission where amount < $amount)"))->first();
            if($getcommission){
                $commission_amount = $getcommission->commission;
                $userwithdrawcombalance = $newbalance + $commission_amount;
                echo $commission_amount;
                $remarks = "Customer Withdrawal Commission.Customer Account No".' '.$request->account_no;
            DB::table( 'payment_history' )->insert( [
            'from_id'                   => $userid,
            'to_id'                     => $request->customerid,
            'transaction_id'            => $transaction_id,
            'old_balance'               => $newbalance,
            'pay_amount'                => $commission_amount,
            'new_balance'               => $userwithdrawcombalance,
            'transaction_pin'          => $request->transaction_pin,
            'payment_type_id'           => $request->payment_type,
            'transaction_type'          => 1,
            'remarks'                   => $remarks,
            'login_id'                   => $userid,
            'payment_date'                   => $paydate,
            'payment_time'                   => $paytime,

        ] );

            $sql = "update users set wallet = wallet + $commission_amount where id = '$authuserid'";
            DB::update(DB::raw($sql));
            }
                   

        return redirect('/accounts')->with('success','Amount Withdrawed Successflly');


    }
    
    
}
