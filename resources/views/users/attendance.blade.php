@extends('layout')
@section('content')
<br>
   <section class="content">
    <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
				
                  <div class="col-sm-3">
 <input value="{{ $id }}" type="hidden" class="form-control" name="wallet">
<input type="date" class="form-control" name="from" id="from" value="{{ $from }}">
                  </div>
                  <div class="col-sm-3">
<input type="date" class="form-control" name="to" id="to" value="{{ $to }}">
                  </div> 
                  <div class="col-sm-1">
<input id="btntop" type="button" onclick="load_report()" value="Show" class="btn-xs">
                    </div>
                     <div class="col-sm-4">
                        <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Customer Full Name">
                    </div>
                    <div class="col-sm-1">
<button type="button" class="btn btn-block btn-outline-danger btn-xs" data-toggle="modal" data-target="#adduser"><i class="fa fa-plus"> </i> Add</button>

                    </div>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                     <table id="example1" class="table table-bordered table-hover">
<thead>
<tr>
                    <th>#</th>
                    <th>UserId</th>
                    <th>Full Name</th>
                    <th>Date</th>
                    <th>In Time</th>
                    <th>Out Time</th>
                    <th>Actions</th>
</tr>
</thead>
<tbody>
 @foreach($attendance as $key=>$attendancelist)
                      <tr id="arrayorder_<?php echo $attendancelist->userID?>">
                        <td>{{ $key + 1 }}</td>
                        <td>U{{ $attendancelist->id }}</td>
                        <td>{{ $attendancelist->full_name }}</td>
                        <td>{{ $attendancelist->date }}</td>
                        <td>{{ $attendancelist->in_time }}</td>
                        <td>{{ $attendancelist->out_time}}</td>
                         <td>
<a href="{{url('/users/attendance/'.$attendancelist->userID)}}" class="btn btn-default fa fa-eye" > Attendance</a>
                        </td>
                         </tr>

                      @endforeach

</tbody>
</table>
                  </div>
                </div>
              </div>

  
    
              <!-- /.card -->
            </div>
          </div>
    </section>
    <!-- /.content -->
 

  </div>
@endsection
    <script>
        var wallet = "{{ url('user/attendance') }}";

        function load_report() {
            var id = $("#id").val();
            var from = $("#from").val();
            var to = $("#to").val();
            if (id == "") {
                alert("Please select id Date");
            } else if (from == "") {
                alert("Please select from Date");
            } else if (to == "") {
                alert("Please select To Date");
            } else {
                var url = wallet + "/" + id + "/" + from + "/" + to;
                window.location.href = url;
            }
        }
		
function myFunction() {
  const input = document.getElementById("myInput");
  const inputStr = input.value.toUpperCase();
  document.querySelectorAll('#example2 tr:not(.header)').forEach((tr) => {
    const anyMatch = [...tr.children]
      .some(td => td.textContent.toUpperCase().includes(inputStr));
    if (anyMatch) tr.style.removeProperty('display');
    else tr.style.display = 'none';
  });
}
</script>
