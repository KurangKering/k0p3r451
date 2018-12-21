<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','KOPERASI')</title>
    <!-- Global stylesheets -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css"> --}}
    <link href="{{ asset('templates/material/assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('templates/material/assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('templates/material/assets/css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('templates/material/assets/css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('templates/material/assets/css/colors.css') }}" rel="stylesheet" type="text/css">
    @yield('custom_css')
    <!-- /global stylesheets -->



    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('templates/material/assets/js/plugins/loaders/pace.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('templates/material/assets/js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('templates/material/assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('templates/material/assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <!-- /core JS files -->
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('templates/material/assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('templates/material/assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
    <script type="text/javascript" src="{{ asset('templates/material/assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('templates/material/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('templates/material/assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
    <script type="text/javascript" src="{{ asset('templates/material/assets/js/plugins/ui/moment/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('templates/material/assets/js/plugins/pickers/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('templates/material/assets/js/core/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('templates/material/assets/js/plugins/ui/ripple.min.js') }}"></script>
    
    <!-- /theme JS files -->

    <script type="text/javascript" src="{{ asset('templates/material/assets/js/plugins/media/fancybox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('templates/material/assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/axios/dist/axios.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/convert_rupiah.js') }}"></script>


</head>
<body>
    @php
    $foto = '';
    $nama = '';
    $roles = '';

    if ((Auth::user())) {
        $foto = Auth::user()->foto;
        $nama = Auth::user()->name;
        $roles =  implode(',', Auth::user()->getRoleNames()->toArray()) ;
    }
    @endphp
    <!-- Main navbar -->
    <div class="navbar navbar-inverse bg-indigo">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ url('/') }}">{{-- <img src="{{ asset('templates/material/assets/images/logo_light.png') }}" alt=""> --}}</a>
            <ul class="nav navbar-nav visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
        </div>
        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
                <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
            <div class="navbar-right">
            </div>
        </div>
    </div>
    <!-- /main navbar -->
    <!-- Page container -->
    <div class="page-container">
        <!-- Page content -->
        <div class="page-content">
            <!-- Main sidebar -->
            <div class="sidebar sidebar-main sidebar-default">
                <div class="sidebar-content">
                    <!-- User menu -->
                    <div class="sidebar-user-material">
                        <div class="category-content">
                            <div class="sidebar-user-material-content">
                                <a href="{{ Storage::url($foto) ?? '' }}" data-popup="lightbox">
                                <img  class="img-circle img-responsive" src="{{ Storage::url($foto) ?? '' }}" alt="">
                                
                            </a>
                                
                                <h6>{{ $nama }}</h6>
                                <span class="text-size-small">{{ $roles }}</span>
                            </div>
                            <div class="sidebar-user-material-menu">
                                <a href="{{ asset('templates/material/#user-nav') }}" data-toggle="collapse"><span>My account</span> <i class="caret"></i></a>
                            </div>
                        </div>
                        <div class="navigation-wrapper collapse" id="user-nav">



                          <ul class="navigation">
                            <li><a href="{{ route('profile.index') }}"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
                            <li class="divider"></li>
                            <li>
                              <a href="{{ route('logout') }}" 
                              onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                              <i class="icon-switch2"></i> <span>Logout</span>
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                      </li>
                  </ul>
              </div>
          </div>
          <!-- /user menu -->
          <!-- Main navigation -->
          @include('layouts.partials.navbar')
          <!-- /main navigation -->
      </div>
  </div>
  <!-- /main sidebar -->
  <!-- Main content -->
  <div class="content-wrapper">
    <!-- Page header -->
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> @yield('header-title', 'HEADER')</h4>
            </div>
            <div class="heading-elements">
                @yield('heading-elements')
            </div>
        </div>
    </div>
    <!-- /page header -->
    <!-- Content area -->
    <div class="content">
        @yield('content')
        <!-- Footer -->
        <div class="footer text-muted"></div>
        <!-- /footer -->
    </div>
    <!-- /content area -->
</div>
<!-- /main content -->
</div>
<!-- /page content -->
</div>
<!-- /page container -->

<script>
      // Lightbox
      $('[data-popup="lightbox"]').fancybox({
        padding: 3
    });
</script>
@yield('custom_js')

</body>
</html>
