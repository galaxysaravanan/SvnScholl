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

	public function index()
	{
		$sql = "select a.*,b.class_name,c.division_name from subject a,class_list b,division_list c where a.class_id=b.id and b.division_id=c.id";
		$subject = DB::select(DB::raw($sql));
		$sql = "select a.id,class_name,b.division_name from class_list a,division_list b where a.division_id=b.id";
		$class = DB::select(DB::raw($sql));
		return view('students/subject',compact('subject','class'));
	}

	public function AddSubject(Request $request){
		$addsubject = DB::table('subject')->insert([
			'subject_name'    =>   $request->subject_name,
			'class_id'        =>   $request->class_id,
			'school_id'       =>   auth()->user()->school_id,
			'max_marks'       =>   $request->max_marks,
			'pass_mark'       =>   $request->pass_mark,
		]);
		return redirect('/subject')->with('success', 'Subject Added Successfully');
	}

	public function EditSubject(Request $request){
		$editsubject = DB::table('subject')->where('id',$request->subject_id)->update([
			'subject_name'    =>   $request->subject_name,
			'class_id'        =>   $request->class_id,
			'max_marks'       =>   $request->max_marks,
			'pass_mark'       =>   $request->pass_mark,
		]);
		return redirect('/subject')->with('success', 'Subject Updated Successfully');
	}

	public function DeleteSubject($id){
		$deletesubject = DB::table('subject')->where('id',$id)->delete();
		return redirect('/subject')->with('success', 'Subject Deleted Successfully');
	}

}
