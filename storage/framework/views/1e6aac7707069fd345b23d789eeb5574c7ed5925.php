
<?php $__env->startSection('title', 'Profile'); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/dist/css/spectrum.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/dist/css/custome-style.css')); ?>">
    <style>
        .single-pricing-box .pricing-header.bg2 {
            background-image: url(https://t4.ftcdn.net/jpg/01/19/11/55/360_F_119115529_mEnw3lGpLdlDkfLgRcVSbFRuVl6sMDty.jpg);
        }

        .ptb-100 {
            padding-top: 25px;
            padding-bottom: 100px;
        }

        .single-pricing-box {
            padding-bottom: 19px;
        }

        .single-pricing-box .pricing-header {
            background-color: #002e5b;
            border-radius: 5px 5px 0 0;
            position: relative;
            z-index: 1;
            overflow: hidden;
            padding-top: 25px;
            padding-bottom: 25px;
            background-position: center center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        @media  only screen and (max-width: 767px) {
            .page-title-area {
                height: -14%;
                padding-top: 214px;
                padding-bottom: 32px;
            }
        }

        .src-image {
            display: none;
        }

        .card2 {
            overflow: hidden;
            position: relative;
            text-align: center;
            padding: 0;
            color: #fff;

        }

        .card2 .header-bg {
            /* This stretches the canvas across the entire hero unit */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            border-bottom: 1px #FFF solid;
            /* This positions the canvas under the text */
            z-index: 1;
        }

        .card2 .avatar {
            position: relative;
            z-index: 100;
        }

        .card2 .avatar img {
            width: 100px;
            height: 100px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            border: 5px solid rgba(0, 0, 30, 0.8);
        }

        #hoverMe {
            border-bottom: 1px dashed #e5e5e5;
            text-align: left;
            padding: 13px 20px 11px;
            font-size: 14px;
            font-weight: 600;
            color: #002e5b;

        }

        #hoverMe:hover {
            background-color: #ebebeb;
            color: #002e5b;
            border-left: 3px solid #002e5b;

        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Start Page Title Area -->
    <div class="page-title-area page-title-bg1">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="page-title-content">
                        <h2>Profile</h2>
                        <ul>
                            <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                            <li>Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Pricing Area -->
    <section class="pricing-area ptb-20 pb-70">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-12">
                    <?php echo $__env->make('frontend.partials.customer_dashboard_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <!-- /.col -->
                <div class="col-lg-9 col-md-9 col-sm-12 ">
                    <div class="services-box">
                        <div class="content">
                            <div class="" style="background: #f1f1f1; padding: 5px 5px 5px 10px;">Basic info
                            </div>
                            <div class="tab_content m-4">

                                <div class="tabs_item">
                                    
                                    <form action="<?php echo e(route('user.profile-update')); ?>" method="POST"
                                        enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <label for="name" class="c-form-label col-md-3 col-lg-3">Full Name</label>
                                            <div class="form-group mb-2 col-md-8 col-lg-8">
                                                <input type="text" name="name" class="form-control"
                                                    value="<?php echo e(Auth::user()->name); ?>" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="dob" class="c-form-label col-md-3 col-lg-3">Date of
                                                Birth</label>
                                            <div class="form-group mb-2 col-md-8 col-lg-8">
                                                <input type="date" name="dob" class="form-control"
                                                    value="<?php echo e(Auth::user()->dob); ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="phone" class="c-form-label col-md-3 col-lg-3">Phone</label>
                                            <div class="form-group mb-2 col-md-8 col-lg-8">
                                                <input type="number" name="phone" class="form-control "
                                                    value="<?php echo e(Auth::user()->phone); ?>" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="email" class="c-form-label col-md-3 col-lg-3">Email</label>
                                            <div class="form-group mb-2 col-md-8 col-lg-8">
                                                <input type="email" name="email" class="form-control "
                                                    value="<?php echo e(Auth::user()->email); ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="passport_number" class="c-form-label col-md-3 col-lg-3">Passport
                                                Number</label>
                                            <div class="form-group mb-2 col-md-8 col-lg-8">
                                                <input type="text" name="passport_number" class="form-control "
                                                    value="<?php echo e(Auth::user()->passport_number); ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="passport_expire_till"
                                                class="c-form-label col-md-3 col-lg-3">Passport Expire Date</label>
                                            <div class="form-group mb-2 col-md-8 col-lg-8">
                                                <input type="date" name="passport_expire_till" class="form-control "
                                                    value="<?php echo e(Auth::user()->passport_expire_till); ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="address" class="c-form-label col-md-3 col-lg-3">Address</label>
                                            <div class="form-group mb-2 col-md-8 col-lg-8">
                                                <textarea name="address" class="form-control" id="address" rows="3"><?php echo e(Auth::user()->address); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="avatar_original" class="c-form-label col-md-3 col-lg-3">Profile
                                                Image</label>
                                            <div class="ml-3 mr-3 col-md-8 col-lg-8">
                                                <div class="row" id="avatar_original">
                                                    <?php if(Auth::user()->avatar_original != null): ?>
                                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                                            <div class="img-upload-preview" style="height: 150px;">
                                                                <img loading="lazy"
                                                                    src="<?php echo e(url(Auth::user()->avatar_original)); ?>"
                                                                    alt="" class="img-responsive">
                                                                <input type="hidden" name="previous_avatar_original"
                                                                    value="<?php echo e(Auth::user()->avatar_original); ?>">
                                                                <button type="button"
                                                                    class="btn btn-danger close-btn remove-files"><i
                                                                        class="fa fa-times"></i></button>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="passport" class="c-form-label col-md-3 col-lg-3">Passport
                                                Image</label>
                                            <div class="ml-3 mr-3 col-md-8 col-lg-8">
                                                <div class="row" id="passport">
                                                    <?php if(is_array(json_decode(Auth::user()->passport))): ?>
                                                        <?php $__currentLoopData = json_decode(Auth::user()->passport); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $passport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            
                                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                                <div class="img-upload-preview" style="height: 150px;">
                                                                    <img loading="lazy" src="<?php echo e(url($passport)); ?>"
                                                                        alt="" class="img-responsive">
                                                                    <input type="hidden" name="previous_avatar_original"
                                                                        value="<?php echo e($passport); ?>">
                                                                    <button type="button"
                                                                        class="btn btn-danger close-btn remove-files"><i
                                                                            class="fa fa-times"></i></button>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="nid" class="c-form-label col-md-3 col-lg-3">NID Image
                                                <span>(Front &
                                                    Back)</span></label>
                                            <div class="ml-3 mr-3 col-md-8 col-lg-8">
                                                <div class="row" id="nid">
                                                    <?php if(is_array(json_decode(Auth::user()->nid))): ?>
                                                        <?php $__currentLoopData = json_decode(Auth::user()->nid); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $nid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            
                                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                                <div class="img-upload-preview" style="height: 150px;">
                                                                    <img loading="lazy" src="<?php echo e(url($nid)); ?>"
                                                                        alt="" class="img-responsive">
                                                                    <input type="hidden" name="previous_thumbnail_img"
                                                                        value="<?php echo e($nid); ?>">
                                                                    <button type="button"
                                                                        class="btn btn-danger close-btn remove-files"><i
                                                                            class="fa fa-times"></i></button>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <label for="driving_licence" class="c-form-label col-md-3 col-lg-3">Driving
                                                Licence</label>
                                            <div class="ml-3 mr-3 col-md-8 col-lg-8">
                                                <?php if(Auth::user()->driving_licence != null): ?>
                                                    <a href="<?php echo e(url(Auth::user()->driving_licence)); ?>"
                                                        target="_blank"><?php echo e(explode('/', Auth::user()->driving_licence)[2]); ?></a>
                                                <?php endif; ?>
                                                <input type="file" class="form-control" name="driving_licence">
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <label for="birth_certificate" class="c-form-label col-md-3 col-lg-3">Birth
                                                Certificate</label>
                                            <div class="form-group mb-2 col-md-8 col-lg-8">
                                                <?php if(Auth::user()->birth_certificate != null): ?>
                                                    <a href="<?php echo e(url(Auth::user()->birth_certificate)); ?>"
                                                        target="_blank"><?php echo e(explode('/', Auth::user()->birth_certificate)[2]); ?></a>
                                                <?php endif; ?>
                                                <input type="file" class="form-control" name="birth_certificate">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="default-btn mt-4">Profile
                                                Update<span></span></button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /.pricing-area -->



<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('backend/dist/js/spartan-multi-image-picker-min.js')); ?>"></script>
    <script>
        $("#avatar_original").spartanMultiImagePicker({
            fieldName: 'avatar_original',
            maxCount: 1,
            rowHeight: '150px',
            groupClassName: 'col-md-4 col-sm-4 col-xs-6',
            maxFileSize: '100000',
            dropFileLabel: "Drop Here",
            allowedExt: 'webp|jpeg|png',
            onExtensionErr: function(index, file) {
                console.log(index, file, 'extension err');
                alert('Please only input png or jpg type file')
            },
            onSizeErr: function(index, file) {
                console.log(index, file, 'file size too big');
                alert('Image size too big. Please upload below 100kb');
            },
            onAddRow: function(index) {
                var altData =
                    '<input type="text" placeholder="Thumbnails Alt" name="thumbnail_img_alt[]" class="form-control" required=""></div>'
                //var index = index + 1;
                //$('#photos_alt').append('<h4 id="abc_'+index+'">'+index+'</h4>')
                //$('#thumbnail_img_alt').append('<div class="col-md-4 col-sm-4 col-xs-6" id="abc_'+index+'">'+altData+'</div>')
            },
            onRemoveRow: function(index) {
                var index = index + 1;
                $(`#abc_${index}`).remove()
            },
        });
        $("#passport").spartanMultiImagePicker({
            fieldName: 'passport[]',
            maxCount: 2,
            rowHeight: '150px',
            groupClassName: 'col-md-4 col-sm-4 col-xs-6',
            maxFileSize: '100000',
            dropFileLabel: "Drop Here",
            allowedExt: 'webp|jpeg|png',
            onExtensionErr: function(index, file) {
                console.log(index, file, 'extension err');
                alert('Please only input png or jpg type file')
            },
            onSizeErr: function(index, file) {
                console.log(index, file, 'file size too big');
                alert('Image size too big. Please upload below 100kb');
            },
            onAddRow: function(index) {
                var altData =
                    '<input type="text" placeholder="Thumbnails Alt" name="thumbnail_img_alt[]" class="form-control" required=""></div>'
                //var index = index + 1;
                //$('#photos_alt').append('<h4 id="abc_'+index+'">'+index+'</h4>')
                //$('#thumbnail_img_alt').append('<div class="col-md-4 col-sm-4 col-xs-6" id="abc_'+index+'">'+altData+'</div>')
            },
            onRemoveRow: function(index) {
                var index = index + 1;
                $(`#abc_${index}`).remove()
            },
        });
        $("#nid").spartanMultiImagePicker({
            fieldName: 'nid[]',
            maxCount: 2,
            rowHeight: '150px',
            groupClassName: 'col-md-4 col-sm-4 col-xs-6',
            maxFileSize: '100000',
            dropFileLabel: "Drop Here",
            allowedExt: 'webp|jpeg|png',
            onExtensionErr: function(index, file) {
                console.log(index, file, 'extension err');
                alert('Please only input png or jpg type file')
            },
            onSizeErr: function(index, file) {
                console.log(index, file, 'file size too big');
                alert('Image size too big. Please upload below 100kb');
            },
            onAddRow: function(index) {
                var altData =
                    '<input type="text" placeholder="Thumbnails Alt" name="thumbnail_img_alt[]" class="form-control" required=""></div>'
                //var index = index + 1;
                //$('#photos_alt').append('<h4 id="abc_'+index+'">'+index+'</h4>')
                //$('#thumbnail_img_alt').append('<div class="col-md-4 col-sm-4 col-xs-6" id="abc_'+index+'">'+altData+'</div>')
            },
            onRemoveRow: function(index) {
                var index = index + 1;
                $(`#abc_${index}`).remove()
            },
        });
        $('.remove-files').on('click', function() {
            $(this).parents(".col-md-4").remove();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/frontend/pages/profile.blade.php ENDPATH**/ ?>