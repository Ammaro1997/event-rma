<footer id="footer" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                
                
                <?php echo $__env->make('Shared.Partials.PoweredBy', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php if(Utils::userOwns($event)): ?>
                &bull;
                <a class="adminLink " href="<?php echo e(route('showEventDashboard' , ['event_id' => $event->id])); ?>"><?php echo app('translator')->getFromJson("Public_ViewEvent.event_dashboard"); ?></a>
                &bull;
                <a class="adminLink "
                   href="<?php echo e(route('showOrganiserDashboard' , ['organiser_id' => $event->organiser->id])); ?>"><?php echo app('translator')->getFromJson("Public_ViewEvent.organiser_dashboard"); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>

<?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/Public/ViewEvent/Partials/EventFooterSection.blade.php ENDPATH**/ ?>