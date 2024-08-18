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
        return view( 'dashboard');
    }

    public function bgdark( $user_id ) {
        $id = Auth::user()->id;
        $sql = "update users set colour=$user_id where id = $id";

        DB::update( DB::raw( $sql ) );
        $response[ 'status' ] = 'success';
        return response()->json( $response );
    }
}
