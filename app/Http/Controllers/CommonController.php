<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;
use App\Models\User;

class CommonController extends Controller {

    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function districts() {
        $districts = DB::table( 'district' )->orderBy( 'id', 'Asc' )->get();
        return view( 'common/districts', compact( 'districts' ) );
    }

    public function taluks( $district_id ) {
        $taluks = DB::table( 'taluk' )->where( 'district_id', $district_id )->orderBy( 'id', 'Asc' )->get();
        $managedistrict = DB::table( 'district' )->orderBy( 'id', 'Asc' )->get();

        return view( 'common/taluks', compact( 'taluks', 'managedistrict', 'district_id' ) );
    }

    public function panchayath( $taluk_id ) {
        $panchayath = DB::table( 'panchayath' )->where( 'taluk_id', $taluk_id )->orderBy( 'id', 'Asc' )->get();
        $managetaluk = DB::table( 'taluk' )->orderBy( 'id', 'Asc' )->get();

        return view( 'common/panchayath', compact( 'panchayath', 'managetaluk', 'taluk_id' ) );
    }

    public function adddistricts( Request $request ) {

        DB::table( 'district' )->insert( [
            'district_name'    => $request->district_name,
            'status'   => 'Active',
        ] );

        return redirect()->back()->with( 'success', 'District Added Successfully ... !' );
    }

     public function addtaluk( Request $request ) {

        DB::table( 'taluk' )->insert( [
            'district_id'     => $request->district_id,
            'taluk_name'    => $request->taluk_name,
            'status'   => 1,
        ] );

        return redirect()->back()->with( 'success', 'Taluk Added Successfully ... !' );
    }

    public function addpanchayath( Request $request ) {

        DB::table( 'panchayath' )->insert( [
            'taluk_id'     => $request->taluk_id,
            'panchayath_name'    => $request->panchayath_name,
            'status'   => 1,
        ] );

        return redirect()->back()->with( 'success', 'Panchayath Added Successfully ... !' );
    }

    public function deletepanchayath( $id ) {

        $deletepanchayath = DB::table( 'panchayath' )->where( 'id', $id )->delete();
        return redirect()->back()->with( 'success', 'Taluk Deleted Successfully' );
    }
    // public function gettaluk( Request $request ) {
    //     $gettaluk = DB::table( 'taluk' )->where( 'parent', $request->taluk_id )->orderBy( 'id', 'Asc' )->get();
    //     return response()->json( $gettaluk );
    // }

    // public function getpanchayath( Request $request ) {
    //     $getpanchayath = DB::table( 'panchayath' )->where( 'parent', $request->panchayath_id )->orderBy( 'id', 'Asc' )->get();
    //     return response()->json( $getpanchayath );
    // }

    public function saveuser( Request $request ) {

        DB::table( 'users' )->insert( [
            'name'                      => $request->name,
            'phone'                     => $request->phone,
            'email'                     => $request->email,
            'aadhar_no'                 => $request->aadhar_no,
            'pan_no'                    => $request->pan_no,
            'transaction_code'          => $request->transaction_code,
            'dist_id'                   => $request->dist_id,
            'panchayath_id'             => $request->panchayath_id,
            'taluk_id'                  => $request->taluk_id,
            'branch_name'               => $request->branch_name,
            'usertype_id'               => $request->usertype_id,
            'pincode'                   => $request->pincode,
            'caution_deposit_amount'    => $request->caution_deposit_amount,
            'password'                  => Hash::make( $request->password ),
            'cpassword'                 => $request->password,
            'address'                   => $request->address,
            'status'                    => '1',
            // 'usertype_id'               => '2'
        ] );

        $insertid = DB::getPdo()->lastInsertId();

        $aadhar = '';
        if ( $request->aadharfile != null ) {
            $aadhar = $insertid . '.' . $request->file( 'aadharfile' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'aadhar_image' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'aadharfile' ][ 'tmp_name' ], $filepath . $aadhar );
        }
        $pan = '';
        if ( $request->panfile != null ) {
            $pan = $insertid . '.' . $request->file( 'panfile' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'pan_image' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'panfile' ][ 'tmp_name' ], $filepath . $pan );
        }
        $profile = '';
        if ( $request->photo != null ) {
            $profile = $insertid . '.' . $request->file( 'photo' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'profile_image' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'photo' ][ 'tmp_name' ], $filepath . $profile );
        }
        $addimg = DB::table( 'users' )->where( 'id', $insertid )->update( [
            'aadharfile' => $aadhar,
            'panfile'    => $pan,
            'panfile'    => $profile,

        ] );

        $sql = "SELECT * FROM user_type where id = $request->user_type_id";
        $maicat = DB::select( $sql );
        $dashboard  = $maicat[ 0 ]->dashboard;
        $users      = $maicat[ 0 ]->users;

        DB::table( 'users' )->where( 'id', $insertid )->update( [
            'dashboard'                 => $dashboard,
            'users'                     => $users,
        ] );

        $sql = "SELECT * FROM user_types where id = $request->user_types_id";
        $maicat = DB::select( DB::raw( $sql ) );
        $dashboard         = $maicat[ 0 ]->dashboard;
        $roles             = $maicat[ 0 ]->roles;
        $addrole           = $maicat[ 0 ]->addrole;
        $editrole          = $maicat[ 0 ]->editrole;
        $deleterole        = $maicat[ 0 ]->deleterole;
        $users             = $maicat[ 0 ]->users;
        $adduser           = $maicat[ 0 ]->adduser;
        $edituser          = $maicat[ 0 ]->edituser;
        $deleteuser        = $maicat[ 0 ]->deleteuser;
        $patients          = $maicat[ 0 ]->patients;
        $addpatient        = $maicat[ 0 ]->addpatient;
        $editpatient       = $maicat[ 0 ]->editpatient;
        $deletepatient     = $maicat[ 0 ]->deletepatient;
        $blocks            = $maicat[ 0 ]->blocks;
        $addblock          = $maicat[ 0 ]->addblock;
        $editblock         = $maicat[ 0 ]->editblock;
        $deleteblock       = $maicat[ 0 ]->deleteblock;
        $rooms             = $maicat[ 0 ]->rooms;
        $addroom           = $maicat[ 0 ]->addroom;
        $editroom          = $maicat[ 0 ]->editroom;
        $deleteroom        = $maicat[ 0 ]->deleteroom;
        $admission         = $maicat[ 0 ]->admission;
        $billing           = $maicat[ 0 ]->billing;
        $pharmacy          = $maicat[ 0 ]->pharmacy;
        $investigation     = $maicat[ 0 ]->investigation;
        $ot                = $maicat[ 0 ]->ot;
        $mrd               = $maicat[ 0 ]->mrd;
        $appointments      = $maicat[ 0 ]->appointments;
        $mis               = $maicat[ 0 ]->mis;

        DB::table( 'users' )->where( 'id', $request->user_id )->update( [
            'user_id'                   => $customers_id,
            'dashboard'                 => $dashboard,
            'roles'                     => $roles,
            'addrole'                   => $addrole,
            'editrole'                  => $editrole,
            'deleterole'                => $deleterole,
            'users'                     => $users,
            'adduser'                   => $adduser,
            'edituser'                  => $edituser,
            'deleteuser'                => $deleteuser,
            'patients'                  => $patients,
            'addpatient'                => $addpatient,
            'editpatient'               => $editpatient,
            'deletepatient'             => $deletepatient,
            'blocks'                    => $blocks,
            'addblock'                  => $addblock,
            'editblock'                 => $editblock,
            'deleteblock'               => $deleteblock,
            'rooms'                     => $rooms,
            'addroom'                   => $addroom,
            'editroom'                  => $editroom,
            'deleteroom'                => $deleteroom,
            'admission'                 => $admission,
            'billing'                   => $billing,
            'pharmacy'                  => $pharmacy,
            'investigation'             => $investigation,
            'ot'                        => $ot,
            'mrd'                       => $mrd,
            'appointments'              => $appointments,
            'mis'                       => $mis,
        ] );

        return redirect( '/users' )->with( 'success', 'Users Created Successfully' );
    }

    public function updateusers( Request $request ) {

        DB::table( 'users' )->where( 'id', $request->user_id )->update( [
            'name'     => $request->name,
            'phone'    => $request->phone,
            'email'    => $request->email,
            'status'   => $request->status,
            'address'  => $request->address,
        ] );

        return redirect()->back()->with( 'success', 'Users Updated Successfully ... !' );
    }

    public function orgtype() {
        $usertypes = DB::table( 'user_type' )->where( 'status', '=', '1' )->orderBy( 'id', 'Asc' )->get();
        return view( 'users/user_type', compact( 'usertypes' ) );
    }

    public function saveusertype( Request $request ) {
        DB::table( 'user_type' )->insert( [
            'user_type_name'       =>   $request->user_type_name,
            'status'               =>   1,
        ] );
        return redirect()->back()->with( 'success', 'User Type Add Successfully ... !' );
    }

    public function permissions() {
        $userid = Auth::user()->id;
        $permissions = DB::table( 'users' )->get();
        return view( 'users/permissions', compact( 'permissions' ) );
    }

    public function updateuserpermissions( Request $request ) {

        DB::table( 'users' )->where( 'id', $request->row_id )->update( [
            'dashboard'           => $request->dashboard == null ? 0 : 1,
        ] );

        return redirect()->back()->with( 'success', 'User Type Updated Successfully ... !' );

    }

    public function editdistricts( Request $request ) {

        DB::table( 'district' )->where( 'id', $request->districts_id )->update( [
            'district_name'     => $request->district_name,
        ] );

        return redirect()->back()->with( 'success', 'Districts Updated Successfully ... !' );
    }

    public function deletedistricts( $id ) {

        $deletedistricts = DB::table( 'district' )->where( 'id', $id )->delete();
        return redirect( '/districts' )->with( 'success', 'Distict Deleted Successfully' );
    }

    public function edittaluk( Request $request ) {

        DB::table( 'taluk' )->where( 'id', $request->taluk_id )->update( [
            'district_id'   => $request->district_id,
            'taluk_name'    => $request->taluk_name,
        ] );
        return redirect()->back()->with( 'success', 'Taluk Updated Successfully ... !' );
    }
    public function deletetaluk( $id ) {

        $deletetaluk = DB::table( 'taluk' )->where( 'id', $id )->delete();
        return redirect()->back()->with( 'success', 'Taluk Deleted Successfully' );
    }
    public function editpanchayath( Request $request ) {

        DB::table( 'panchayath' )->where( 'id', $request->panchayath_id )->update( [
            'taluk_id'          => $request->taluk_id,
            'panchayath_name'   => $request->panchayath_name,
        ] );
        return redirect()->back()->with( 'success', 'Panchayath Updated Successfully ... !' );
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

    public function logout() {
        Auth::guard()->logout();
        return redirect()->intended( '/' );
    }
}
