<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Organiz Thrifts @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="/admin/assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Fonts and icons -->
    <script src="/admin/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["/admin/assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="/admin/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/admin/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="/admin/assets/css/kaiadmin.min.css" />


    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="/admin/assets/css/demo.css" />

    {{-- union button styles  --}}

    <style>
        /* General styles for the tabs */
        .custom-tab {
            border: none;
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            color: white;
            font-size: 1rem;
            font-weight: 500;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 25px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        /* Hover effect with a wavy animation */
        .custom-tab:hover {
            background: linear-gradient(45deg, #2575fc, #6a11cb);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            transform: scale(1.05);
        }

        /* Active tab styles */
        .custom-tab.active {
            background: linear-gradient(45deg, #43e97b, #38f9d7);
            color: #fff;
        }

        /* Wavy effect for the background */
        .custom-tab::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transform: skewX(-20deg);
            transition: left 0.3s ease-in-out;
            z-index: 1;
        }

        /* Animation on hover */
        .custom-tab:hover::before {
            left: 100%;
        }

        /* Ensure the text stays above the effect */
        .custom-tab span {
            position: relative;
            z-index: 2;
        }
    </style>




</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('includes.adminsidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            @include('includes.adminnavbar')

            @yield('content')

            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <div class="copyright">
                        2024, made with <i class="fa fa-heart heart text-danger"></i> by
                        <a href="">TechBrains</a>
                    </div>
                    <div>
                        Distributed by
                        <a target="_blank" href="">Mr. Frank</a>.
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="/admin/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="/admin/assets/js/core/popper.min.js"></script>
    <script src="/admin/assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="/admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Datatables -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <!-- Initialize DataTable -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

    <!-- Other Scripts -->
    <script src="/admin/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="/admin/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="/admin/assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="/admin/assets/js/kaiadmin.min.js"></script>
</body>

</html>
