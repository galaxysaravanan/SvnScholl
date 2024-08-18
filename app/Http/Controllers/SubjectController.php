<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Hash;

class SubjectController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	private function check_access($BP){
		if($BP == "man_subject" && Auth::user()->man_subject == 0){
			echo "<h1>Access Denied</h1>";
			die;
		}elseif($BP == "add_subject" && Auth::user()->add_subject == 0){
			echo "<h1>Access Denied</h1>";
			die;
		}elseif($BP == "edt_subject" && Auth::user()->edt_subject == 0){
			echo "<h1>Access Denied</h1>";
			die;
		}elseif($BP == "del_subject" && Auth::user()->del_subject == 0){
			echo "<h1>Access Denied</h1>";
			die;
		}
	}

	public function index()
	{
		$this->check_access("man_subject");
		$sql = "select a.*,b.class_name,c.division_name from subject a,class_list b,division_list c where a.class_id=b.id and b.division_id=c.id";
		$subject = DB::select(DB::raw($sql));
		$sql = "select a.id,class_name,b.division_name from class_list a,division_list b where a.division_id=b.id";
		$class = DB::select(DB::raw($sql));
		return view('subject/subject',compact('subject','class'));
	}

	public function AddSubject(Request $request){
		$this->check_access("add_subject");  
		$exclude_exam = isset($request->exclude_exam) ? 1 : 0;
		$addsubject = DB::table('subject')->insert([
			'subject_name'    =>   $request->subject_name,
			'class_id'        =>   $request->class_id,
			'school_id'       =>   auth()->user()->school_id,
			'max_marks'       =>   $request->max_marks,
			'pass_mark'       =>   $request->pass_mark,
			'exclude_exam'    =>   $exclude_exam,
		]);
		return redirect('/subject')->with('success', 'Subject Added Successfully'); 
	}

	public function EditSubject(Request $request){
		$this->check_access("edt_subject");  
		$editsubject = DB::table('subject')->where('id',$request->subject_id)->update([
			'subject_name'    =>   $request->subject_name,
			'class_id'        =>   $request->class_id,
			'max_marks'       =>   $request->max_marks,
			'pass_mark'       =>   $request->pass_mark,
			'exclude_exam'    =>   $request->exclude_exam,
		]);
		return redirect('/subject')->with('success', 'Subject Updated Successfully'); 
	}

	public function DeleteSubject($id){
		$this->check_access("del_subject");  
		$deletesubject = DB::table('subject')->where('id',$id)->delete();
		return redirect('/subject')->with('success', 'Subject Deleted Successfully');
	}

}
