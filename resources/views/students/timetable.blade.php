@extends('layouts.app')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="content-header">
      </div>
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Time Table</h3>
          <button type="button" class="btn btn-sm btn-secondary float-right" data-toggle="modal" data-target="#addclass"><i class="fa fa-plus"> </i> Add Timetable</button>
        </div>
        <div class="card-body">
          @if(session()->has('success'))
          <div class="alert alert-success alert-dismissable" style="margin: 15px;">
            <a href="#" style="color:white !important" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong> {{ session('success') }} </strong>
          </div>
          @endif
          @if(session()->has('error'))
          <div class="alert alert-error alert-dismissable" style="margin: 15px;">
            <a href="#" style="color:white !important" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong> {{ session('error') }} </strong>
          </div>
          @endif
          <div class="table-responsive">
            <table id="example2" class="table table-bordered">
              <thead>
                <tr>
                  <th>Class</th>
                  <th>Weekday</th>
                  <th>Period</th>
                  <th>Subject</th>
                  <th>Staff</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($timetable as $t)
                <tr>
                  <td>{{ $t->class_name }}{{ $t->division_name }}</td>
                  <td>{{ $weekday[$t->weekday] }}</td>
                  <td>{{ $t->period_name }}</td>
                  <td>{{ $t->subject_name }}</td>
                  <td>{{ $t->name }}</td>
                  <td width="10" style="white-space: nowrap">
                    <a onclick="return confirm('Do you want to confirm delete operation?')"  href="{{ url('/deletetimetable') }}/{{ $t->id }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="modal fade" id="addclass">
            <form action="{{url('/savetimetable')}}" method="post">
              {{ csrf_field() }}
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Add Timetable</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                         <label for="class" class="col-sm-4 col-form-label"><span style="color:red">*</span>Class</label>
                         <div class="col-sm-8">
                          <select name="class_id" class="form-control" id="class">
                           <option value="">Select Class</option>
                           @foreach($class as $clas)
                           <option value="{{ $clas->id }} ~ {{ $clas->division_id }}">{{ $clas->class_name }} {{ $clas->division_name }}</option>
                           @endforeach
                         </select>
                       </div>
                     </div>

                     <div class="form-group row">
                       <label for="subject" class="col-sm-4 col-form-label"><span style="color:red">*</span>Subject Name</label>
                       <div class="col-sm-8">
                        <select name="subject_id" class="form-control" id="subject">
                          <option value="">Select Subject</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Weekday" class="col-sm-4 col-form-label"><span style="color:red">*</span>Weekday</label>
                      <div class="col-sm-8">
                       <select name="weekday" id="weekday" class="custom-select">
                         <option value="">Select Weekday</option>
                         <option value="1">Monday</option>
                         <option value="2">Tuesday</option>
                         <option value="3">Wednesday</option>
                         <option value="4">Thursday</option>
                         <option value="5">Friday</option>
                       </select>
                     </div>
                   </div>
                   <div class="form-group row">
                     <label for="name" class="col-sm-4 col-form-label"><span style="color:red">*</span>Period</label>
                     <div class="col-sm-8">
                      <select name="period_id" class="form-control" id="period">
                        <option value="">Select Period</option>
                        @foreach($period as $per)
                        <option value="{{ $per->id }}">{{ $per->period_name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="staff" class="col-sm-4 col-form-label"><span style="color:red">*</span>Staff</label>
                    <div class="col-sm-8">
                     <select name="staff_id" id="staff" class="custom-select">
                       <option value="">Select Staff</option>
                     </select>
                   </div>
                 </div>
               </div>
             </div>
           </div>
           <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input class="btn btn-primary" type="submit" value="Submit" />
          </div>
        </div>
      </div>
    </form>
  </div>


</div>
</div>
</div>
</div>
</div>
@endsection
@push('page_scripts')
<script>
  $('#class').on('change', function () {
    var class_id = this.value;
    $("#subject").html('');
    $.ajax({
      url: "{{url('/getsubject')}}",
      type: "POST",
      data: {
        class_id: class_id,
        _token: '{{csrf_token()}}'
      },
      dataType: 'json',
      success: function (result) {
        $('#subject').html('<option value="">Select Subject</option>');
        $.each(result, function (key, value) {
          $("#subject").append('<option value="' + value
            .id + '">' + value.subject_name + '</option>');
        });
      }
    });
  });
  $('#weekday').on('change', function (){
    load_staff();
  });
  $('#period').on('change', function (){
    load_staff();
  });
  function load_staff(){
    var weekday = $('#weekday').val();
    var period = $('#period').val();
    if(weekday != "" && period != ""){
      $("#staff").html('');
      $.ajax({
        url: "{{url('/getstaff')}}",
        type: "POST",
        data: {
          weekday: weekday,
          period : period,
          _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (result) {
          $('#staff').html('<option value="">Select Staff</option>');
          $.each(result, function (key, value) {
            $("#staff").append('<option value="' + value
              .id + '">' + value.name + '</option>');
          });
        }
      });
    }
  }
</script>
@endpush
