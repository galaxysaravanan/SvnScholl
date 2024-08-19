<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Hash;

class TimetableController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $school_id = auth()->user()->school_id;
    $weekday = array();
    $weekday[1] = "Monday";
    $weekday[2] = "Tuesday";
    $weekday[3] = "Wednesday";
    $weekday[4] = "Thursday";
    $weekday[5] = "Friday";
    $weekday[6] = "Saturday";
    $sql = "select a.id,a.class_name,a.division_id,b.division_name from class_list a,division_list b where a.division_id=b.id and a.school_id";
    $class = DB::select(DB::raw($sql));
    $sql = "select * from period order by period_name";
    $period = DB::select(DB::raw($sql));

    $sql = "select a.*,b.class_name,c.division_name,d.subject_name,e.period_name,e.start_time,e.end_time,f.name from timetable a,class_list b,division_list c,subject d,period e,users f where a.staff_id=f.id and a.period_id=e.id and a.subject_id=d.id and a.class_id=b.id and a.division_id=c.id and a.school_id order by class_id,division_id,weekday,period_id";
    $timetable = DB::select(DB::raw($sql));
    // echo'<pre>';print_r( $timetable );echo'</pre>';die;
    return view('students/timetable',compact('class','period','weekday','timetable'));
  }


  public function viewtimetable()
  {
    $class_id = "";
    $school_id = auth()->user()->school_id;
    $sql = "select a.id,a.class_name,a.division_id,b.division_name from class_list a,division_list b where a.division_id=b.id and a.school_id=$school_id order by a.id,b.id";
    $class = DB::select(DB::raw($sql));
    $timetable = array();
    $sql = "select * from subject order by subject_name";
    $subject = DB::select(DB::raw($sql));
    // echo'<pre>';print_r( $timetable );echo'</pre>';die;
    return view('students/viewtimetable',compact('class','class_id','timetable','subject'));
  }

  public function showtimetable($class_id,$division_id){
    $school_id = auth()->user()->school_id;
    $sql = "select a.id,a.class_name,a.division_id,b.division_name from class_list a,division_list b where a.division_id=b.id and a.school_id=$school_id";
    $class = DB::select(DB::raw($sql));
    $weekday = array();
    $weekday[1] = "Monday";
    $weekday[2] = "Tuesday";
    $weekday[3] = "Wednesday";
    $weekday[4] = "Thursday";
    $weekday[5] = "Friday";
    $weekday[6] = "Saturday";
    $sql = "select class_name,division_name from class_list a,division_list b where a.division_id=b.id and a.id=$class_id and b.id=$division_id";
    $result = DB::select(DB::raw($sql));
    $class_name = $result[0]->class_name.$result[0]->division_name;
    $sql = "select * from period order by period_name";
    $period = DB::select(DB::raw($sql));
    $sql = "select id,subject_name from subject where school_id=$school_id and class_id=$class_id order by subject_name";
    $subject = DB::select(DB::raw($sql));
    $sql = "select id,name from users where school_id=$school_id and user_type_id=3 order by name";
    $staff = DB::select(DB::raw($sql));
    $timetable = array();
    for($i=1;$i<7;$i++){
      $day = $weekday[$i];
      $timetable[$i]["weekday"] = $day;
      $timetable[$i]["weekday_id"] = $i;
      $j=0;
      foreach($period as $p){
        $period_id = $p->id;
        $timetable[$i]["data"][$j]["period_id"] = $p->id;
        $timetable[$i]["data"][$j]["period_name"] = $p->period_name;
        $timetable[$i]["data"][$j]["start_time"] = $p->start_time;
        $timetable[$i]["data"][$j]["end_time"] = $p->end_time;
        $timetable[$i]["data"][$j]["subject"] = "";
        $timetable[$i]["data"][$j]["staff"] = "";
        $sql = "select a.*,b.subject_name,c.name from timetable a,subject b,users c where a.subject_id=b.id and a.staff_id=c.id and a.school_id=$school_id and a.class_id=$class_id and a.division_id=$division_id and a.period_id=$period_id and a.weekday=$i";
        $result = DB::select(DB::raw($sql));
        foreach($result as $res){
          $timetable[$i]["data"][$j]["subject"] = $res->subject_name;
          $timetable[$i]["data"][$j]["staff"] = $res->name;
        }
        $j++;
      }
    }
    $class_id =  $class_id."~".$division_id;
    return view('students/viewtimetable',compact('class','period','class_id','timetable','subject','staff','class_name'));
  }

  public function savetimetable3(Request $request){
    $school_id = auth()->user()->school_id;
    $class_id = $request->class_id3;
    $division_id = $request->division_id3;
    $weekday = $request->weekday3;
    $sql = "delete from timetable where school_id=$school_id and class_id=$class_id and weekday=6";
    DB::delete(DB::raw($sql));
    $sql = "select * from timetable where school_id=$school_id and class_id=$class_id and weekday=$weekday";
    $result = DB::select(DB::raw($sql));
    foreach ($result as $res) {
      $division_id2 = $res->division_id;
      $period_id   = $res->period_id;
      $subject_id  = $res->subject_id;
      $staff_id    = $res->staff_id;
      $weekday     = 6;
      $sql = "insert into timetable (school_id,class_id,division_id,weekday,period_id,subject_id,staff_id) values ($school_id,$class_id,$division_id2,$weekday,$period_id,$subject_id,$staff_id)";
      DB::insert(DB::raw($sql));
    }
    return redirect("/showtimetable/".$class_id."/".$division_id)->with('success', 'Saturday Timetable Set Successfully');
  }

  public function savetimetable2(Request $request){
    $school_id = auth()->user()->school_id;
    $class_id = $request->class_id2;
    $division_id = $request->division_id;
    $weekday = $request->weekday;
    $period_id = $request->period_id;
    $subject_id = $request->subject_id;
    $staff_id = $request->staff_id;
    $sql = "insert into timetable (school_id,class_id,division_id,weekday,period_id,subject_id,staff_id) values ($school_id,$class_id,$division_id,$weekday,$period_id,$subject_id,$staff_id)";
    DB::insert(DB::raw($sql));
    return redirect("/showtimetable/".$class_id."/".$division_id)->with('success', 'Timetable Added Successfully');
  }

  public function savetimetable(Request $request){
    $school_id = auth()->user()->school_id;
    $class = explode("~",$request->class_id);
    $class_id = $class[0];
    $division_id = $class[1];
    $weekday = $request->weekday;
    $period_id = $request->period_id;
    $subject_id = $request->subject_id;
    $staff_id = $request->staff_id;
    $sql = "select id from timetable where school_id=$school_id and class_id=$class_id and weekday=$weekday and period_id=$period_id";
    $result = DB::select(DB::raw($sql));
    if(count($result) > 0){
      $sql = "delete from timetable where school_id=$school_id and class_id=$class_id and weekday=$weekday and period_id=$period_id";
      DB::delete(DB::raw($sql));
    }
    $sql = "insert into timetable (school_id,class_id,division_id,weekday,period_id,subject_id,staff_id) values ($school_id,$class_id,$division_id,$weekday,$period_id,$subject_id,$staff_id)";
    DB::insert(DB::raw($sql));
    return redirect('/timetable')->with('success', 'Timetable Added Successfully');
  }

  public function deletetimetable($id){
    $school_id = auth()->user()->school_id;
    $sql = "delete from timetable where school_id=$school_id and id=$id";
    DB::insert(DB::raw($sql));
    return redirect('/timetable')->with('success', 'Timetable Deleted Successfully');
  }

  public function updatesub(Request $request){
    $editsubject = DB::table('subject')->where('id',$request->sub_id)->update([
        'subject_name'    =>   $request->class_id,
    ]);
    return redirect()->back()->with('success', 'Subject Updated Successfully');
}

public function updateperiod(Request $request){
    $editsubject = DB::table('period')->where('id',$request->time_id)->update([
        'start_time'  =>   $request->start_time,
        'end_time'    =>   $request->end_time,
    ]);
    return redirect()->back()->with('success', 'Time Updated Successfully');
}

}
