<style>
    .activeMe {
        background: #002e5b;
        color: #fff !important;
    }
</style>
<div class="single-pricing-box">
    <div class="pricing-header ">
        <div class="card2">
            <div class="avatar">
                <?php if(isset(Auth::user()->avatar_original)): ?>
                    <img src="<?php echo e(url(Auth::user()->avatar_original)); ?>" alt="avatar" />
                <?php endif; ?>
            </div>
            <div class="content">
                <p class="text-white"><?php echo e(Auth::user()->name); ?><br>
            </div>
        </div>
    </div>
    <a href="<?php echo e(route('user.dashboard')); ?>">
        <div class="mb-1 <?php echo e(Request::is('dashboard') ? 'activeMe1' : ''); ?>" id="hoverMe">
            Dashboard
        </div>
    </a>
    <a href="<?php echo e(route('user.profile')); ?>">
        <div class="mb-1 <?php echo e(Request::is('profile') ? 'activeMe' : ''); ?>" id="hoverMe">
            Profile Manage
        </div>
    </a>
    <a href="<?php echo e(route('insurance.quotation.form')); ?>">
        <div class="mb-1 <?php echo e(Request::is('medical/insurance/quotation') ? 'activeMe' : ''); ?>" id="hoverMe">
            Get Travel Insurance
        </div>
    </a>
    <a href="<?php echo e(route('user.insurance.purchase.history')); ?>">
        <div class="mb-1 <?php echo e(Request::is('insurance/purchase/*') ? 'activeMe' : ''); ?>" id="hoverMe">
            Travel Insurance History
        </div>
    </a>
    <a href="<?php echo e(route('user.device-insurance.history')); ?>">
        <div class="mb-1 <?php echo e(Request::is('device-insurance/history') || Request::is('device-insurance/details/*') || Request::is('device-insurance-claim') ? 'activeMe' : ''); ?>"
            id="hoverMe">
            Device Insurance History
        </div>
    </a>
    <a href="<?php echo e(route('user.device-insurance.claim-requests')); ?>">
        <div class="mb-1 <?php echo e(Request::is('device-insurance/support-tickets') ? 'activeMe' : ''); ?>" id="hoverMe">
            Device Support Tickets
        </div>
    </a>

    <a href="<?php echo e(route('user.insuranceClaimHistory')); ?>">
        <div class="mb-1 <?php echo e(Request::is('insurance/claim/history') ? 'activeMe' : ''); ?>" id="hoverMe">
            Device Claim History
        </div>
    </a>
    <a href="#" href="<?php echo e(route('logout')); ?>"
        onclick="event.preventDefault();
       document.getElementById('logout-form').submit();">
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
            <?php echo csrf_field(); ?>
        </form>
        <div class="mb-1" id="hoverMe">
            Sign Out
        </div>
    </a>

</div>
<?php /**PATH /var/www/html/instaweb/resources/views/frontend/partials/customer_dashboard_sidebar.blade.php ENDPATH**/ ?>