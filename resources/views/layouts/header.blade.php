<?php
$permission = DB::table('users')
    ->where('id', auth()->user()->id)
    ->first();
?>
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{!! asset('dist/img/healthcare.png') !!}" alt="HC" height="60" width="60">
</div>
<center>
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <!-- Left navbar links -->
        <legend class="scheduler-border">
            <ul class="navbar-nav">
                <div>
                    <div class="row">
                        <a href="#" class="navbar-toggler order-1">
                            <center>
                                <img src="{!! asset('dist/img/h.png') !!}" alt="HealthCar Logo">
                            </center>
                        </a>

                        <li class="navbar-toggler order-1">
                            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                    class="fas fa-bars"></i></a>
                        </li>
                    </div>
                </div>
                <li class="nav-item d-none d-sm-inline-block col-md-1">
                    <a href="{{ url('/dashboard') }}">
                        <img src="{{ URL::to('/') }}/dist/img/icon/opd.png" style="width:50px"></br>


                        <label>Dashboard</label>
                    </a>
                </li>
                @if (Auth::user()->user_type_id == 1)
                    <li class="nav-item d-none d-sm-inline-block col-md-1">
                        <div class="dropdown">
                            <img src="{{ URL::to('/') }}/dist/img/icon/user.png" style="width:50px"></br>
                            <a class="dropbtn"><label>Staffs</label></a>
                            <div class="dropdown-content">
                                <a href="{{ url('/staf') }}">Staffs</a>
                                @if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2 || Auth::user()->user_type_id == 3)
                                    <a href="{{ url('/usertypes') }}">User Type</a>
                                @endif
                            </div>
                        </div>
                    </li>
                @endif
                <li class="nav-item d-none d-sm-inline-block col-md-1">
                    <div class="dropdown">
                        <img src="{{ URL::to('/') }}/dist/img/icon/user.png" style="width:50px"></br>
                        <a class="dropbtn"><label>Students</label></a>
                        <div class="dropdown-content">
                            <a href="{{ url('/students') }}">Students</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item d-none d-sm-inline-block col-md-1">
                    <div class="dropdown">

                        <img src="{!! asset('dist/img/icon/setting.png') !!}" style="width:50px"></br>
                        <a href="">
                            <a class="dropbtn">
                                <label>Setting</label></a>
                            <div class="dropdown-content">
                                @if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2 || Auth::user()->user_type_id == 3)
                                    <a href="{{ url('/districts') }}">Districts</a>
                                @endif
                            </div>
                    </div>
                    </a>
                </li>

                <li class="nav-item d-none d-sm-inline-block col-md-1">
                    <div class="dropdown">

                        <img src="{!! asset('dist/img/icon/logout.png') !!}" style="width:50px"></br>
                        <a class="dropbtn"><label>{{ Auth::user()->full_name }}</label></a>
                        <div class="dropdown-content">
                            <a href="{{ url('/profile') }}"> My Profile</a>
                            @if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2 || Auth::user()->user_type_id == 3)
                                <a href="">Backup</a>
                            @endif
                            <a href="{{ url('/changepassword') }}">Change Password</a>
                            <a href="{{ url('/logout') }}">Log Out</a>
                        </div>
                    </div>
                </li>
            </ul>
    </nav>
</center>
