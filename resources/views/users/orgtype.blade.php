@extends('layouts.app')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4>Organization Type</h4>
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
                                            <th>Code</th>
                                            <th>Organization Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orgtype as $key => $org)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $org->org_code }}</td>
                                                <td>{{ $org->org_name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
    </section>

    <div class="modal fade" id="editpermission">
        <form action="{{ url('/updateuserpermissions') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="row_id" id="row_id">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="usertypename"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="user_type_name" class="col-sm-4 col-form-label"><span style="color:red"></span>User
                                Type Name</label>
                            <div class="col-sm-8">
                                <input required="required" type="text" class="form-control" name="user_type_name"
                                    id="usertype" maxlength="50" placeholder="User Type Name">
                            </div>
                        </div>
                        <div class="row row-color">
                            <label class="col-sm-4">Dashboard</label>
                        </div>

                        <div class="row row-padded">
                            <label for="dashboard" class="col-sm-2">1</label>
                            <label for="dashboard" class="col-sm-8">Dashboard</label>
                            <label class="col-sm-1"><input value="1" type="checkbox" name="dashboard"
                                    id="dashboard"></label>
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
        function edit_usertype(id, user_type_name, dashboard) {
            $('#dashboard').prop('checked', false);
            $("#row_id").val(id);
            $("#usertype").val(user_type_name);
            if (dashboard == 1) {
                $('#dashboard').prop('checked', true);
            }

            $("#editpermission").modal("show");
        }
    </script>
@endpush
