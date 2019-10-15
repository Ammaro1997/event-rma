<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('Public.ViewEvent.Partials.EventHeaderSection', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('Public.ViewEvent.Partials.EventShareSection', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('Public.ViewEvent.Partials.EventViewOrderSection', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('Public.ViewEvent.Partials.EventFooterSection', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Public.ViewEvent.Layouts.EventPage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/Public/ViewEvent/EventPageViewOrder.blade.php ENDPATH**/ ?>