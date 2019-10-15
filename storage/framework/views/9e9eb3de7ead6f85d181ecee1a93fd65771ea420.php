<?php $__env->startSection('blankslate-icon-class'); ?>
    ico-cart
<?php $__env->stopSection(); ?>

<?php $__env->startSection('blankslate-title'); ?>
    <?php echo app('translator')->getFromJson("ManageEvent.no_orders_yet"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('blankslate-text'); ?>
    <?php echo app('translator')->getFromJson("ManageEvent.no_orders_yet_text"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('blankslate-body'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('Shared.Layouts.BlankSlate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageEvent/Partials/OrdersBlankSlate.blade.php ENDPATH**/ ?>