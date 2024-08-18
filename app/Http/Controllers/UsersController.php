<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;
use App\Models\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class UsersController extends Controller {

    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function users() {

        $loginid = Auth::user()->id;

        if ( Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2) {
            $viewusers = DB::table( 'users' )->select( 'users.*', 'user_type.*', 'users.id as usersID' )
            ->Join( 'user_type', 'user_type.id', '=', 'users.user_type_id' )
            ->orderBy( 'users.id', 'Asc' )->get();

        } elseif ( Auth::user()->user_type_id == 2 ) {
            $viewusers = DB::table( 'users' )->select( 'users.*', 'user_type.*', 'users.id as usersID' )
            ->Join( 'user_type', 'user_type.id', '=', 'users.user_type_id' )
            ->where( 'users.id', '!=', $loginid )
            ->orderBy( 'users.id', 'Asc' )->get();

        }

        if ( Auth::user()->user_type_id == 1 ) {
            $usertypeid = [ '2', '3' ];
            $usertypes = DB::table( 'user_type' )->whereIn( 'id', $usertypeid )->orderBy( 'id', 'Asc' )->get();
        } elseif ( Auth::user()->user_type_id == 2 ) {
            $usertypes = DB::table( 'user_type' )->where( 'id', '=', '3' )->get();
        }

        return view( 'users/index', compact( 'viewusers','usertypes' ) );
    }

    public function saveusertype( Request $request ) {
        DB::table( 'user_type' )->insert( [
            'user_type_name'       =>   $request->user_type_name,
            'status'               =>   "Active",
        ] );
        return redirect()->back()->with( 'success', 'User Type Add Successfully ... !' );
    }

    public function saveprofile( Request $request ) {
        $full_name = $request->full_name;
        $id = Auth::user()->id;
        $sql = "update users set full_name='$full_name' where id=$id";
        DB::update( $sql );
        $photo = '';
        if ( $request->photo != null ) {
            $photo = $id.'.'.$request->file( 'photo' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'profile' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'photo' ][ 'tmp_name' ], $filepath . $photo );
            $image = DB::table( 'users' )->where( 'id', $id )->update( [
                'profile_photo' => $photo,
            ] );
        }
        return redirect( 'userprofile' );
    }

    public function updateusertype( Request $request ) {

        DB::table( 'user_type' )->where( 'id', $request->designate_id )->update( [
            'user_type_name'       =>   $request->user_type_name,
            'status'               =>   1,
        ] );
        return redirect()->back()->with( 'success', 'Designation Update Successfully ... !' );
    }

    public function changepassword() {
        $userid = Auth::user()->id;
        return view( 'users/changepassword' );
    }

    public function updatepassword( Request $request ) {
        $user_id = Auth::user()->id;
        $oldpassword = $request->oldpassword;
        $new_password = $request->new_password;
        $conf_password = trim( $request->confirm_password );
        $sql = "select * from users where cpassword = '$oldpassword' and id=$user_id";
        $result = DB::select( DB::raw( $sql ) );
        if ( count( $result ) > 0 ) {
            if ( $new_password != $conf_password ) {
                return redirect( '/changepassword' )->with( 'error', 'Passwords does not match' );
            } else {
                $password = Hash::make( $new_password );
                $sql = "update users set password='$password',cpassword='$new_password' where id=$user_id";
                DB::update( $sql );
                return redirect( '/changepassword' )->with( 'success', 'Password changed successfully' );
            }
        } else {
            return redirect( '/changepassword' )->with( 'error', 'Incorrect old password' );
        }
    }

    public function checkphone( Request $request ) {
        $phone = trim( $request->phone );
        $id = trim( $request->id );
        if ( $id == 0 ) {
            $sql = "SELECT * FROM organization where phone='$phone'";
        } else {
            $sql = "SELECT * FROM organization where phone='$phone' and id <> $id";
        }
        $users = DB::select( DB::raw( $sql ) );
        if ( count( $users ) > 0 ) {
            return response()->json( array( 'exists' => true ) );
        } else {
            return response()->json( array( 'exists' => false ) );
        }
    }

    public function checkemail( Request $request ) {
        $email = trim( $request->email );
        $id = trim( $request->id );
        if ( $id == 0 ) {
            $sql = "SELECT * FROM organization where email='$email'";
        } else {
            $sql = "SELECT * FROM organization where email='$email' and id <> $id";
        }
        $users = DB::select( DB::raw( $sql ) );
        if ( count( $users ) > 0 ) {
            return response()->json( array( 'exists' => true ) );
        } else {
            return response()->json( array( 'exists' => false ) );
        }
    }









    public function logout() {
        Auth::guard()->logout();
        return redirect()->intended( '/' );
    }
}
