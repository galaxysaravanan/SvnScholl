@extends('layouts.app')
@section('content')
<style>
	.pu{
		width: 90px;
	}

</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="content-header">
			</div>
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Time Table</h3>
					<div class="row float-right ">
						<div>
							<select required="required" name="class_id" class="form-control select2" id="class_id">
								<option value="">Select Class</option>
								@foreach($class as $clas)
								<option @if($class_id == $clas->id."~".$clas->division_id) selected @endif value="{{ $clas->id }}~{{ $clas->division_id }}">{{ $clas->class_name }} {{ $clas->division_name }}</option>
								@endforeach
							</select>
						</div>
						<div>
							<input type="button" onclick="show_timetable()" value="Show" class="col-sm-12 btn btn-success">
						</div>
					</div>
				</div>
				<div class="card-body">

					@if(count($timetable)>0)
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="btn-success">Class: {{ $class_name }}</th>
									@foreach($period as $p)
									<th>{{ $p->period_name }}</th>
									@endforeach
								</tr>
							</thead>
							<tbody>
								@foreach($timetable as $key => $t)
								@php($weekday_id = $t["weekday_id"])
								<tr>
									<td>@if($weekday_id != 6) {{ $t["weekday"] }} @endif
										@if($weekday_id == 6)
										<a onclick="fn_sat_timetable('{{ $class_id }}')" class="btn btn-primary btn-sm pu">Saturday <i class="fa fa-solid fa-arrow-right"> </i> </a>
										@endif
									</td>
									@foreach($t["data"] as $v)
									@php($period_id = $v["period_id"])
									@if($v['staff'] == "" && $weekday_id != 6)
									<td align="center">
										<a onclick="add_timetable('{{ $class_id }}','{{ $weekday_id }}','{{ $period_id }}')" class="btn btn-primary btn-sm pu"><i class="fa fa-plus"> </i> Add</a>
									</td>
									@else
									<td title="{{ $v['staff'] }}">{{ $v["subject"] }}</td>
									@endif
									@endforeach
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					@endif

					<div class="modal fade" id="addtimetable" tabindex="-1"  aria-hidden="true">
						<form action="{{url('/savetimetable2')}}" method="post">
							{{ csrf_field() }}
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalScrollable">Add Timetable</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="row">
											<div class="col-md-12">
												<input type="hidden" name="class_id2" id="class_id2">
												<input type="hidden" name="division_id" id="division_id">
												<input type="hidden" name="weekday" id="weekday">
												<input type="hidden" name="period_id" id="period_id">
												<div class="form-group row">
													<label for="class_id" class="col-sm-4 col-form-label"><span style="color:red">*</span>Subject</label>
													<div class="col-sm-8">
														<select required="required" name="subject_id" class="form-control" >
															<option value="">Select Subject</option>
															@if(isset($subject))
															@foreach($subject as $s)
															<option value="{{ $s->id }}">{{ $s->subject_name }}</option>
															@endforeach
															@endif
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label for="class_id" class="col-sm-4 col-form-label"><span style="color:red">*</span>Staff</label>
													<div class="col-sm-8">
														<select required="required" name="staff_id" class="form-control" >
															<option value="">Select Staff</option>
															@if(isset($staff))
															@foreach($staff as $s)
															<option value="{{ $s->id }}">{{ $s->name }}</option>
															@endforeach
															@endif
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label for="period_time" class="col-sm-4 col-form-label"><span style="color:red">*</span>Time</label>
													<div class="col-sm-8">
														<input type="time" name="period_time" class="form-control" placeholder="Time"/>
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



	<div class="modal fade" id="sattimetable" tabindex="-1"  aria-hidden="true">
		<form action="{{url('/savetimetable3')}}" method="post">
			{{ csrf_field() }}
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalScrollable">Set Saturday Timetable</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<input type="hidden" name="class_id3" id="class_id3">
								<input type="hidden" name="division_id3" id="division_id3">
								<div class="form-group row">
									<label for="Weekday" class="col-sm-4 col-form-label"><span style="color:red">*</span>Select Weekday</label>
									<div class="col-sm-8">
										<select name="weekday3" id="weekday3" class="custom-select">
											<option value="">Select Weekday</option>
											<option value="1">Monday</option>
											<option value="2">Tuesday</option>
											<option value="3">Wednesday</option>
											<option value="4">Thursday</option>
											<option value="5">Friday</option>
										</select>
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
		@endsection

		@push('page_scripts')
		<script>

			function show_timetable(){
				var url = "{{ url('showtimetable') }}";
				class_division__id = $("#class_id").val();
				if(class_division__id == ""){
					alert("select Class");
					$("#class_id").focus();
				}else{
					class_division__id = class_division__id.split("~");
					class_id = class_division__id[0];
					division_id = class_division__id[1];
					url = url + "/" + class_id + "/" +division_id;
					window.location.href = url;
				}
			}

			function fn_sat_timetable(class_division__id){
				class_division__id = class_division__id.split("~");
				class_id = class_division__id[0];
				division_id = class_division__id[1];
				$("#class_id3").val(class_id);
				$("#division_id3").val(division_id);
				$("#sattimetable").modal("show");
			}

			function add_timetable(class_division__id,weekday_id,period_id){
				class_division__id = class_division__id.split("~");
				class_id = class_division__id[0];
				division_id = class_division__id[1];
				$("#class_id2").val(class_id);
				$("#division_id").val(division_id);
				$("#weekday").val(weekday_id);
				$("#period_id").val(period_id);
				$("#addtimetable").modal("show");
			}

		</script>
		@endpush
