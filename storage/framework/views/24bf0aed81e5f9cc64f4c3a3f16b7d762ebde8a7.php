
<div class="row">
    <div class="col-md-12">
        <h1 class="event-listing-heading"><?php echo e($panel_title); ?></h1>
        <ul class="event-list">

            <?php if(count($events)): ?>

                <?php $__currentLoopData = $events->where('is_live', 1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <time datetime="<?php echo e($event->start_date); ?>">
                            <span class="day"><?php echo e($event->start_date->format('d')); ?></span>
                            <span class="month"><?php echo e(explode("|", trans("basic.months_short"))[$event->start_date->format('n')]); ?></span>
                            <span class="year"><?php echo e($event->start_date->format('Y')); ?></span>
                            <span class="time"><?php echo e($event->start_date->format('h:i')); ?></span>
                        </time>
                        <?php if(count($event->images)): ?>
                        <img class="hide" alt="<?php echo e($event->title); ?>" src="<?php echo e(asset($event->images->first()['image_path'])); ?>"/>
                        <?php endif; ?>
                        <div class="info">
                            <h2 class="title ellipsis">
                               <a href="<?php echo e($event->event_url); ?>"><?php echo e($event->title); ?></a>
                            </h2>
                            <p class="desc ellipsis"><?php echo e($event->venue_name); ?></p>
                            <ul>
                                <li style="width:50%;"><a href="<?php echo e($event->event_url); ?>"><?php echo app('translator')->getFromJson("Public_ViewOrganiser.tickets"); ?></a></li>
                                <li style="width:50%;"><a href="<?php echo e($event->event_url); ?>"><?php echo app('translator')->getFromJson("Public_ViewOrganiser.information"); ?></a></li>
                            </ul>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="alert alert-info">
                    <?php echo app('translator')->getFromJson("Public_ViewOrganiser.no_events", ["panel_title"=>$panel_title]); ?>
                </div>
            <?php endif; ?>

        </ul>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/Public/ViewOrganiser/Partials/EventListingPanel.blade.php ENDPATH**/ ?>