@extends('layout')
@section('content')

<!-- /.content -->
<section class="content">
   <div class="content-wrapper">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body"> 
                <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
                <div id="accordion">  
                  <div class="card card-olive">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                      <div class="col-sm-1 float-right">
                     <td>
                     <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#adduser"><i class="fa fa-plus"> </i> Add</button>
                     </td>
                     </div>
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse1">   
                     Personal Details
                        </a>
                      </h4>
                    </div>

                    <div id="collapse1" class="collapse show" data-parent="#accordion">
                    <form action="{{url('/edit_user')}}" method="post">
                              {{ csrf_field() }}
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                     </ul>
                          <div class="card-body">       
                          <div class="row">
                          <div class="col-md-4">   

         <input type="hidden" value="{{ $managenonteaching->userID}}" class="form-control mb-3" name="id" placeholder="First Name"/>

                          <input type="text" value="{{ $managenonteaching->first_name }}" class="form-control mb-3" name="first_name" placeholder="First Name"/>

                          <input type="text" value="{{$managenonteaching->mobile}}" class="form-control mb-3" name="mobile" 
                          placeholder="Mobile Number"/>

                          <input type="text" value="{{$managenonteaching->age}}" class="form-control mb-3" name="age" id="resultBday" placeholder="Age"/>

                          <input type="text" value="{{$managenonteaching->mother_tongue}}" class="form-control mb-3" name="mother_tongue" placeholder="Mother Tong"/>

                          <input type="text" value="{{$managenonteaching->comunity}}" class="form-control mb-3" name="comunity" placeholder="Comunity"/>
               
                          <span id="dupemail" style="color:red;font-size: 12px;"></span>

                 <input onkeyup="duplicateEmail(0)" value="{{$managenonteaching->email}}" id="email" type="email" class="form-control mb-3" name="email" placeholder="Email"/>

                          <input type="text" value="{{$managenonteaching->religion}}" class="form-control mb-3" name="religion" placeholder="Religion"/>

                          
                     </div>

                    <div class="col-md-4">   

                          <input type="text" value="{{$managenonteaching->last_name}}" class="form-control mb-3" name="last_name" placeholder="Last Name"/>

                          <input type="text" value="{{$managenonteaching->whats_up}}" class="form-control mb-3" name="whats_up" placeholder="WhatsUp Number"/>

                          <input type="text" value="{{$managenonteaching->place_of_birth}}" class="form-control mb-3" name="place_of_birth" placeholder="Place Of Birth"/>

                          <input type="text" value="{{$managenonteaching->adhaar}}" class="form-control mb-3" name="adhaar" placeholder="Ahaddar"/>

                          <input type="text" value="{{$managenonteaching->language_known}}" class="form-control mb-3" name="language_known" placeholder="Language Known"/>

                          <input type="text" value="{{$managenonteaching->nationalty}}" class="form-control mb-3" name="nationalty" placeholder="Nationalty"/>

                          <span id="dupemail" style="color:red;font-size: 12px;"></span>

                        
                          
                          <select class="form-control mb-3" required="required" name="gender">
                            <option>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>  


                    </div>
                    
                    <div class="col-md-4">   

                      <input type="text" value="{{$managenonteaching->father_name}}" class="form-control mb-3" name="father_name" placeholder="Father Name"/>
                      
                      <input type="date" value="{{$managenonteaching->date_of_birth}}" class="form-control mb-3" name="date_of_birth" id="bday" onchange="submitBday()">

                      <input type="text" value="{{$managenonteaching->pan_no}}" class="form-control mb-3" name="pan_no" placeholder="PAN"/>

                      <input type="text" value="{{$managenonteaching->blood_group}}" class="form-control mb-3" name="blood_group" placeholder="Blood Group"/>

                      <input type="text" value="{{$managenonteaching->hobbies}}" class="form-control mb-3" name="hobbies" placeholder="Hobbies"/>

                      <input type="text" value="{{$managenonteaching->pin_code}}" class="form-control mb-3" name="pin_code" placeholder="Pin Code"/>

                      <textarea name='address' value="{{$managenonteaching->address}}" class="form-control" rows="3" placeholder="Enter Address..." ></textarea>
                      
                  </div>      
              </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" id="save" class="btn btn-primary">Submit</button>
         </div>
                       </div>                        
                      </div>
                    </div>
</form>

                    <div id="accordion">
                  <div class="card card-purple">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                      <div class="col-sm-1 float-right">
                     <td>
                     <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#adduser"><i class="fa fa-plus"> </i> Add</button>
                     </td>
                     </div>
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse2">
                  Family Paticulars
                        </a>
                      </h4>
                    </div>
                    <div id="collapse2" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                      <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
                  </div>

				  
                  <div id="accordion">
                  <div class="card card-olive">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                      <div class="col-sm-1 float-right">
                     <td>
                     <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#adduser"><i class="fa fa-plus"> </i> Add</button>
                     </td>
                     </div>
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse3">
                  Education Details
                        </a>
                      </h4>
                    </div>
                    <div id="collapse3" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                      <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
                  </div>
				  
                   <div id="accordion">
                  <div class="card card-purple">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                      <div class="col-sm-1 float-right">
                     <td>
                     <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#adduser"><i class="fa fa-plus"> </i> Add</button>
                     </td>
                     </div>
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse4">
                  Academic Details
                        </a>
                      </h4>
                    </div>
                    <div id="collapse4" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                      <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                      </div>
                    </div>
                  </div>

                  <div id="accordian">
                  <div class="card card-olive">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse5">
                    Arrear Details
                        </a>
                      </h4>
                    </div>
                    <div id="collapse5" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                        <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
                    </div>
                     

                     <div id="accordion">
                  <div class="card card-purple">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse6">
                          Awards
                        </a>
                      </h4>
                    </div>
                    <div id="collapse6" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                      <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
</div>

                  <div id="accordion">
                  <div class="card card-olive">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse7">
                        Participation In Workshop/Seminar/Symposium/Conference
                        </a>
                      </h4>
                    </div>
                    <div id="collapse7" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                      <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
</div>

                  <div id="accordion">
                  <div class="card card-purple">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse8">
                        Papers Publised In Conference/Symposium
                        </a>
                      </h4>
                    </div>
                    <div id="collapse8" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                      <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
</div>

                  <div id="accordion">
                  <div class="card card-olive">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse9">
                        Papers Published In Journal
                        </a>
                      </h4>
                    </div>
                    <div id="collapse9" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                      <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
</div>
                 
                  <div id="accordion">
                  <div class="card card-purple">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse10">
                       Computer Courses Completed
                        </a>
                      </h4>
                    </div>
                    <div id="collapse10" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                      <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
                  </div>

                  <div id="accordian">
                  <div class="card card-olive">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse11">
                          Placement Training Undertaken
                        </a>
                      </h4>
                    </div>
                    <div id="collapse11" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                      <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
                  </div>

                  <div id="accordian">
                  <div class="card card-purple">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse12">
                         Placement Details
                        </a>
                      </h4>
                    </div>
                    <div id="collapse12" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                      <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
                  </div>

                  <div id="accordion">
                  <div class="card card-olive">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse13">
                       Computer Language Known
                        </a>
                      </h4>
                    </div>
                    <div id="collapse13" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                      <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
                  </div>


                  <div id="accordion">
                  <div class="card card-purple">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse14">
                       Inplant Training / Internship
                        </a>
                      </h4>
                    </div>
                    <div id="collapse14" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                          <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
                  </div>

                  <div id="accordian">
                  <div class="card card-olive">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse15">
                          Club Activaties
                        </a>
                      </h4>
                    </div>
                    <div id="collapse15" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                      <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
                  </div>

                  <div id="accordian">
                  <div class="card card-purple">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse16">
                          Mini Project / Project Phase1
                        </a>
                      </h4>
                    </div>
                    <div id="collapse16" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                      <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
                  </div>

                  <div id="accordian">
                  <div class="card card-olive">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse17">
                         Main Project / Project Phase2
                        </a>
                      </h4>
                    </div>
                    <div id="collapse17" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                      <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
                  </div>

                  <div id="accordian">
                  <div class="card card-purple">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse18">
                          Extra Curricular Activaties-Arts Events(Price Winning Event)
                        </a>
                      </h4>
                    </div>
                    <div id="collapse18" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                      <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
                  </div>

                  <div id="accordion">
                  <div class="card card-olive">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse19">
                       Sports/Games(Game Winning Event)
                        </a>
                      </h4>
                    </div>
                    <div id="collapse19" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                      <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
                  </div>

                  <div id="accordion">
                  <div class="card card-purple">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse20">
                        Wheather Hosteller:Yes/No     If Hosteller Room No:
                        </a>
                      </h4>
                    </div>
                    <div id="collapse20" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                      <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
                  </div>

                  <div id="acordian">
                  <div class="card card-olive">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse21">
                          Prizes Receiveed In Paper Presentation/Project Contest/Model Presentation/Quiz/Circuit Debugging Etc
                        </a>
                      </h4>
                    </div>
                    <div id="collapse21" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                      <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
                  </div>

                  <div id="accordian">
                  <div class="card card-purple">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse22">
                         Industrial Visit
                        </a>
                      </h4>
                    </div>
                    <div id="collapse22" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                      <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
                  </div>

                  <div id="accordian">
                  <div class="card card-olive">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse23">
                         Scholarship Deatails
                        </a>
                      </h4>
                    </div>
                    <div id="collapse23" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                      <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
                  </div>

                  <div id="accordian">
                  <div class="card card-purple">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse24">
                          Updation Details(End Of Every Semester)
                        </a>
                      </h4>
                    </div>
                    <div id="collapse24" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                      <div class="row">
                     <div class="col-md-6">   
                                  
   <input value="{{ $managenonteaching->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                       <input value="{{ $managenonteaching->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managenonteaching->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managenonteaching->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managenonteaching->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managenonteaching->mobile }}" type="text" class="form-control mb-3" name="mobile" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managenonteaching->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managenonteaching->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managenonteaching->address }}</textarea>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal fade" id="adduser">
    <form action="{{url('/add_user')}}" method="post" enctype="multipart/from-data">
        {{ csrf_field() }}
        <div id="collapse1" class="collapse show" data-parent="#accordion">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Users</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">   

                          <input type="text"  class="form-control mb-3" name="first_name" placeholder="First Name"/>

                          <input type="text"  class="form-control mb-3" name="mobile" placeholder="Mobile Number"/>

                          <input type="text"  class="form-control mb-3" name="age" id="resultBday" placeholder="Age"/>

                          <input type="text"  class="form-control mb-3" name="place_of_birth" placeholder="Place Of Birth"/>

                          <input type="text" class="form-control mb-3" name="mother_tongue" placeholder="Mother Tong"/>

                          <input type="text"  class="form-control mb-3" name="comunity" placeholder="Comunity"/>
               
                          <span id="dupemail" style="color:red;font-size: 12px;"></span>

                 <input onkeyup="duplicateEmail(0)" id="email" type="email" class="form-control mb-3" name="email" placeholder="Email"/>

                          <input type="text"  class="form-control mb-3" name="religion" placeholder="Religion"/>

                        
                     </div>

                    <div class="col-md-4">   

                          <input type="text"  class="form-control mb-3" name="last_name" placeholder="Last Name"/>

                          <input type="text"  class="form-control mb-3" name="whats_up" placeholder="Whats Up Number"/>

                          <input type="text"  class="form-control mb-3" name="adhaar" placeholder="Ahaddar"/>

                          <input type="text"  class="form-control mb-3" name="language_known" placeholder="Language Known"/>

                          <input type="text"  class="form-control mb-3" name="nationalty" placeholder="Nationalty"/>

                          <span id="dupemail" style="color:red;font-size: 12px;"></span>

                          <input type="password"  class="form-control mb-3" name="password" placeholder="Password"/>
                          
                          <select  class="form-control mb-3" name="gender">
                            <option>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>  

                        <input type="file"  class="form-control mb-3" name="profile_photo" placeholder=""/>

                    </div>
                    
                    <div class="col-md-4">   

                      <input type="text"  class="form-control mb-3" name="father_name" placeholder="Father Name"/>
                      
                      <input type="date"  class="form-control mb-3" name="date_of_birth" id="bday" onchange="submitBday()">

                      <input type="text" class="form-control mb-3" name="pan_no" placeholder="PAN"/>

                      <input type="text"  class="form-control mb-3" name="blood_group" placeholder="Blood Group"/>

                      <input type="text" class="form-control mb-3" name="hobbies" placeholder="Hobbies"/>

                      <input type="text"  class="form-control mb-3" name="check_password" placeholder="Conform Password"/>

                      <input type="text"  class="form-control mb-3" name="pin_code" placeholder="Pin Code"/>

                      <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." ></textarea>
                  </div>      
              </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" id="save" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>
</div>
              
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
   </section>
</div>
          <!-- /.col -->
@endsection
