<aside class="sidebar sidebar-left sidebar-menu">
    <section class="content">
        <h5 class="heading"><?php echo app('translator')->getFromJson("basic.main_menu"); ?></h5>
        <ul id="nav_main" class="topmenu">
            <li>
                <a href="<?php echo e(route('showOrganiserDashboard', ['organiser_id' => $event->organiser->id])); ?>">
                    <span class="figure"><i class="ico-arrow-left"></i></span>
                    <span class="text"><?php echo app('translator')->getFromJson("basic.back_to_page", ["page"=>$event->organiser->name]); ?></span>
                </a>
            </li>
        </ul>
        <h5 class="heading"><?php echo app('translator')->getFromJson('basic.event_menu'); ?></h5>
        <ul id="nav_event" class="topmenu">
            <li class="<?php echo e(Request::is('*dashboard*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('showEventDashboard', array('event_id' => $event->id))); ?>">
                    <span class="figure"><i class="ico-home2"></i></span>
                    <span class="text"><?php echo app('translator')->getFromJson("basic.dashboard"); ?></span>
                </a>
            </li>
            <li class="<?php echo e(Request::is('*tickets*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('showEventTickets', array('event_id' => $event->id))); ?>">
                    <span class="figure"><i class="ico-ticket"></i></span>
                    <span class="text"><?php echo app('translator')->getFromJson("basic.tickets"); ?></span>
                </a>
            </li>
            <li class="<?php echo e(Request::is('*orders*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('showEventOrders', array('event_id' => $event->id))); ?>">
                    <span class="figure"><i class="ico-cart"></i></span>
                    <span class="text"><?php echo app('translator')->getFromJson("basic.orders"); ?></span>
                </a>
            </li>
            <li class="<?php echo e(Request::is('*attendees*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('showEventAttendees', array('event_id' => $event->id))); ?>">
                    <span class="figure"><i class="ico-user"></i></span>
                    <span class="text"><?php echo app('translator')->getFromJson("basic.attendees"); ?></span>
                </a>
            </li>
            <li class="<?php echo e(Request::is('*promote*') ? 'active' : ''); ?> hide">
                <a href="<?php echo e(route('showEventPromote', array('event_id' => $event->id))); ?>">
                    <span class="figure"><i class="ico-bullhorn"></i></span>
                    <span class="text"><?php echo app('translator')->getFromJson("basic.promote"); ?></span>
                </a>
            </li>
            <li class="<?php echo e(Request::is('*customize*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('showEventCustomize', array('event_id' => $event->id))); ?>">
                    <span class="figure"><i class="ico-cog"></i></span>
                    <span class="text"><?php echo app('translator')->getFromJson("basic.customize"); ?></span>
                </a>
            </li>
        </ul>
        <h5 class="heading"><?php echo app('translator')->getFromJson("ManageEvent.event_tools"); ?></h5>
        <ul id="nav_event" class="topmenu">
            <li class="<?php echo e(Request::is('*check_in*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('showCheckIn', array('event_id' => $event->id))); ?>">
                    <span class="figure"><i class="ico-checkbox-checked"></i></span>
                    <span class="text"><?php echo app('translator')->getFromJson("ManageEvent.check-in"); ?></span>
                </a>
            </li>
            <li class="<?php echo e(Request::is('*surveys*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('showEventSurveys', array('event_id' => $event->id))); ?>">
                    <span class="figure"><i class="ico-question"></i></span>
                    <span class="text"><?php echo app('translator')->getFromJson("ManageEvent.surveys"); ?></span>
                </a>
            </li>
            <li class="<?php echo e(Request::is('*widgets*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('showEventWidgets', array('event_id' => $event->id))); ?>">
                    <span class="figure"><i class="ico-code"></i></span>
                    <span class="text"><?php echo app('translator')->getFromJson("ManageEvent.widgets"); ?></span>
                </a>
            </li>
            <li class="<?php echo e(Request::is('*access_codes*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('showEventAccessCodes', [ 'event_id' => $event->id ])); ?>">
                    <span class="figure"><i class="ico-money"></i></span>
                    <span class="text"><?php echo app('translator')->getFromJson("AccessCodes.title"); ?></span>
                </a>
            </li>
        </ul>
    </section>
</aside>
<?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageEvent/Partials/Sidebar.blade.php ENDPATH**/ ?>