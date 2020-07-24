<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>پنل مدیریت</title>
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/admin.css') }}" rel="stylesheet">
    <link href="{{ url('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    @yield('header')
</head>

<body>

<div id="wrapper">


    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">

            <div class="navbar_header_div">
                <a class="navbar-brand" href="{{ url('admin') }}">پنل مدیریت</a>


                <div class="div_header_bars" id="sidebarToggle">
                    <span class="fa fa-bars"></span>
                </div>
            </div>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <ul class="dropdown-menu dropdown-messages">
                    <li>
                        <a href="#">
                            <div>
                                <strong>John Smith</strong>
                                <span class="pull-right text-muted">
                                    <em>Yesterday</em>
                                </span>
                            </div>
                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <strong>John Smith</strong>
                                <span class="pull-right text-muted">
                                    <em>Yesterday</em>
                                </span>
                            </div>
                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <strong>John Smith</strong>
                                <span class="pull-right text-muted">
                                    <em>Yesterday</em>
                                </span>
                            </div>
                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>Read All Messages</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-messages -->
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                <span class="pull-right text-muted small">12 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> Message Sent
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-tasks fa-fw"></i> New Task
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-alerts -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->
    </nav>

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">

            <ul class="nav" id="side-menu">

                <li>
                    <a href=""><i class="fa fa-dashboard fa-fw"></i>
                        داشبورد
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fa fa-area-chart"></i>
                        <span class="li_span"> آمار درآمد اپلیکیشن</span>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="">ارسال اعلان جدید</a>
                        </li>

                    </ul>
                    <!-- /.nav-second-level -->
                </li>

                <li>
                    <a href="#" class="nav-link">
                        <i class="fa fa-hand-o-right"></i>

                        <span class="li_span">
                        مدیریت سرویس ها
                        </span>

                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ url('admin/service') }}">سرویس های در حال انجام</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/service/final') }}">سرویس های انجام شده</a>
                        </li>

                        <li>
                            <a href="{{ url('admin/service/canceled') }}">سرویس های لغو شده</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>


                <li>
                    <a href="#" class="nav-link">
                        <i class="fa fa-location-arrow"></i>

                        <span class="li_span">
                        مدیریت مناطق
                        </span>

                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ url('admin/location') }}">مدیریت مناطق</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/location/create') }}">افزودن منطقه جدید</a>
                        </li>

                    </ul>
                    <!-- /.nav-second-level -->
                </li>

                <li>
                    <a href="index.html"><i class="fa fa-user"></i>
                        <span class="li_span">
                        مدیریت کاربران
                        </span>
                    </a>
                </li>


                <li>
                    <a href="#"><i class="fa fa-users"></i>
                        <span class="li_span">
                        مدیریت راننده ها
                        </span>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ url('admin/driver/create') }}">افزودن راننده جدید</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/driver') }}">لیست راننده ها</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>


                <li>
                    <a href="{{ url('admin/map') }}"><i class="fa fa-map-marker"></i>
                        <span class="li_span">
                        نمایش نقشه آنلاین
                        </span>
                    </a>
                </li>


                <li>
                    <a href="#"><i class="fa fa-bell-o"></i>
                        <span class="li_span">
                        مدیریت اعلان ها
                        </span>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ url('admin/notification/create') }}">ارسال اعلان جدید</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/notification') }}">مدیریت اعلان ها</a>
                        </li>
                    </ul>

                </li>




                <li>
                    <a href="#"><i class="fa fa-cogs"></i>
                        <span class="li_span">
                        تنظیمات
                        </span>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ url('admin/setting/location/price') }}">
                                تعیین هزینه سفرها
                            </a>
                        </li>
                        <li>
                            <a href="">
                                تعیین هزینه تاخیر های سفر
                            </a>
                        </li>

                        <li>
                            <a href="">
                                محدوده های سرویس دهی
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('admin/profile') }}">
                                تغییر پروفایل کاربری
                            </a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>


    </div>

    <div class="content">
        @yield('content')
    </div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="{{ url('js/jquery.min.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ url('js/bootstrap.min.js') }}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{ url('js/metisMenu.min.js')}}"></script>

<script src="{{ url('js/admin.js')}}"></script>

@yield('footer')


<script>
    $("#sidebarToggle").click(function ()
    {
        if($("div").hasClass("toggled"))
        {
            $(".sidebar").removeClass("toggled");
            $(".content").css('margin-right','260px');
            $(".navbar_header_div").css('width','250px');
            $('.navbar-brand').show();
            $(".div_header_bars").css('float','left');
            $(".div_header_bars").css('margin-left','20px');
        }
        else
        {
            $(".sidebar").addClass("toggled");
            $(".content").css('margin-right','150px');
            $(".navbar_header_div").css('width','150px');
            $('.navbar-brand').hide();
            $(".div_header_bars").css('float','none');
            $(".div_header_bars").css('text-align','center');
            $(".div_header_bars").css('margin','0px');
            //$('.nav-second-level').addClass('dropdown-menu');
        }


    });

    $( document ).ready(function() {
        var url = window.location;
        $('ul.nav a[href="' + url + '"]')
            .addClass('active')
            .parent()
            .parent()
            .addClass('in')
            .parent()
            .addClass('active');
    });

</script>

</body>

</html>
