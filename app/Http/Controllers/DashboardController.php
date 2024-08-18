<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\User;

class DashboardController extends Controller {
    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function dashboard() {
        $sql=" select count(id) as Students from students";
        $result = DB::select( DB::raw( $sql ) );
        if ( count( $result ) > 0 ) {

            $Students = $result[ 0 ]->Students;

        }
        $sql=" select count(id) as Users from users";
        $result = DB::select( DB::raw( $sql ) );
        if ( count( $result ) > 0 ) {

            $Users = $result[ 0 ]->Users;

        }
        $accountcount = "";
        $accounttype = array();
        $sql="select * from account_type order by id";
        $result = DB::select($sql);
        $i=0;
        foreach($result as $res){
            $account_type_id = $res->id;
            $account_type_name = $res->name;
            $accounttype[$i]["account_type_id"] = $account_type_id;
            $accounttype[$i]["account_type_name"] = $account_type_name;
            $accounttype[$i]["accountcount"]  = 0;

        }

        return view( 'dashboard',compact('Students','Users'));
    }

    public function bgdark( $user_id ) {
        $id = Auth::user()->id;
        $sql = "update users set colour=$user_id where id = $id";

        DB::update( DB::raw( $sql ) );
        $response[ 'status' ] = 'success';
        return response()->json( $response );
    }
}
