<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }} | Admin Panel</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/plugins/datatables/dataTables.bootstrap.css') }}"/>

        <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/plugins/iCheck/flat/blue.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/plugins/datepicker/datepicker3.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/plugins/daterangepicker/daterangepicker.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/plugins/timepicker/bootstrap-timepicker.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/plugins/iCheck/all.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/plugins/select2/select2.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/AdminLTE.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/skins/_all-skins.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/custom.css') }}"/>

        <link href="{{ URL::to('/') }}/favicon.png" type="image/x-icon" rel="icon"/>
        <link href="{{ URL::to('/') }}/favicon.png" type="image/x-icon" rel="shortcut icon"/>

        <script type="text/javascript" src="{{ asset('js/backend/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/backend/jquery-ui.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/backend/bootstrap/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/backend/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/backend/moment.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/backend/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/backend/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/backend/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/backend/plugins/fastclick/fastclick.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/backend/plugins/input-mask/jquery.inputmask.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/backend/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/backend/plugins/iCheck/icheck.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/backend/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/backend/plugins/select2/select2.full.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/backend/app.min.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"/>

        @yield('header')
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="fixed hold-transition skin-green sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->

                <a href="{{ route('admin.dashboard') }}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>STT</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>StoreeTree Admin</b> Panel</span>
                </a>


                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->

                            <!-- Notifications: style can be found in dropdown.less -->

                            <!-- Tasks: style can be found in dropdown.less -->

                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img
                                        src="{{ URL::to('/') }}/images/User-Avatar.png" class="user-image"
                                        alt="User Image"> <span class="hidden-xs">{{ $authuser->name }}</span> </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header"><img
                                            src="{{ URL::to('/') }}/images/User-Avatar.png"
                                            class="img-circle" alt="User Image">
                                        <p> {{ $authuser->name }}</p>
                                    </li>
                                    <!-- Menu Body -->

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="{{ route('admin.editPassword') }}"
                                               class="btn btn-default btn-flat">Change Password</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat" onclick="">Sign out</a>

                                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>

                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="treeview {{ Helper::menuIsActive([ 'admin.admins.create', 'admin.admins.index', 'admin.admins.edit', 'admin.admins.resetPassword']) }}">
                            <a href="#">
                                <i class="fa fa-user-secret"></i> <span>Admins</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="{{ Helper::menuIsActive(['admin.admins.create']) }}">
                                    <a href="{{ route('admin.admins.create') }}"><i class="fa fa-plus-square"></i> New Admin</a>
                                </li>
                                <li class="{{ Helper::menuIsActive(['admin.admins.index']) }}">
                                    <a href="{{ route('admin.admins.index') }}"><i class="fa fa-list"></i>Admin List</a>
                                </li>
                            </ul>
                        </li>

                        <li class="treeview {{ Helper::menuIsActive([ 'admin.blogs.create', 'admin.blogs.index', 'admin.blogs.edit', 'admin.blogs.show']) }}">
                            <a href="#">
                                <i class="fa fa-newspaper-o"></i> <span>Blogs</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="{{ Helper::menuIsActive(['admin.blogs.create']) }}">
                                    <a href="{{ route('admin.blogs.create') }}"><i class="fa fa-plus-square"></i> New Blog</a>
                                </li>
                                <li class="{{ Helper::menuIsActive(['admin.blogs.index']) }}">
                                    <a href="{{ route('admin.blogs.index') }}"><i class="fa fa-list"></i>Blog List</a>
                                </li>
                            </ul>
                        </li>

                        <li class="treeview {{ Helper::menuIsActive([ 'admin.categories.create', 'admin.categories.index', 'admin.categories.edit']) }}">
                            <a href="#">
                                <i class="fa fa-list-alt"></i> <span>Categories</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="{{ Helper::menuIsActive(['admin.categories.create']) }}">
                                    <a href="{{ route('admin.categories.create') }}"><i class="fa fa-plus-square"></i> New Category</a>
                                </li>
                                <li class="{{ Helper::menuIsActive(['admin.categories.index']) }}">
                                    <a href="{{ route('admin.categories.index') }}"><i class="fa fa-list"></i>Category List</a>
                                </li>
                            </ul>
                        </li>

                        <li class="treeview {{ Helper::menuIsActive([ 'admin.contacts.index']) }}">
                            <a href="{{ route('admin.contacts.index') }}">
                                <i class="fa fa-address-book"></i> <span>Contact Us</span>
                            </a>
                        </li>

                        <li class="treeview {{ Helper::menuIsActive([ 'admin.faqs.create', 'admin.faqs.index', 'admin.faqs.edit', 'admin.faqs.show']) }}">
                            <a href="#">
                                <i class="fa fa-reply"></i> <span>Faqs</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="{{ Helper::menuIsActive(['admin.faqs.create']) }}">
                                    <a href="{{ route('admin.faqs.create') }}"><i class="fa fa-plus-square"></i> New Faq</a>
                                </li>
                                <li class="{{ Helper::menuIsActive(['admin.faqs.index']) }}">
                                    <a href="{{ route('admin.faqs.index') }}"><i class="fa fa-list"></i>Faq List</a>
                                </li>
                            </ul>
                        </li>

<!--                        <li class="treeview {{ Helper::menuIsActive([ 'admin.relations.create', 'admin.relations.index', 'admin.relations.edit']) }}">
                            <a href="#">
                                <i class="fa fa-link"></i> <span>Relations</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="{{ Helper::menuIsActive(['admin.relations.create']) }}">
                                    <a href="{{ route('admin.relations.create') }}"><i class="fa fa-plus-square"></i> New Relation</a>
                                </li>
                                <li class="{{ Helper::menuIsActive(['admin.relations.index']) }}">
                                    <a href="{{ route('admin.relations.index') }}"><i class="fa fa-list"></i>Relation List</a>
                                </li>
                            </ul>
                        </li>-->

                        <li class="treeview {{ Helper::menuIsActive([ 'admin.questions.create', 'admin.questions.index', 'admin.questions.edit']) }}">
                            <a href="#">
                                <i class="fa fa-question"></i> <span>Questions</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="{{ Helper::menuIsActive(['admin.questions.create']) }}">
                                    <a href="{{ route('admin.questions.create') }}"><i class="fa fa-plus-square"></i> New Question</a>
                                </li>
                                <li class="{{ Helper::menuIsActive(['admin.questions.index']) }}">
                                    <a href="{{ route('admin.questions.index') }}"><i class="fa fa-list"></i>Question List</a>
                                </li>
                            </ul>
                        </li>

                        <li class="treeview {{ Helper::menuIsActive([ 'admin.settings.index']) }}">
                            <a href="{{ route('admin.settings.index') }}">
                                <i class="fa fa-cog"></i> <span>Settings</span>
                            </a>
                        </li>

                        <li class="treeview {{ Helper::menuIsActive([ 'admin.users.index']) }}">
                            <a href="{{ route('admin.users.index') }}">
                                <i class="fa fa-users"></i> <span>Users</span>
                            </a>
                        </li>

                        <li class="treeview {{ Helper::menuIsActive([ 'admin.warmups.create', 'admin.warmups.index', 'admin.warmups.edit']) }}">
                            <a href="#">
                                <i class="fa fa-tags"></i> <span>Warmups</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="{{ Helper::menuIsActive(['admin.warmups.create']) }}">
                                    <a href="{{ route('admin.warmups.create') }}"><i class="fa fa-plus-square"></i> New Warmup</a>
                                </li>
                                <li class="{{ Helper::menuIsActive(['admin.warmups.index']) }}">
                                    <a href="{{ route('admin.warmups.index') }}"><i class="fa fa-list"></i>Warmup List</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </section>
            </aside>
            <!-- Left side column. contains the logo and sidebar -->

            <!-- Content Wrapper. Contains page content -->

            <style type="text/css">

                .sorting_desc i {
                    float: right;
                    padding-top: 3px;
                }

                .sorting_asc i {
                    float: right;
                    padding-top: 3px;
                }

                .sorting i {
                    float: right;
                    padding-top: 3px;
                }

                .table-responsive > .table > tbody > tr > th {
                    white-space: normal;
                }
                
            </style>


            @yield('content')

            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs"></div>
                <strong>Developed by <a href="#">Jahid Mahmud</a>.</strong>
            </footer>

            <!-- Control Sidebar -->

            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
               immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>

        @yield('scripts')
    </body>
</html>
