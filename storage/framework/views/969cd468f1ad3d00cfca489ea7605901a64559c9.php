<div class="bg-info pl-2 pt-2 pb-1 mt-2">
    <h5 class="text-center"><?php echo e(ucwords($insurancePackage->package_name)); ?></h5>
</div>
<table class="table table-bordered">
    <thead>
        <tr class="table-active">
            <th class="text-center" width="25%">
                Insurance Type
            </th>
            <th class="text-center" width="50%">
                Price
            </th>
            <th class="text-center" width="25%">
                Action
            </th>

        </tr>
    </thead>
    <tbody>


        <input type="hidden" name="package_id" value="<?php echo e($insurancePackage->id); ?>">

        <?php $__currentLoopData = $insurancePrices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $insurancePrice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <?php echo e($insurancePrice->insuranceType->name); ?>

                    <input type="hidden" name="insuranceType_name[]"
                        value="<?php echo e($insurancePrice->insuranceType->name); ?>">
                </td>
                <!-- Jodi insurance type excluded hoi, ejonno screen protection  -->
                <?php if($insurancePrice->insuranceType->check_inc_type == 1 && $insurancePrice->include_type == 'excluded'): ?>
                    
                <?php else: ?>
                    <td>
                        <?php if($insurancePrice->include_type == 'included'): ?>
                            <?php echo e(appliedOnHandsetValueCalculation($device_price, $insurancePrice->value, $insurancePrice->type, $insurancePrice->applied_value_two)); ?>

                            <?php echo e(config('settings.currency')); ?>

                        <?php else: ?>
                            <?php echo e(incPackBtExcItems($device_price, $insurancePrice->value, $insurancePrice->type)); ?>

                            <?php echo e(config('settings.currency')); ?>

                        <?php endif; ?>

                        <input type="hidden" name="in[]"
                            value="<?php echo e(InsurancePriceCalculation($insurancePrice->id, $device_price)); ?>">
                        
                    </td>
                <?php endif; ?>
                
                
                
                
                
                
                
                
                <?php if($insurancePrice->insuranceType->check_inc_type == 1 && $insurancePrice->include_type == 'excluded'): ?>
                    <td colspan="2" id="blure">

                        <input type="hidden" name="device_parts_name"
                            value="<?php echo e($insurancePrice->insuranceType->name); ?>" id="device_parts_name">
                        <input type="hidden" name="protection_times_for" value="1" id="times_for">
                        <label>
                            <input class="p-2 time_chng1" checked type="radio" name="h_a_o_v"
                                value="<?php echo e(appliedOnHandsetValueCalculation($device_price, $insurancePrice->value, $insurancePrice->type, $insurancePrice->applied_value_one)); ?>">
                            One
                            Times


                            <?php echo e(appliedOnHandsetValueCalculation($device_price, $insurancePrice->value, $insurancePrice->type, $insurancePrice->applied_value_one)); ?>

                            <?php echo e(config('settings.currency')); ?>

                        </label>
                        <label>

                            <input class="ml-2 time_chng2" type="radio" name="h_a_o_v"
                                value="<?php echo e(appliedOnHandsetValueCalculation($device_price, $insurancePrice->value, $insurancePrice->type, $insurancePrice->applied_value_two)); ?>">
                            Two
                            times
                            <?php echo e(appliedOnHandsetValueCalculation($device_price, $insurancePrice->value, $insurancePrice->type, $insurancePrice->applied_value_two)); ?>

                            <?php echo e(config('settings.currency')); ?>

                        </label>
                        <label>

                            <input class="ml-2 time_chng0" type="radio" name="h_a_o_v" value="0">
                            None of any
                        </label>

                    </td>
                <?php else: ?>
                    <td>
                        <input id="index_<?php echo e($key); ?>"
                            type="<?php echo e($insurancePrice->include_type == 'included' ? 'hidden' : 'checkbox'); ?>"
                            name="insurance_price_id[]" value="<?php echo e($insurancePrice->id); ?>">
                        <?php echo e($insurancePrice->include_type == 'included' ? 'included ' : ''); ?>

                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script>
    $("#index_1").click(function() {
        // alert($(this).val());
        if (<?php echo e($key); ?> == 2) {
            if ($('#index_1').is(':checked')) {
                //$('input:checkbox').not(this).prop('checked', this.checked);
                //alert($(this).val());
                $('input[name=h_a_o_v]').attr("disabled", true);
                $('input[name=screen_protection_times_for]').attr("disabled", true);
                $('#blure').addClass('test');
                //alert('if condition achieve')
            } else {
                // alert('else condition achieve')
                $('input[name=h_a_o_v]').attr("disabled", false);
                $('input[name=screen_protection_times_for]').attr("disabled", false);
                $('#blure').removeClass('test');
            }
        }
        //$('input:checkbox').not(this).prop('checked', this.checked);
    });
    $('.time_chng1').change(function() {
        $('#times_for').val('1')
    })

    $('.time_chng2').change(function() {
        $('#times_for').val('2')
    })
    $('.time_chng0').change(function() {
        $('#times_for').val('0')
    })
</script>
<?php /**PATH /var/www/html/instaweb/resources/views/backend/child_dealer/device_insurance/insurance_price_history.blade.php ENDPATH**/ ?>