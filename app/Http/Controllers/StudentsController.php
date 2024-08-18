<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;
use App\Models\User;

class StudentsController extends Controller {

    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function students() {

        $loginid = Auth::user()->id;

        if ( Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2 ) {
            $viewstudents = DB::table( 'students' )->select( 'students.*', 'students.id as studentsID' )
            ->orderBy( 'students.id', 'Asc' )->get();
        }

        return view( 'students/index', compact( 'viewstudents' ) );
    }

    public function savestudents( Request $request ) {

        DB::table( 'students' )->insert( [
            'full_name'                 => $request->full_name,
            'phone'                     => $request->phone,
            'aadhaar_no'                => $request->aadhaar_no,
            'pin_code'                  => $request->pin_code,
            'caste'                     => $request->caste,
            'religion'                  => $request->religion,
            'email'                     => $request->email,
            'address'                   => $request->address,
            'father_name'               => $request->father_name,
            'father_mobile'             => $request->father_mobile,
            'mother_name'               => $request->mother_name,
            'father_occupation'         => $request->father_occupation,
            'mother_occupation'         => $request->mother_occupation,
            'status'                    => 'Active',
        ] );
        $insertid = DB::getPdo()->lastInsertId();

        $aadhar = '';
        if ( $request->aadhaar_file != null ) {
            $aadhar = $insertid . '.' . $request->file( 'aadhaar_file' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'aadhar' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'aadhaar_file' ][ 'tmp_name' ], $filepath . $aadhar );
        }
        $smart = '';
        if ( $request->smart_card != null ) {
            $smart = $insertid . '.' . $request->file( 'smart_card' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'smartcard' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'smart_card' ][ 'tmp_name' ], $filepath . $smart );
        }
        $aadhaar_father = '';
        if ( $request->father_aadhaar != null ) {
            $aadhaar_father = $insertid . '.' . $request->file( 'father_aadhaar' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'fatheraadhaar' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'father_aadhaar' ][ 'tmp_name' ], $filepath . $aadhaar_father );
        }
        $aadhaar_mother = '';
        if ( $request->father_aadhaar != null ) {
            $aadhaar_mother = $insertid . '.' . $request->file( 'mother_aadhaar' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'motheraadhaar' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'mother_aadhaar' ][ 'tmp_name' ], $filepath . $aadhaar_mother );
        }
        $pro = '';
        if ( $request->profile_photo != null ) {
            $pro = $insertid . '.' . $request->file( 'profile_photo' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'profile' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'profile_photo' ][ 'tmp_name' ], $filepath . $pro );
        }

        $addimg = DB::table( 'students' )->where( 'id', $insertid )->update( [
            'aadhaar_file'          => $aadhar,
            'father_aadhaar'        => $aadhaar_father,
            'mother_aadhaar'        => $aadhaar_mother,
            'profile_photo'         => $pro,
            'smart_card'            => $smart,
        ] );

        return redirect( '/students' )->with( 'success', 'Students Created Successfully' );
    }

    public function updatestudents( Request $request ) {

        DB::table( 'students' )->where( 'id', $request->student_id )->update( [
            'full_name'                 => $request->full_name,
            'phone'                     => $request->phone,
            'aadhaar_no'                => $request->aadhaar_no,
            'pin_code'                  => $request->pin_code,
            'caste'                     => $request->caste,
            'religion'                  => $request->religion,
            'email'                     => $request->email,
            'address'                   => $request->address,
            'father_name'               => $request->father_name,
            'father_mobile'             => $request->father_mobile,
            'mother_name'               => $request->mother_name,
            'father_occupation'         => $request->father_occupation,
            'mother_occupation'         => $request->mother_occupation,
            'status'                    => 'Active',
        ] );

        $stuid = $request->customer_id;

        $aadhar = '';
        if ( $request->aadhaar_file != null ) {
            $aadhar = $stuid . '.' . $request->file( 'aadhaar_file' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'aadhar' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'aadhaar_file' ][ 'tmp_name' ], $filepath . $aadhar );
            $sql = "update students set aadhaar_file='$aadhar' where id = $stuid";
            DB::update( DB::raw( $sql ) );
        }
        $father = '';
        if ( $request->father_aadhaar != null ) {
            $father = $stuid . '.' . $request->file( 'father_aadhaar' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'fatheraadhaar' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'father_aadhaar' ][ 'tmp_name' ], $filepath . $father );
            $sql = "update students set father_aadhaar='$father' where id = $stuid";
            DB::update( DB::raw( $sql ) );
        }
        $mother = '';
        if ( $request->mother_aadhaar != null ) {
            $mother = $stuid . '.' . $request->file( 'mother_aadhaar' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'motheraadhaar' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'mother_aadhaar' ][ 'tmp_name' ], $filepath . $mother );
            $sql = "update students set mother_aadhaar='$mother' where id = $stuid";
            DB::update( DB::raw( $sql ) );
        }
        $pro = '';
        if ( $request->profile_photo != null ) {
            $pro = $stuid . '.' . $request->file( 'profile_photo' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'profile' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'profile_photo' ][ 'tmp_name' ], $filepath . $pro );
            $sql = "update students set profile_photo='$pro' where id = $stuid";
            DB::update( DB::raw( $sql ) );
        }
        $smart = '';
        if ( $request->smart_card != null ) {
            $smart = $stuid . '.' . $request->file( 'smart_card' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'smartcard' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'smart_card' ][ 'tmp_name' ], $filepath . $smart );
            $sql = "update students set smart_card='$smart' where id = $cusid";
            DB::update( DB::raw( $sql ) );
        }

        return redirect( '/students' )->with( 'success', 'Students Updated Successfully' );
    }

    public function timetable() {

        return view( 'students/timetable');
    }
}
