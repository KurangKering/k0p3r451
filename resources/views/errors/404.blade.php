
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404</title>

    <!-- Global stylesheets -->
    <link href="{{ asset('templates/layout/https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('templates/layout/assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('templates/layout/assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('templates/layout/assets/css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('templates/layout/assets/css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('templates/layout/assets/css/colors.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('templates/layout/assets/js/plugins/loaders/pace.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('templates/layout/assets/js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('templates/layout/assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('templates/layout/assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('templates/layout/assets/js/plugins/ui/nicescroll.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('templates/layout/assets/js/plugins/ui/drilldown.js') }}"></script>
    <!-- /core JS files -->


    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('templates/layout/assets/js/core/app.js') }}"></script>

    <script type="text/javascript" src="{{ asset('templates/layout/assets/js/plugins/ui/ripple.min.js') }}"></script>
    <!-- /theme JS files -->

</head>

<body>

    <!-- Main navbar -->
    
    <!-- /main navbar -->


    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Error title -->
                <div class="text-center content-group">
                    <h1 class="error-title">404</h1>
                    <h5>Oops, an error has occurred. Page not found!</h5>
                </div>
                <!-- /error title -->


                <!-- Error content -->
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3">
                        <div class="text-center">
                            <a href="{{ url('') }}" class="btn bg-pink-400"><i class="icon-circle-left2 position-left"></i> Back to dashboard</a>
                        </div>
                    </div>
                </div>
                <!-- /error wrapper -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->


    <!-- Footer -->
    <div class="footer text-muted text-center">

    </div>
    <!-- /footer -->

</body>
</html>
