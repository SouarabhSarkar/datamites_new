<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>User Pdf</title>

    <meta name="description" content="READY FOR A CAREER IN
        DATA SCIENCE?">
    <meta name="author" content="datamites">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="READY FOR A CAREER IN
    DATA SCIENCE?">
    <meta property="og:site_name" content="Codebase">
    <meta property="og:description" content="READY FOR A CAREER IN
        DATA SCIENCE?">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/r.jpg') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/media/favicons/r.jpg') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/media/favicons/r.jpg') }}">
    <!-- END Icons -->

    <!-- Stylesheets -->

    <!-- Fonts and Codebase framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css') }}">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->
    <!-- END Stylesheets -->
</head>

<body>
    <!-- Page Container -->
    <!--
      Available classes for #page-container:

      GENERIC

        'remember-theme'                            Remembers active color theme and dark mode between pages using localStorage when set through
                                                    - Theme helper buttons [data-toggle="theme"],
                                                    - Layout helper buttons [data-toggle="layout" data-action="dark_mode_[on/off/toggle]"]
                                                    - ..and/or Codebase.layout('dark_mode_[on/off/toggle]')

      SIDEBAR & SIDE OVERLAY

        'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
        'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
        'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
        'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
        'sidebar-dark'                              Dark themed sidebar

        'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
        'side-overlay-o'                            Visible Side Overlay by default

        'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

        'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

      HEADER

        ''                                          Static Header if no class is added
        'page-header-fixed'                         Fixed Header

      HEADER STYLE

        ''                                          Classic Header style if no class is added
        'page-header-modern'                        Modern Header style
        'page-header-dark'                          Dark themed Header (works only with classic Header style)
        'page-header-glass'                         Light themed Header with transparency by default
                                                    (absolute position, perfect for light images underneath - solid light background on scroll if the Header is also set as fixed)
        'page-header-glass page-header-dark'        Dark themed Header with transparency by default
                                                    (absolute position, perfect for dark images underneath - solid dark background on scroll if the Header is also set as fixed)

      MAIN CONTENT LAYOUT

        ''                                          Full width Main Content if no class is added
        'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
        'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)

      DARK MODE

        'sidebar-dark page-header-dark dark-mode'   Enable dark mode (light sidebar/header is not supported with dark mode)
    -->
    <div id="page-container" class="page-header-fixed page-header-glass main-content-boxed">
        <!-- Header -->
        {{-- <header id="page-header" style="background-color: white">
            <!-- Header Content -->
            <div class="content-header">
                <!-- Left Section -->
                <div class="space-x-1 d-flex align-items-center space-x-2">
                    <!-- Logo -->
                    <a class="link-fx fw-bold" href="index.html">
                        <img src="{{ asset('assets/media/favicons/r.jpg') }}" alt="">
                    </a>
                    <!-- END Logo -->
                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div class="space-x-1">
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <a class="btn btn-alt-primary px-3 d-none d-sm-inline-block">
                        <span class="ms-1 d-none d-sm-inline-block">Welcome {{ Auth::user()->name }}</span>
                    </a>
                    <a class="btn btn-alt-success px-3" href="{{ route('logout') }}">
                        <span class="ms-1 d-none d-sm-inline-block">Logout</span>
                    </a>
                </div>
                <!-- END Right Section -->
            </div>
            <!-- END Header Content -->
        </header> --}}
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">
            <!-- Feature: Developer Minded -->
            <div class="bg-body-light">

                <div class="content content-full">
                    <div class="row mt-5 g-0 pull-b justify-content-center overflow-hidden">
                        <div class="col-md-12 mt-5">
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">User List pdf</h3>
                                    {{-- <div class="block-options">
                                            <a href="{{ route('downloadpdf') }}">
                                                <button type="button" class="btn-block-option"
                                                    data-toggle="block-option" data-action="state_toggle"
                                                    data-action-mode="demo">
                                                    Download(pdf)
                                                </button>
                                            </a>
                                        </div> --}}
                                </div>
                                <div class="block-content">
                                    <table class="table table-striped table-vcenter">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Mobile</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $usr)
                                                <tr>
                                                    <td class="fw-semibold text-break text-center">{{ $usr->name }}
                                                    </td>
                                                    <td class="text-break text-center">{{ $usr->email }}</td>
                                                    <td class="text-break text-center">{{ $usr->mobile }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <!-- END Feature: Developer Minded -->
            <!-- Footer -->
            {{-- <footer id="page-footer" class="bg-body-light">
                <div class="content py-5">
                    <div class="row fs-sm">
                        <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-end">
                            Crafted with <i class="fa fa-heart text-pulse"></i> by <a class="fw-semibold"
                                href="https://1.envato.market/ydb" target="_blank">pixelcave</a>
                        </div>
                        <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
                            <a class="fw-semibold" href="https://1.envato.market/95j" target="_blank">Codebase
                                5.1</a> &copy; <span data-toggle="year-copy"></span>
                        </div>
                    </div>
                </div>
            </footer> --}}
            <!-- END Footer -->
        </main>
        <!-- END Main Container -->
    </div>
    <!-- END Page Container -->

    <!--
        Codebase JS

        Core libraries and functionality
        webpack is putting everything together at assets/_js/main/app.js
    -->
    <script src="{{ asset('assets/js/codebase.app.min.js') }}"></script>
</body>

</html>
