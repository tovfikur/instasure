<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?php echo $__env->yieldContent('title'); ?> | Instasure </title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('favicon.png')); ?>">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/fontawesome-free/css/all.min.css')); ?>">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('backend/dist/css/adminlte.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/dist/css/custome-style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/select2/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables/dataTables.bootstrap4.css')); ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <style>
        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active {

            background-color: #8a9cb0;
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 4px;
            height: 36px !important;
        }

        .dropdown-menu {
            padding: 0 !important;
        }

        ::-webkit-scrollbar {
            width: 5px;
            background: #46528a;
        }

        .sidebar {
            padding-bottom: 0;
            padding-top: 0;
            padding-left: 0 !important;
            padding-right: 0 !important;
            overflow-y: auto;
            height: calc(100% - 4rem);
        }

        .nav-pills .nav-link {
            border-radius: 0 !important;
        }

        .user-panel img {
            width: 100%;
            height: auto;
        }

        .content-header {
            padding: 0px .5rem !important;
        }

        .dropleft .dropdown-toggle::before {
            display: none;
            visibility: hidden;
        }

        .nav-sidebar .nav-link {
            padding: 2px 1rem;
        }

        .nav-sidebar .nav-link p {
            font-size: 12px;
        }
    </style>
    <?php echo $__env->yieldPushContent('css'); ?>
    <?php echo \Livewire\Livewire::styles(); ?>

</head>

<body class="hold-transition ">
    <div class="wrapper">
        <!-- Navbar -->
        <?php echo $__env->make('backend.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->

        <?php if((Auth::check() && Auth::user()->user_type == 'admin') || Auth::user()->user_type == 'staff'): ?>
            <?php echo $__env->make('backend.includes.admin_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php elseif(Auth::check() && Auth::user()->user_type == 'parent_dealer'): ?>
            <?php echo $__env->make('backend.includes.parent_dealer_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php elseif(Auth::check() && Auth::user()->user_type == 'child_dealer'): ?>
            <?php echo $__env->make('backend.includes.child_dealer_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php elseif(Auth::check() && Auth::user()->user_type == 'service_center'): ?>
            <?php echo $__env->make('backend.includes.service_center_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php elseif(Auth::check() && Auth::user()->user_type == 'collection_center'): ?>
            <?php echo $__env->make('backend.includes.collection_center_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <!-- /.content-wrapper -->


        <!-- Main Footer -->
        <?php echo $__env->make('backend.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="<?php echo e(asset('backend/plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo e(asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(asset('backend/dist/js/adminlte.js')); ?>"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="<?php echo e(asset('backend/dist/js/demo.js')); ?>"></script>

    <!-- PAGE PLUGINS -->
    <!-- SparkLine -->
    <script src="<?php echo e(asset('backend/plugins/sparkline/jquery.sparkline.min.js')); ?>"></script>
    <!-- jVectorMap -->
    <script src="<?php echo e(asset('backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')); ?>"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo e(asset('backend/plugins/slimScroll/jquery.slimscroll.min.js')); ?>"></script>
    <!-- ChartJS 1.0.2 -->
    <script src="<?php echo e(asset('backend/plugins/chartjs-old/Chart.min.js')); ?>"></script>

    <script src="<?php echo e(asset('backend/plugins/select2/select2.full.min.js')); ?>"></script>

    <!-- PAGE SCRIPTS -->
    <script src="<?php echo e(asset('backend/dist/js/pages/dashboard2.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/plugins/form.js')); ?>"></script>

    <script src="<?php echo e(asset('backend/plugins/datatables/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/plugins/datatables/dataTables.bootstrap4.js')); ?>"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <?php echo Toastr::message(); ?>

    <script>
        <?php if($errors->any()): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                toastr.error('<?php echo e($error); ?>', 'Error', {
                    closeButton: true,
                    progressBar: true
                });
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        $(function() {
            $('[data-toggle="frontend"]').tooltip()
        })
    </script>
    <script>
        $(function() {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
        $(document).ready(function() {
            $('.demo-select2').select2();
        });
    </script>
    <script></script>
    <?php echo $__env->yieldPushContent('js'); ?>
    <?php echo \Livewire\Livewire::scripts(); ?>

</body>

</html>
<?php /**PATH /var/www/html/instaweb/resources/views/backend/layouts/master.blade.php ENDPATH**/ ?>