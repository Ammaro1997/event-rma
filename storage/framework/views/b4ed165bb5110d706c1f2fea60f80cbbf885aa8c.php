<html>
    <head>

        <title><?php echo $__env->yieldContent('title'); ?></title>

        <?php echo $__env->make('Shared/Layouts/ViewJavascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('Shared.Partials.GlobalMeta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!--JS-->
       <?php echo HTML::script('vendor/jquery/dist/jquery.min.js'); ?>

        <!--/JS-->

        <!--Style-->
       <?php echo HTML::style('assets/stylesheet/application.css'); ?>

        <!--/Style-->

        <?php echo $__env->yieldContent('head'); ?>

        <style>

            body {
                background: url(<?php echo e(asset('assets/images/background.png')); ?>) repeat;
                background-color: #2E3254;
            }

            h2 {
                text-align: center;
                margin-bottom: 31px;
                text-transform: uppercase;
                letter-spacing: 4px;
                font-size: 23px;
            }
            .panel {
                background-color: #ffffff;
                background-color: rgba(255,255,255,.95);
                padding: 15px 30px ;
                border: none;
                color: #333;
                box-shadow: 0 0 5px 0 rgba(0,0,0,.2);
                margin-top: 40px;
            }

            .panel a {
                color: #333;
                font-weight: 600;
            }

            .logo {
                text-align: center;
                margin-bottom: 20px;
            }

            .logo img {
                width: 200px;
            }

            .signup {
                margin-top: 10px;
            }

            .forgotPassword {
                font-size: 12px;
                color: #ccc;
            }
        </style>
    </head>
    <body>
        <section id="main" role="main">
            <section class="container">
                <?php echo $__env->yieldContent('content'); ?>
            </section>

        </section>
        <div style="text-align: center; color: white" >
        </div>

        <?php echo $__env->make("Shared.Partials.LangScript", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo HTML::script('assets/javascript/backend.js'); ?>

    </body>
    <?php echo $__env->make('Shared.Partials.GlobalFooterJS', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</html>
<?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/Shared/Layouts/MasterWithoutMenus.blade.php ENDPATH**/ ?>