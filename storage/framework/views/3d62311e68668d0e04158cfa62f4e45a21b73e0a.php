<?php $__env->startSection('blankslate-icon-class'); ?>
    ico-ticket
<?php $__env->stopSection(); ?>

<?php $__env->startSection('blankslate-title'); ?>
    <?php echo app('translator')->getFromJson("Event.no_events_yet"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('blankslate-text'); ?>
    <?php echo app('translator')->getFromJson("Event.no_events_yet_text"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('blankslate-body'); ?>
<button data-invoke="modal" data-modal-id="CreateEvent" data-href="<?php echo e(route('showCreateEvent', ['organiser_id' => $organiser->id])); ?>" href='javascript:void(0);'  class="btn btn-success mt5 btn-lg" type="button">
    <i class="ico-ticket"></i>
    <?php echo app('translator')->getFromJson("Event.create_event"); ?>
</button>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('Shared.Layouts.BlankSlate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageOrganiser/Partials/EventsBlankSlate.blade.php ENDPATH**/ ?>