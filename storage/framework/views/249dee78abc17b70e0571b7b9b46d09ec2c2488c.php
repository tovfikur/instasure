<form action="<?php echo e(route('paynow.aamrpay')); ?>" method="post">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="travel_ins_orders" value="travel_ins_orders">
    <input type="hidden" name="order_id" value="<?php echo e(encrypt($travelInsOrder->id)); ?>">
    <table class="table">
        <!-- <tr>
            <th>Insurance id</th>
            <th><?php echo e($travelInsOrder->id); ?></th>
        </tr> -->
        <tr>
            <th>Insurance Price</th>
            <th><?php echo e($travelInsOrder->ins_price); ?></th>
        </tr>
        <tr>
            <th>Total Vat (<?php echo e($travelInsOrder->vat_percentage); ?>%)</th>
            <th><?php echo e($travelInsOrder->total_vat); ?></th>
        </tr>
        <tr>
            <th>Total Service Charge (<?php echo e($travelInsOrder->service_amount); ?>%)</th>
            <th><?php echo e($travelInsOrder->service_total_amount); ?></th>
        </tr>
        <tr>
            <th>Grand Total</th>
            <th><?php echo e($travelInsOrder->grand_total); ?></th>
        </tr>
    </table>
    <div class="pay-image text-center">
        <img src="<?php echo e(asset('frontend/assets/images/aamr-pay.webp')); ?>" alt="aamr-pay">
    </div>
<!-- Added by Tovfikur -->
<!-- start -->
<div class="text-center payment-method-div">
</div>
<!-- end -->

    <input type="checkbox" class="mt-3" name="payment_terms" checked="checked" required>
    i accept
    <a class="text-info" href="#">payment</a> and
    <a class="text-info" href="#">return</a>
    policy.
    <div class="text-center">
        <button type="submit" class="default-btn mt-4 w-100 pay-btn" payid="<?php echo e($travelInsOrder->id); ?>" paytype="travel">Pay Now
            <span></span>
        </button>
    </div>
</form>

<script>

// script written by Tovfikur

$('.payment-method-div').append(
    `
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="method" id="method1" value="cash ">
    <label class="form-check-label" for="method1">CASH</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="method" id="method2" value="check">
    <label class="form-check-label" for="method2">CHECK</label>
</div>  
<div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="method" id="method3" value="aamarpay">
    <label class="form-check-label" for="method3">ONLINE</label>
</div>
`
)
$('.pay-btn').hide();
    $('[name="method"]').change(
        ()=>{
            $('.pay-btn').show();
            if($('[name="method"]:checked').val() != 'aamarpay'){
                $('.pay-btn').removeAttr("type").attr("type", "button");
                $('.pay-btn').click(()=>{
                    window.location.href='/pay/cash/'+$('.pay-btn').attr('payid')+'?paytype='+$('.pay-btn').attr('paytype')+'&method='+$('[name="method"]:checked').val();
                }) 
            } else {
                $('.pay-btn').removeAttr("type").attr("type", "submit");
            }
        }
    )
</script><?php /**PATH /var/www/html/instaweb/resources/views/frontend/partials/insurance_payment.blade.php ENDPATH**/ ?>