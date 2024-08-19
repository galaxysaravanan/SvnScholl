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
                <li class="nav-item d-none d-sm-inline-block col-md-1">
                    <div class="dropdown">
                        <img src="{{ URL::to('/') }}/dist/img/icon/user.png" style="width:50px"></br>
                        <a class="dropbtn"><label>Subject</label></a>
                        <div class="dropdown-content">
                            <a href="{{ url('/subject') }}">Add Subject</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item d-none d-sm-inline-block col-md-1">
                    <div class="dropdown">
                        <img src="{{ URL::to('/') }}/dist/img/icon/user.png" style="width:50px"></br>
                        <a class="dropbtn"><label>Time Table</label></a>
                        <div class="dropdown-content">
                            <a href="{{ url('/timetable') }}">Time Table</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item d-none d-sm-inline-block col-md-1">
                    <div class="dropdown">
                        <img src="{{ URL::to('/') }}/dist/img/icon/user.png" style="width:50px"></br>
                        <a class="dropbtn"><label>View TimeTable</label></a>
                        <div class="dropdown-content">
                            <a href="{{ url('/viewtimetable') }}">ViewTime Table</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item d-none d-sm-inline-block col-md-1">
                    <div class="dropdown">

                        <img src="{!! asset('dist/img/icon/logout.png') !!}" style="width:50px"></br>
                        <a class="dropbtn"><label>{{ Auth::user()->full_name }}</label></a>
                        <div class="dropdown-content">
                            <a href="{{ url('/logout') }}">Log Out</a>
                        </div>
                    </div>
                </li>
            </ul>
    </nav>
</center>
