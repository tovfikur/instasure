<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?> :: Instasure</title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('favicon.png')); ?>">
    <?php echo htmlScriptTagJsApi(); ?>


    <!-- Bootstrap Min CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/bootstrap.min.css')); ?>">
    <!-- Animate Min CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/animate.min.css')); ?>">
    <!-- FontAwesome Min CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/fontawesome.min.css')); ?>">
    <!-- FlatIcon CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/flaticon.css')); ?>">
    <!-- Owl Carousel Min CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/owl.carousel.min.css')); ?>">
    <!-- Slick Min CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/slick.min.css')); ?>">
    <!-- MeanMenu CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/meanmenu.css')); ?>">
    <!-- Magnific Popup Min CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/magnific-popup.min.css')); ?>">
    <!-- Odometer Min CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/odometer.min.css')); ?>">
    <!-- Nice Select Min CSS -->
    
    <!-- Style CSS -->
    
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/main.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/responsive.css')); ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <?php echo $__env->yieldPushContent('css'); ?>
</head>

<body>

    <!-- Preloader -->
    
    <!-- End Preloader -->

    <?php echo $__env->make('frontend.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make('frontend.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



    <div class="go-top"><i class="fas fa-chevron-up"></i><i class="fas fa-chevron-up"></i></div>

    <!-- jQuery Min JS -->
    <script src="<?php echo e(asset('frontend/assets/js/jquery.min.js')); ?>"></script>
    <!-- Popper Min JS -->
    <script src="<?php echo e(asset('frontend/assets/js/popper.min.js')); ?>"></script>
    <!-- Bootstrap Min JS -->
    <script src="<?php echo e(asset('frontend/assets/js/bootstrap.min.js')); ?>"></script>
    <!-- Parallax Min JS -->
    <script src="<?php echo e(asset('frontend/assets/js/parallax.min.js')); ?>"></script>
    <!-- Owl Carousel Min JS -->
    <script src="<?php echo e(asset('frontend/assets/js/owl.carousel.min.js')); ?>"></script>

    <script src="<?php echo e(asset('frontend/assets/js/slick.min.js')); ?>"></script>
    <!-- MeanMenu JS -->
    <script src="<?php echo e(asset('frontend/assets/js/jquery.meanmenu.js')); ?>"></script>
    <!-- Appear Min JS -->
    <script src="<?php echo e(asset('frontend/assets/js/jquery.appear.min.js')); ?>"></script>
    <!-- Odometer Min JS -->
    <script src="<?php echo e(asset('frontend/assets/js/odometer.min.js')); ?>"></script>
    <!-- Nice Select Min JS -->
    
    <!-- Magnific Popup Min JS -->
    <script src="<?php echo e(asset('frontend/assets/js/jquery.magnific-popup.min.js')); ?>"></script>
    <!-- WOW Min JS -->
    <script src="<?php echo e(asset('frontend/assets/js/wow.min.js')); ?>"></script>
    <!-- AjaxChimp Min JS -->
    <script src="<?php echo e(asset('frontend/assets/js/jquery.ajaxchimp.min.js')); ?>"></script>
    <!-- Form Validator Min JS -->
    <script src="<?php echo e(asset('frontend/assets/js/form-validator.min.js')); ?>"></script>
    <!-- Contact Form Min JS -->
    <script src="<?php echo e(asset('frontend/assets/js/contact-form-script.js')); ?>"></script>
    <!-- Main JS -->
    <script src="<?php echo e(asset('frontend/assets/js/main.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <?php echo $__env->yieldPushContent('js'); ?>
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
    </script>
</body>

</html>
<?php /**PATH /var/www/html/instaweb/resources/views/frontend/layouts/app.blade.php ENDPATH**/ ?>