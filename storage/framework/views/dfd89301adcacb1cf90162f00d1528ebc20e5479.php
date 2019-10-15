<aside class="sidebar sidebar-left sidebar-menu">
    <section class="content">
        <h5 class="heading"><?php echo app('translator')->getFromJson("Organiser.organiser_menu"); ?></h5>

        <ul id="nav" class="topmenu">
            <li class="<?php echo e(Request::is('*dashboard*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('showOrganiserDashboard', array('organiser_id' => $organiser->id))); ?>">
                    <span class="figure"><i class="ico-home2"></i></span>
                    <span class="text"><?php echo app('translator')->getFromJson("Organiser.dashboard"); ?></span>
                </a>
            </li>
            <li class="<?php echo e(Request::is('*events*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('showOrganiserEvents', array('organiser_id' => $organiser->id))); ?>">
                    <span class="figure"><i class="ico-calendar"></i></span>
                    <span class="text"><?php echo app('translator')->getFromJson("Organiser.event"); ?></span>
                </a>
            </li>

            <li class="<?php echo e(Request::is('*customize*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('showOrganiserCustomize', array('organiser_id' => $organiser->id))); ?>">
                    <span class="figure"><i class="ico-cog"></i></span>
                    <span class="text"><?php echo app('translator')->getFromJson("Organiser.customize"); ?></span>
                </a>
            </li>
        </ul>
    </section>
</aside>
<?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageOrganiser/Partials/Sidebar.blade.php ENDPATH**/ ?>