<?php if(!$event->is_live): ?>
<section id="goLiveBar">
    <div class="container">
        <?php if(!$event->is_live): ?>

        <?php echo e(@trans("ManageEvent.event_not_live")); ?>

        <a href="<?php echo e(route('MakeEventLive' , ['event_id' => $event->id])); ?>"
           style="background-color: green; border-color: green;"
        class="btn btn-success btn-xs"><?php echo e(@trans("ManageEvent.publish_it")); ?></a>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>
<section id="organiserHead" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div onclick="window.location='<?php echo e($event->event_url); ?>#organiser'" class="event_organizer">
                    <b><?php echo e($event->organiser->name); ?></b> <?php echo app('translator')->getFromJson("Public_ViewEvent.presents"); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="intro" class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 property="name"><?php echo e($event->title); ?></h1>
            <div class="event_venue">
                <span property="startDate" content="<?php echo e($event->start_date->toIso8601String()); ?>">
                    <?php echo e($event->startDateFormatted()); ?>

                </span>
                -
                <span property="endDate" content="<?php echo e($event->end_date->toIso8601String()); ?>">
                     <?php if($event->start_date->diffInDays($event->end_date) == 0): ?>
                        <?php echo e($event->end_date->format('H:i')); ?>

                     <?php else: ?>
                        <?php echo e($event->endDateFormatted()); ?>

                     <?php endif; ?>
                </span>
                <?php echo app('translator')->getFromJson("Public_ViewEvent.at"); ?>
                <span property="location" typeof="Place">
                    <b property="name"><?php echo e($event->venue_name); ?></b>
                    <meta property="address" content="<?php echo e(urldecode($event->venue_name)); ?>">
                </span>
            </div>

            <div class="event_buttons">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <a class="btn btn-event-link btn-lg" href="<?php echo e($event->event_url); ?>#tickets"><?php echo app('translator')->getFromJson("Public_ViewEvent.TICKETS"); ?></a>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <a class="btn btn-event-link btn-lg" href="<?php echo e($event->event_url); ?>#details"><?php echo app('translator')->getFromJson("Public_ViewEvent.DETAILS"); ?></a>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <a class="btn btn-event-link btn-lg" href="<?php echo e($event->event_url); ?>#location"><?php echo app('translator')->getFromJson("Public_ViewEvent.LOCATION"); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/Public/ViewEvent/Partials/EventHeaderSection.blade.php ENDPATH**/ ?>