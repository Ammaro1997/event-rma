<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo e($organiser->name); ?> - PT. Tech Mahindra Indonesia</title>


        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" />


        <!-- Open Graph data -->
        <meta property="og:title" content="<?php echo e($organiser->name); ?>" />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="<?php echo e(URL::to('')); ?>" />
        <meta property="og:image" content="<?php echo e(URL::to($organiser->full_logo_path)); ?>" />
        <meta property="og:description" content="<?php echo e(Str::words(strip_tags($organiser->description)), 20); ?>" />
        <meta property="og:site_name" content="https://www.rmagroup.net/" />
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

       <?php echo HTML::style('assets/stylesheet/frontend.css'); ?>

        <?php echo $__env->yieldContent('head'); ?>
    </head>
    <body class="attendize">
        <?php echo $__env->make('Shared.Partials.FacebookSdk', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div id="organiser_page_wrap">
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <a href="#intro" style="display:none;" class="totop"><i class="ico-angle-up"></i>
            <span style="font-size:11px;"><?php echo app('translator')->getFromJson("basic.TOP"); ?></span></a>

        <?php echo $__env->make("Shared.Partials.LangScript", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo HTML::script('assets/javascript/frontend.js'); ?>


        <?php echo $__env->make('Shared.Partials.GlobalFooterJS', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->yieldContent('foot'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/Public/ViewOrganiser/Layouts/OrganiserPage.blade.php ENDPATH**/ ?>