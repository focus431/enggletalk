  <!-- jQuery -->
  <script src="/assets/js/jquery-3.6.0.min.js"></script>

  <!-- Bootstrap Core JS -->
  <script src="/assets/js/popper.min.js"></script>
  <script src="/assets/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 JS -->
  <script src="/assets/plugins/select2/js/select2.min.js"></script>
  <!-- Datetimepicker JS -->
  <script src="/assets/js/moment.min.js"></script>
  <script src="/assets/js/bootstrap-datetimepicker.min.js"></script>
  <script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Owl Carousel -->
  <script src="/assets/js/owl.carousel.min.js"></script>
  <!-- Sticky Sidebar JS -->
  <script src="/assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
  <script src="/assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
  <!-- Circle Progress JS -->
  <!-- <script src="assets/js/circle-progress.min.js"></script> -->
  <!-- Custom JS -->
  <script src="/assets/js/script.js"></script>

  <!-- Slick JS -->
  <script src="/assets/plugins/slick/slick.js"></script>

  <!-- Chart.js 圖表-->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


  {{-- @if (Route::is('adminprofile') || Route::is('search.index'))
  <script src="{{ asset('assets/js/rating.js') }}"></script>
  @endif --}}

  @if (Route::is(['map-grid', 'map-list']))
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6adZVdzTvBpE2yBRK8cDfsss8QXChK0I"></script>
  <script src="/assets/js/map.js"></script>
  @endif
