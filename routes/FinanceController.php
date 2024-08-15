<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;
use App\Models\User;
use Jenssegers\Agent\Agent;

class FinanceController extends Controller {

    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function finance() {

        return view( 'finance/index' );
    }

    public function savings() {

        return view( 'finance/savings' );
    }

    public function newac() {
        $username = Auth::user()->username;
        $sql = 'select * from district';
        $districts = DB::select( $sql );
        $NALAVARIYAM_URL = env( 'NALAVARIYAM_URL', '' );
        $API_KEY = env( 'API_KEY', '' );
        $url = $NALAVARIYAM_URL .'/api/get_email_aadhaar_phone/'.$API_KEY.'/'.$username;
        $crl = curl_init();
        curl_setopt( $crl, CURLOPT_URL, $url );
        curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
        curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
        $response = curl_exec( $crl );
        $msg = '';
        if ( $response ) {
            $response = json_decode( $response, true );
            $msg = $response[ 'message' ];
        } else {
            $msg = 'Error calling wallet';
        }
        curl_close( $crl );
        $branch[0]["id"] = "1";
        $branch[0]["name"]="Kanyakumari";
        $branch = json_decode(json_encode($branch));
        return view( 'finance/newac', compact('districts','response','branch'));
    }

    public function savenewac( Request $request ) {
        DB::table( 'users' )->where( 'id', Auth::user()->id )->update( [
            'full_name'      => $request->full_name,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'address'        => $request->address,
            'dist_id'        => $request->district_id,
            'nominee_name'   => $request->nominee_name,
            'nominee_phone'  => $request->nominee_phone,
            'branch'         => $request->branch,
            'aadhaar_no'     => $request->aadhaar_no,
            'savings_account'=> 1,
        ] );

        $API_KEY = env('API_KEY','');
        $full_name = $request->full_name;
        $username = $request->username;
        $phone = $request->phone;
        $email = $request->email;
        $address = $request->address;
        $district_id = $request->district_id;
        $nominee_name = $request->nominee_name;
        $nominee_phone = $request->nominee_phone;
        $aadhaar_no = $request->aadhaar_no;
        $account_type_id = 1;
        $branch_id = Auth::user()->referral_id;
        $MFI_URL = env( 'MFI_URL', '' );
        $ch = curl_init();
        $post_data = "key=$API_KEY&account_type_id=$account_type_id&branch_id=$branch_id&full_name=$full_name&username=$username&phone=$phone&email=$email&address=$address&district_id=$district_id&nominee_name=$nominee_name&nominee_phone=$nominee_phone&aadhaar_no=$aadhaar_no";
        $url = $MFI_URL.'/api/createaccount';
        echo $url."<br>";
        echo $post_data."<br>";die;
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec( $ch );
        curl_close( $ch );
        return redirect( '/finance' )->with( 'success', 'Savings account created successfully' );
    }

}
