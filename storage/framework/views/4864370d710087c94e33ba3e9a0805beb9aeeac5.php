<div class="panel panel-success event">
    <div class="panel-heading" data-style="background-color: <?php echo e($event->bg_color); ?>;background-image: url(<?php echo e($event->bg_image_url); ?>); background-size: cover;">
        <div class="event-date">
            <div class="month">
                <?php echo e(strtoupper(explode("|", trans("basic.months_short"))[$event->start_date->format('n')])); ?>

            </div>
            <div class="day">
                <?php echo e($event->start_date->format('d')); ?>

            </div>
        </div>
        <ul class="event-meta">
            <li class="event-title">
                <a title="<?php echo e($event->title); ?>" href="<?php echo e(route('showEventDashboard', ['event_id'=>$event->id])); ?>">
                    <?php echo e(str_limit($event->title, $limit = 75, $end = '...')); ?>

                </a>
            </li>
            <li class="event-organiser">
                By <a href='<?php echo e(route('showOrganiserDashboard', ['organiser_id' => $event->organiser->id])); ?>'><?php echo e($event->organiser->name); ?></a>
            </li>
        </ul>

    </div>

    <div class="panel-body">
        <ul class="nav nav-section nav-justified mt5 mb5">
            <li>
                <div class="section">
                    <h4 class="nm"><?php echo e($event->tickets->sum('quantity_sold')); ?></h4>
                    <p class="nm text-muted"><?php echo app('translator')->getFromJson("Event.tickets_sold"); ?></p>
                </div>
            </li>

            <li>
                <div class="section">
                    <h4 class="nm"><?php echo e(money($event->sales_volume + $event->organiser_fees_volume, $event->currency)); ?></h4>
                    <p class="nm text-muted"><?php echo app('translator')->getFromJson("Event.revenue"); ?></p>
                </div>
            </li>
        </ul>
    </div>
    <div class="panel-footer">
        <ul class="nav nav-section nav-justified">
            <li>
                <a href="<?php echo e(route('showEventCustomize', ['event_id' => $event->id])); ?>">
                    <i class="ico-edit"></i> <?php echo app('translator')->getFromJson("basic.edit"); ?>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('showEventDashboard', ['event_id' => $event->id])); ?>">
                    <i class="ico-cog"></i> <?php echo app('translator')->getFromJson("basic.manage"); ?>
                </a>
            </li>
        </ul>
    </div>
</div><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageOrganiser/Partials/EventPanel.blade.php ENDPATH**/ ?>