<div class="card">
    <div class="card-body">
        <h5 class="card-title">Select A Policy Provider</h5>
        <input type="hidden" name="age" value="<?php echo e($age); ?>" class="form-control" readonly>
        <input type="hidden" name="total_date" value="<?php echo e($total_date); ?>" class="form-control" readonly>

        <div class="row">
            <?php $__empty_1 = true; $__currentLoopData = $travelPlanCharts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $travelPlanChart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-4">
                    <div class="big" id="<?php echo e($key); ?>">
                        <input id="chb-<?php echo e($key); ?>" class="chb" name="package_id"
                            value="<?php echo e($travelPlanChart->id); ?>" type="radio" <?php echo e($key == 0 ? 'checked' : ''); ?> />
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span>
                                    <img src="<?php echo e(asset('uploads/policy_provider/logo/' . $travelPlanChart->policyProvider->logo)); ?>"
                                        alt="policyProviderLogo" width="30" class="mr-1">
                                </span>
                                <?php echo e($travelPlanChart->policyProvider->company_name); ?>

                            </li>
                            <li class="list-group-item">
                                Insurance Price: <?php echo e($travelPlanChart->ins_price); ?>

                                <?php echo e(config('settings.currency')); ?>

                            </li>
                            <li class="list-group-item">Stay <?php echo e($total_date); ?> days</li>
                        </ul>
                    </div>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-danger">Your criteria does not match with any package.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php if(!empty($travelPlanCharts[0]['id'])): ?>
    <div class="text-center">
        <button type="submit" class="default-btn mt-4 w-100">Submit<span></span>
        </button>
    </div>
<?php endif; ?>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"
integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        if ($("input[name='package_id']:checked")) {
            $("#0").toggleClass('hli');
        }
    })
    $('.big').click(function() {
        $('.hli').toggleClass('hli');
        $(this).toggleClass('hli');
        var Id = $(this).find('input[type=radio]').attr('id');
        document.getElementById(Id).click();

    });
</script>
<?php /**PATH /var/www/html/instaweb/resources/views/frontend/partials/insurance_provider_info.blade.php ENDPATH**/ ?>