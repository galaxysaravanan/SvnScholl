<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;

class MFIApiController extends Controller{

    public function createaccount(Request $request){
        $API_KEY = env('API_KEY','');
        $key = $request->key;
        $response = array();
        $message = "";
        $username=$request->username;
        if($key == $API_KEY){
            $sql="select username from customers where username='$username'";
            $result=DB::select($sql);
            if(count($result)==0){
                $account_type_id=$request->account_type_id;
                $branch_id=$request->branch_id;
                $account_no=self::generate_accountno($branch_id,$account_type_id);
                $full_name=$request->full_name;

                $phone=$request->phone;
                $email=$request->email;
                $aadhaar_no=$request->aadhaar_no;
                $address=$request->address;
                $district_id=0;
                $taluk_id=0;
                $panchayath_id=0;
                if($request->district_id != ""){
                    $district_id=$request->district_id;
                }
                if($request->taluk_id != ""){
                    $taluk_id=$request->taluk_id;
                }
                if($request->panchayath_id != ""){
                    $panchayath_id=$request->panchayath_id;
                }
                $nominee_name=$request->nominee_name;
                $nominee_phone=$request->nominee_phone;
                $joined_from=$request->status;
                $sql="insert into customers (account_type_id,branch_id,account_no,full_name,username,phone,email,address,dist_id,nominee_name,nominee_phone,aadhaar_no,taluk_id,panchayath_id,joined_from) values ('$account_type_id','$branch_id','$account_no','$full_name','$username','$phone','$email','$address','$district_id','$nominee_name','$nominee_phone','$aadhaar_no','$taluk_id','$panchayath_id','$joined_from')";
                DB::insert($sql);
                $message = "success";
            }
        }else{
            $message = "Access Denied";
        }
        $response["message"] = "success";
        return response()->json($response);
    }

    private static function generate_accountno($branch_id,$account_type_id){
        $account_no=0;
        $sql="select * from accountno_control where account_type_id=$account_type_id and branch_id=$branch_id";
        $result = DB::select($sql);
        if(count($result)>0){
            $account_no=$result[0]->account_no;
            $account_no++;
            $sql="update accountno_control set account_no=$account_no where account_type_id=$account_type_id and branch_id=$branch_id";
            DB::update($sql);
        }else{
            $account_no=1;
            $sql="insert into accountno_control (branch_id,account_type_id,account_no) values ('$branch_id','$account_type_id','$account_no')";
            DB::insert($sql);
        }
        return str_pad($branch_id,4,"0",STR_PAD_LEFT).str_pad($account_type_id,2,"0",STR_PAD_LEFT).str_pad($account_no,7,"0",STR_PAD_LEFT);
    }

    public function get_branch($key) {
        $response = array();
        $district_name = "";
        $message = '';
        $API_KEY = env( 'API_KEY', '' );
        if ( $key == $API_KEY ) {
            $sql = "select * from organization where org_type=6";
            $result = DB::select($sql);
            $i=0;
            foreach($result as $res){
                $response[$i]["id"] = $res->id;
                $response[$i]["org_name"] = $res->center_name;
                $i++;
            }
        } else {
            $message = 'Access Denied';
        }
        return response()->json( $response );
    }

    public function get_district($key) {
        $response = array();
        $message = '';
        $API_KEY = env( 'API_KEY', '' );
        if ( $key == $API_KEY ) {
            $response = DB::table('district')->orderBy( 'id', 'Asc' )->get();
        } else {
            $message = 'Access Denied';
        }
        return response()->json( $response );
    }

     public function get_taluk($key,$distid) {
        $response = array();
        $message = '';
        $API_KEY = env( 'API_KEY', '' );
        if ( $key == $API_KEY ) {
            $response = DB::table('taluk')->where('district_id',$distid)->orderBy( 'id', 'Asc' )->get();
        } else {
            $message = 'Access Denied';
        }
        return response()->json( $response );
    }


     public function get_panchayath($key,$talukid) {
        $response = array();
        $message = '';
        $API_KEY = env( 'API_KEY', '' );
        if ( $key == $API_KEY ) {
            $response = DB::table('panchayath')->where('taluk_id',$talukid)->orderBy( 'id', 'Asc' )->get();
        } else {
            $message = 'Access Denied';
        }
        return response()->json( $response );
    }

    public function get_customer_branch($key,$distid,$taluk_id,$panchayath_id) {
        $response = array();
        $message = '';
        $API_KEY = env( 'API_KEY', '' );
        if ( $key == $API_KEY ) {
            $data = DB::table('organization')->where('panchayath_id',$panchayath_id)->orderBy( 'id', 'Desc' )->limit(1)->get();
            $center_name = "";
            $orgtype = 0;
            $orgid = 0;
            $branch_id = 0;
            if(count($data) > 0){
                $center_name = $data[0]->center_name;
                $orgtype = $data[0]->org_type;
                $orgid = $data[0]->id;
                $branch_id = $data[0]->branch_id;
            }else{
                $data1 = DB::table('organization')->where('taluk_id',$taluk_id)->orderBy( 'id', 'Desc' )->limit(1)->get();
                if(count($data1) > 0){
                    $center_name = $data1[0]->center_name;
                    $orgtype = $data1[0]->org_type;
                    $orgid = $data1[0]->id;
                    $branch_id = $data1[0]->branch_id;
                }else{
                    $data2 = DB::table('organization')->where('district_id',$distid)->orderBy( 'id', 'DESC' )->limit(1)->get();
                    if(count($data2) > 0){
                        $center_name = $data2[0]->center_name;
                        $orgtype = $data2[0]->org_type;
                        $orgid = $data2[0]->id;
                        $branch_id = $data2[0]->branch_id;
                    }else{
                      $data3 = DB::table('organization')->where('id',1)->limit(1)->get();
                        if(count($data3) > 0){
                            $center_name = $data3[0]->center_name;
                            $orgtype = $data3[0]->org_type;
                            $orgid = $data3[0]->id;
                            $branch_id = $data3[0]->branch_id;
                        }

                    }
                }
            }
        } else {
            $message = 'Access Denied';
        }
        $response["center_name"] = $center_name;
        $response["orgtype"] = $orgtype;
        $response["orgid"] = $orgid;
        $response["branchid"] = $branch_id;
        return response()->json( $response );
    }

    public function get_account_number($key,$username) {
        $response = array();
        $message = '';
        $API_KEY = env( 'API_KEY', '' );
        if ( $key == $API_KEY ) {
            $data = DB::table('customers')->where('username',$username)->first();
            $accountnumber = "";
            if($data){
                $accountnumber = $data->account_no;
            }
        } else {
            $message = 'Access Denied';
        }
        $response["accountnumber"] = $accountnumber;
        return response()->json( $response );
    }

    public function createkyc(Request $request){
        $API_KEY = env('API_KEY','');
        $key = trim($request->apikey);
        $response = array();
        $message = "";
        $username=$request->username;
        if($key == $API_KEY){
            $sql="select username,id from customers where username='$username'";
            $result=DB::select($sql);
            if(count($result) > 0){
                $customerid = $result[0]->id;
                $pan_no = $request->pan_no;
                $aadhaar_no = $request->aadhaar_no;
                $nominee_name = $request->nomine_name;
                $nominee_phone = $request->nomine_phone;
                $nomine_dob = $request->nomine_dob;
                $nomine_aadhaar_no = $request->nomine_aadhaar_no;
                $panimage = $request->pancard;
                $aadhaarfront = $request->aadhaarfront;
                $aadhaarback = $request->aadhaarback;
                $nomineeaadhaarfront = $request->nomineeaadhaarfront;
                $nomineeaadhaarback = $request->nomineeaadhaarback;
                $profileimg = $request->profileimg;

                DB::table( 'customers' )->where( 'id', $customerid )->update( [
                    'pan_image'                 => $panimage,
                    'aadhaar_front'             => $aadhaarfront,
                    'aadhaar_back'              => $aadhaarback,
                    'photo'                     => $profileimg,
                    'nominee_aadhaar_front'     => $nomineeaadhaarfront,
                    'nominee_aadhaar_back'      => $nomineeaadhaarback,
                    'pan_no'                    => $pan_no,
                    'aadhaar_no'                => $aadhaar_no,
                    'nominee_name'              => $nominee_name,
                    'nominee_phone'             => $nominee_phone,
                    'nomine_dob'                => $nomine_dob,
                    'nomine_aadhaar_no'         => $nomine_aadhaar_no,
                ] );
                $message = "success";
            }
        }else{
            $message = "Access Denied";
        }
        $response["message"] = $message;
        return response()->json($response);
    }


    public function get_transaction_report($apiKey,$username) {
        $API_KEY = env( 'API_KEY', '' );
        $response = array();
        $data = "";
        $message = '';
        $wallet = "";
        $balance = 0;
        if ( $API_KEY == $apiKey ) {
        $sql = "SELECT id FROM customers where username='$username'";
        $result = DB::select( $sql );
        $customerid = 0;
        if ( count( $result ) > 0 ) {
            $customerid = $result[ 0 ]->id;
        }
        $data = DB::table('payment_history')->where('from_id',$customerid)->orderBy( 'id', 'DESC' )->get();
         $wallet = DB::table('customers')->select('wallet')->where('id',$customerid)->first();
         if($wallet){
            $balance = $wallet->wallet;
         }
        } else {
            $message = 'Access Denied';
        }
        $response[ 'message' ] = $message;
        $response[ 'data' ] = $data;
        $response[ 'balance' ] = $wallet;
        return response()->json($response);
    }
}
