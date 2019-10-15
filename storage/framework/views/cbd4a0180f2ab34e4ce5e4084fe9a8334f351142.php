<?php $__env->startSection('blankslate-icon-class'); ?>
    ico-users
<?php $__env->stopSection(); ?>

<?php $__env->startSection('blankslate-title'); ?>
    <?php echo app('translator')->getFromJson("ManageEvent.no_attendees_yet"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('blankslate-text'); ?>
    <?php echo app('translator')->getFromJson("ManageEvent.no_attendees_yet_text"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('blankslate-body'); ?>
<button data-invoke="modal" data-modal-id='InviteAttendee' data-href="<?php echo e(route('showInviteAttendee', array('event_id'=>$event->id))); ?>" href='javascript:void(0);'  class=' btn btn-success mt5 btn-lg' type="button" >
    <i class="ico-user-plus"></i>
    <?php echo app('translator')->getFromJson("ManageEvent.invite_attendee"); ?>
</button>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('Shared.Layouts.BlankSlate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageEvent/Partials/AttendeesBlankSlate.blade.php ENDPATH**/ ?>