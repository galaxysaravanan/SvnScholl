@extends('layouts.app')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4>User Types</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissable" style="margin: 15px;">
                                    <a href="#" style="color:white !important" class="close" data-dismiss="alert"
                                        aria-label="close">&times;</a>
                                    <strong> {{ session('success') }} </strong>
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-danger alert-dismissable" style="margin: 15px;">
                                    <a href="#" style="color:white !important" class="close" data-dismiss="alert"
                                        aria-label="close">&times;</a>
                                    <strong> {{ session('error') }} </strong>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S No</th>
                                            <th>User Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($usertypes as $key => $usertypeslist)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $usertypeslist->user_type_name }}</td>
                                                <td>
                                                    <a onclick="edit_usertypeslistnation('{{ $usertypeslist->id  }}','{{ $usertypeslist->user_type_name  }}')"
                                                        href="#" class="btn btn-sm btn-primary"><i
                                                            class="fa fa-edit"></i>Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="modal fade" id="editusertypeslistnation">
                            <form action="{{url('/updateusertype')}}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="userty_row_id" id="usertypeslistnateid">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Update UserType</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                         </div>
                                            <div class="modal-body">
                                               <div class="form-group">
                                                  <label for="user_type_name">UserType Name</label>
                                                  <input type="text" class="form-control" name="user_type_name" id="editdesi" placeholder="">
                                               </div>

                                            </div>
                                            <div class="modal-footer justify-content-between">
                                               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                               <button id="save" type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                         </form>
                                      </div>
                                   </div>
                                </div>
    </section>
@endsection
@push('page_scripts')
    <script>
        function edit_usertypeslistnation(id, user_type_name) {
            $("#usertypeslistnateid").val(id);
            $("#editdesi").val(user_type_name);
            $("#editusertypeslistnation").modal("show");
        }

        function edit_usertype(id, dashboard) {
            $('#dashboard').prop('checked', false);
            $("#row_id").val(id);
            if (dashboard == 1) {
                $('#dashboard').prop('checked', true);
            } else {
                $('#dashboard').prop('checked', false);
            }

            $("#editpermission").modal("show");
        }
    </script>
@endpush
