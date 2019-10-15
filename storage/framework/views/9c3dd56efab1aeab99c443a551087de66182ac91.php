<?php $__env->startSection('title'); ?>
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
    <?php echo app('translator')->getFromJson("Organiser.dashboard"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('top_nav'); ?>
    <?php echo $__env->make('ManageOrganiser.Partials.TopNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_title'); ?>
    <?php echo app('translator')->getFromJson("Organiser.organiser_name_dashboard", ["name"=>$organiser->name]); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('menu'); ?>
    <?php echo $__env->make('ManageOrganiser.Partials.Sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" integrity="sha256-szHusaozbQctTn4FX+3l5E0A5zoxz7+ne4fr8NgWJlw=" crossorigin="anonymous" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js" integrity="sha256-Gk+dzc4kV2rqAZMkyy3gcfW6Xd66BhGYjVWa/FjPu+s=" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js" integrity="sha256-0rg2VtfJo3VUij/UY9X0HJP7NET6tgAY98aMOfwP0P8=" crossorigin="anonymous"></script>

    <?php echo HTML::script('https://maps.googleapis.com/maps/api/js?libraries=places&key='.config("attendize.google_maps_geocoding_key")); ?>

    <?php echo HTML::script('vendor/geocomplete/jquery.geocomplete.min.js'); ?>

    <?php echo HTML::script('vendor/moment/moment.js'); ?>

    <?php echo HTML::script('vendor/fullcalendar/dist/fullcalendar.min.js'); ?>

    <?php
    if(Lang::locale()!="en")
        echo HTML::script('vendor/fullcalendar/dist/lang/'.Lang::locale().'.js');
    ?>
    <?php echo HTML::style('vendor/fullcalendar/dist/fullcalendar.css'); ?>


    <script>
        $(function() {
            $('#calendar').fullCalendar({
                locale: '<?php echo e(Lang::locale()); ?>',
                events: <?php echo $calendar_events; ?>,
                header: {
                    left:   'prev,',
                    center: 'title',
                    right:  'next'
                },
                dayClick: function(date, jsEvent, view) {

                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-6">
            <div class="stat-box">
                <h3>
                    <?php echo e($organiser->events->count()); ?>

                </h3>
            <span>
                <?php echo app('translator')->getFromJson("Organiser.events"); ?>
            </span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="stat-box">
                <h3>
                    <?php echo e($organiser->attendees->count()); ?>

                </h3>
            <span>
                <?php echo app('translator')->getFromJson("Organiser.tickets_sold"); ?>
            </span>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-8">

            <h4 style="margin-bottom: 25px;margin-top: 20px;"><?php echo app('translator')->getFromJson("Organiser.event_calendar"); ?></h4>
            <div id="calendar"></div>


            <h4 style="margin-bottom: 25px;margin-top: 20px;"><?php echo app('translator')->getFromJson("Public_ViewOrganiser.upcoming_events"); ?></h4>
            <?php if($upcoming_events->count()): ?>
                <?php $__currentLoopData = $upcoming_events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('ManageOrganiser.Partials.EventPanel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="alert alert-success alert-lg">
                    <?php echo app('translator')->getFromJson("Organiser.no_upcoming_events"); ?> <a href="#"
                                                     data-href="<?php echo e(route('showCreateEvent', ['organiser_id' => $organiser->id])); ?>"
                                                     class=" loadModal"><?php echo app('translator')->getFromJson("Organiser.no_upcoming_events_click"); ?></a>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-4">
            <h4 style="margin-bottom: 25px;margin-top: 20px;"><?php echo app('translator')->getFromJson("Order.recent_orders"); ?></h4>
            <?php if($organiser->orders->count()): ?>
                <ul class="list-group">
                    <?php $__currentLoopData = $organiser->orders()->orderBy('created_at', 'desc')->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item">
                            <h6 class="ellipsis">
                                <a href="<?php echo e(route('showEventDashboard', ['event_id' => $order->event->id])); ?>">
                                    <?php echo e($order->event->title); ?>

                                </a>
                            </h6>
                            <p class="list-group-text">
                                <a href="<?php echo e(route('showEventOrders', ['event_id' => $order->event_id, 'q' => $order->order_reference])); ?>">
                                    <b>#<?php echo e($order->order_reference); ?></b></a> -
                                <a href="<?php echo e(route('showEventAttendees', ['event_id'=>$order->event->id,'q'=>$order->order_reference])); ?>">
                                    <strong><?php echo e($order->full_name); ?></strong>
                                </a> <?php echo e(@trans("Order.registered")); ?>

                                    <?php echo e($order->attendees()->withTrashed()->count()); ?> <?php echo e(@trans("Order.tickets")); ?>

                            </p>
                            <h6>
                                <?php echo e($order->created_at->diffForHumans()); ?> &bull; <span
                                        style="color: green;"><?php echo e($order->event->currency_symbol); ?><?php echo e($order->amount); ?></span>
                            </h6>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div class="alert alert-success alert-lg">
                            <?php echo app('translator')->getFromJson("Order.no_recent_orders"); ?>
                        </div>
                    <?php endif; ?>
                </ul>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Shared.Layouts.Master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageOrganiser/Dashboard.blade.php ENDPATH**/ ?>