<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo e(get_setting('title')); ?></title>
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no">
    <meta name="description" content="<?php echo e(get_setting('meta_description')); ?>">
    <meta name="keywords" content="<?php echo e(get_setting('meta_description')); ?>">
    <meta name="robots" content="*">
    <link rel="icon" href="<?php echo e(URL::to('/')); ?>/public/images/general_settings/<?php echo e(get_setting('favicon')); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo e(URL::to('/')); ?>/public/images/general_settings/<?php echo e(get_setting('favicon')); ?>" type="image/x-icon">

    
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/templates/admin/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/summernote/summernote-bs4.min.css">


  <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!--Alertify CSS -->
  <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/public/assets/css/alertify.min.css" />

  <!--  -->
  <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/public/assets/css/summernote.css">
  <!-- Switch-button-bootstrap -->
  <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/public/assets/css/bootstrap-switch-button.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?php echo e(route('admin-index')); ?>" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?php echo e(route('logout')); ?>" class="nav-link" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
            <?php echo e(__('Logout')); ?>

          </a>

          <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
            <?php echo csrf_field(); ?>
          </form>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?php echo e(route('admin-index')); ?>" class="brand-link">
        <!-- <img src="<?php echo e(URL::to('/')); ?>/templates/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-light"><?php echo e(get_setting('title')); ?></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo e(URL::to('/')); ?>/templates/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo e(Auth::user()->name); ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="<?php echo e(route('admin-index')); ?>" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Users
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo e(route('users-show')); ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Customers</p>
                  </a>
                </li>
                <!-- <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Vendors</p>
                  </a>
                </li> -->

                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Vendors
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="<?php echo e(route('pending-vendors-show')); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pending Vendors</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo e(route('approved-vendors-show')); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Approved Vendors</p>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>

            <!-- <li class="nav-item">
              <a href="" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Profile
                </p>
              </a>
            </li> -->

            <li class="nav-item">
              <a href="<?php echo e(route('categories-show')); ?>" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Category
                </p>
              </a>
            </li>

            <!-- <li class="nav-item">
              <a href="" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Varient Filter
                </p>
              </a>
            </li> -->

            <li class="nav-item">
              <a href="<?php echo e(route('products-show')); ?>" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Products
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo e(route('orders-show')); ?>" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Orders
                </p>
              </a>
            </li>

            <!-- " class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Coupons
                </p>
              </a>
            </li>--}} -->

            <li class="nav-item">
              <a href="<?php echo e(route('banners-show')); ?>" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Banners
                </p>
              </a>
            </li>

            <!-- " class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Blogs
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Brands
                </p>
              </a>
            </li>--}} -->

            <li class="nav-item">
              <a href="<?php echo e(route('sliders-show')); ?>" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Sliders
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo e(route('popular-products-show')); ?>" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Popular Products
                </p>
              </a>
            </li>

            <!--  -->

            <li class="nav-item">
              <a href="<?php echo e(route('general-settings-show')); ?>" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>
                  General Settings
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo e(route('contact-forms-show')); ?>" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Contact Details
                </p>
              </a>
            </li>

            <!--  -->

            <li class="nav-item">
              <a href="<?php echo e(route('videos-show')); ?>" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Add Videos
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo e(route('google-reviews-show')); ?>" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Add Google Reviews
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo e(route('email-subscribers-show')); ?>" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Email Subscribers
                </p>
              </a>
            </li>
            
            
            <li class="nav-item">
               <a href="<?php echo e(route('logout')); ?>" class="nav-link" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="nav-icon far fa-user"></i>
                <p>
                  LogOut
                </p>
              </a>
              <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
              </form>
            </li>



          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <?php echo $__env->yieldContent('content'); ?>

    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2021 <a href="#">XYZ.com</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/moment/moment.min.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/dist/js/pages/dashboard.js"></script>


  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/jszip/jszip.min.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/templates/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <script src="<?php echo e(URL::to('/')); ?>/public/assets/js/sweetalert.min.js"></script>
  <!--Alertify JavaScript -->
  <script src="<?php echo e(URL::to('/')); ?>/public/assets/js/alertify.min.js"></script>

  <!--  -->
  <script src="<?php echo e(URL::to('/')); ?>/public/assets/js/summernote.js"></script>
  <!-- Switch-button-bootstrap -->
  <script src="<?php echo e(URL::to('/')); ?>/public/assets/js/bootstrap-switch-button.js"></script>

  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#description').summernote();
    });
    $(document).ready(function() {
      $('#short_description').summernote();
    });
  </script>

  <script>
    setTimeout(function() {
      $('#alert').slideUp();
    }, 2000);
  </script>
  <script>
    $('.dltBtn').click(function(e) {
      var form = $(this).closest('form');
      var dataID = $(this).data('id');
      e.preventDefault();
      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this Record!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            form.submit();
            swal("Poof! Your Record has been deleted!", {
              icon: "success",
            });
          } else {
            swal("Your Record is safe!");
          }
        });
    });
  </script>

</body>

</html><?php /**PATH /home/shreshta/public_html/resources/views/layouts/admin.blade.php ENDPATH**/ ?>