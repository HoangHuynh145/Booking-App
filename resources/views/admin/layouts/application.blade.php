<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../admin/assets/" data-template="vertical-menu-template">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>{{ $title }} | Golobe Admin</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <!-- <link rel="icon" type="image/x-icon" href="{{ asset('admin/assets/img/favicon/favicon.png') }}" /> -->

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet" />

  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/materialdesignicons.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/fontawesome.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/flag-icons.css') }}" />

  <!-- Menu waves for no-customizer fix -->
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/node-waves/node-waves.css') }}" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/ltr/core.css') }}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/ltr/theme-bordered.css') }}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/swiper/swiper.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/tagify/tagify.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />

  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/quill/typography.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/quill/katex.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/quill/editor.css') }}" />


  <!-- Page CSS -->
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/pages/cards-statistics.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/pages/cards-analytics.css') }}" />
  <script src="{{ asset('admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
  <!-- Helpers -->
  <script src="{{ asset('admin/assets/vendor/js/helpers.js') }}"></script>
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="{{ asset('admin/assets/js/config.js') }}"></script>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      @include('admin.partials.menu', ['menu' => $menu])

      <!-- Layout container -->
      <div class="layout-page">
        @include('admin.partials.navbar')

        <!-- Content wrapper -->
        <div class="content-wrapper">
          @yield('content')

          @include('admin.partials.footer')

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
  </div>
  <!-- / Layout wrapper -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="{{ asset('admin/assets/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/libs/node-waves/node-waves.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/libs/hammer/hammer.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/libs/i18n/i18n.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/js/menu.js') }}"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/libs/swiper/swiper.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/libs/select2/select2.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/libs/tagify/tagify.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/libs/quill/katex.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/libs/quill/quill.js') }}"></script>
  <!-- Main JS -->
  <script src="{{ asset('admin/assets/js/main.js') }}"></script>
  <!-- Page JS -->
  <script src="{{ asset('admin/assets/js/dashboards-crm.js') }}"></script>
  <script src="{{ asset('admin/assets/js/sconnect.js') }}"></script>

  @yield('js')
</body>

</html>