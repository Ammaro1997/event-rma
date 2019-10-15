<!DOCTYPE html>
<html lang="<?php echo e(Lang::locale()); ?>">
<head>
    <!--
              _   _                 _ _
         /\  | | | |               | (_)
        /  \ | |_| |_ ___ _ __   __| |_ _______   ___ ___  _ __ ___
       / /\ \| __| __/ _ \ '_ \ / _` | |_  / _ \ / __/ _ \| '_ ` _ \
      / ____ \ |_| ||  __/ | | | (_| | |/ /  __/| (_| (_) | | | | | |
     /_/    \_\__|\__\___|_| |_|\__,_|_/___\___(_)___\___/|_| |_| |_|

    -->
    <title>
        <?php $__env->startSection('title'); ?>
            Attendize -
        <?php echo $__env->yieldSection(); ?>
    </title>

    <?php echo $__env->make('Shared.Layouts.ViewJavascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--Meta-->
    <?php echo $__env->make('Shared.Partials.GlobalMeta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   <!--/Meta-->

    <!--JS-->
    <?php echo HTML::script(config('attendize.cdn_url_static_assets').'/vendor/jquery/dist/jquery.min.js'); ?>

    <!--/JS-->

    <!--Style-->
    <?php echo HTML::style(config('attendize.cdn_url_static_assets').'/assets/stylesheet/application.css'); ?>

    <!--/Style-->

    <?php echo $__env->yieldContent('head'); ?>
</head>
<body class="attendize">
<?php echo $__env->yieldContent('pre_header'); ?>
<header id="header" class="navbar">

    <div class="navbar-header">
        <a class="navbar-brand" href="javascript:void(0);">
            <img style="width: 150px;" class="logo" alt="Attendize" src="<?php echo e(asset('assets/images/logo-rma1.png')); ?>"/>
        </a>
    </div>

    <div class="navbar-toolbar clearfix">
        <?php echo $__env->yieldContent('top_nav'); ?>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown profile">

                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="meta">
                        <span class="text "><?php echo e(isset($organiser->name) ? $organiser->name : $event->organiser->name); ?></span>
                        <span class="arrow"></span>
                    </span>
                </a>


                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="<?php echo e(route('showCreateOrganiser')); ?>">
                            <i class="ico ico-plus"></i>
                            <?php echo app('translator')->getFromJson("Top.create_organiser"); ?>
                        </a>
                    </li>
                    <?php $__currentLoopData = $organisers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $org): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(route('showOrganiserDashboard', ['organiser_id' => $org->id])); ?>">
                                <i class="ico ico-building"></i> &nbsp;
                                <?php echo e($org->name); ?>

                            </a>

                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <li class="divider"></li>

                    <li>
                        <a data-href="<?php echo e(route('showEditUser')); ?>" data-modal-id="EditUser"
                           class="loadModal editUserModal" href="javascript:void(0);"><span class="icon ico-user"></span><?php echo app('translator')->getFromJson("Top.my_profile"); ?></a>
                    </li>
                    <li class="divider"></li>
                    <li><a data-href="<?php echo e(route('showEditAccount')); ?>" data-modal-id="EditAccount" class="loadModal"
                           href="javascript:void(0);"><span class="icon ico-cog"></span><?php echo app('translator')->getFromJson("Top.account_settings"); ?></a></li>


                    <li class="divider"></li>
                    <li><a target="_blank" href="https://github.com/Attendize/Attendize/issues/new?body=Version%20<?php echo e(config('attendize.version')); ?>"><span class="icon ico-megaphone"></span><?php echo app('translator')->getFromJson("Top.feedback_bug_report"); ?></a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo e(route('logout')); ?>"><span class="icon ico-exit"></span><?php echo app('translator')->getFromJson("Top.sign_out"); ?></a></li>
                </ul>
            </li>
        </ul>
    </div>
</header>

<?php echo $__env->yieldContent('menu'); ?>

<!--Main Content-->
<section id="main" role="main">
    <div class="container-fluid">
        <div class="page-title">
            <h1 class="title"><?php echo $__env->yieldContent('page_title'); ?></h1>
        </div>
        <?php if(array_key_exists('page_header', View::getSections())): ?>
        <!--  header -->
        <div class="page-header page-header-block row">
            <div class="row">
                <?php echo $__env->yieldContent('page_header'); ?>
            </div>
        </div>
        <!--/  header -->
        <?php endif; ?>

        <!--Content-->
        <?php echo $__env->yieldContent('content'); ?>
        <!--/Content-->
    </div>

    <!--To The Top-->
    <a href="#" style="display:none;" class="totop"><i class="ico-angle-up"></i></a>
    <!--/To The Top-->

</section>
<!--/Main Content-->

<!--JS-->
<?php echo $__env->make("Shared.Partials.LangScript", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo HTML::script('assets/javascript/backend.js'); ?>

<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
    });

    <?php if(!Auth::user()->first_name): ?>
      setTimeout(function () {
        $('.editUserModal').click();
    }, 1000);
    <?php endif; ?>

</script>
<!--/JS-->
<?php echo $__env->yieldContent('foot'); ?>

<?php echo $__env->make('Shared.Partials.GlobalFooterJS', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/Shared/Layouts/Master.blade.php ENDPATH**/ ?>