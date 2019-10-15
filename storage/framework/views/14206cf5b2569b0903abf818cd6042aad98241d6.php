<?php $__env->startSection('pre_header'); ?>
    <?php if(!$event->is_live): ?>
        <style>
            .sidebar {
                top: 43px;
            }
        </style>
        <div class="alert alert-warning top_of_page_alert">
            <?php echo e(@trans("ManageEvent.event_not_live")); ?>

            <a href="<?php echo e(route('MakeEventLive', ['event_id' => $event->id])); ?>"><?php echo e(@trans("ManageEvent.publish_it")); ?></a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<ul class="nav navbar-nav navbar-left">
    <!-- Show Side Menu -->
    <li class="navbar-main">
        <a href="javascript:void(0);" class="toggleSidebar" title="Show sidebar">
            <span class="toggleMenuIcon">
                <span class="icon ico-menu"></span>
            </span>
        </a>
    </li>
    <!--/ Show Side Menu -->
    <li class="nav-button">
        <a target="_blank" href="<?php echo e($event->event_url); ?>">
            <span>
                <i class="ico-eye2"></i>&nbsp;<?php echo app('translator')->getFromJson("ManageEvent.event_page"); ?>
            </span>
        </a>
    </li>
</ul><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageEvent/Partials/TopNav.blade.php ENDPATH**/ ?>