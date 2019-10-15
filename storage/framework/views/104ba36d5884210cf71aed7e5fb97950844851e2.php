<?php $__env->startSection('title'); ?>
<?php echo app('translator')->getFromJson("User.forgot_password"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            <?php echo Form::open(array('url' => route('postForgotPassword'), 'class' => 'panel')); ?>


            <div class="panel-body">

                <div class="logo">
                   <?php echo HTML::image('assets/images/logo-rma1.png'); ?>

                </div>
                <h2><?php echo app('translator')->getFromJson("User.forgot_password"); ?></h2>

                <?php if(Session::has('status')): ?>
                <div class="alert alert-info">
                    <?php echo app('translator')->getFromJson("User.password_already_sent"); ?>
                </div>
                <?php else: ?>

                <?php if(Session::has('error')): ?>
                <h4 class="text-danger mt0"><?php echo app('translator')->getFromJson("basic.whoops"); ?></h4>
                <ul class="list-group">
                    <li class="list-group-item"><?php echo e(Session::get('error')); ?></li>
                </ul>
                <?php endif; ?>

                <div class="form-group">
                   <?php echo Form::label('email', trans("User.your_email")); ?>

                   <?php echo Form::text('email', null, ['class' => 'form-control', 'autofocus' => true]); ?>

                </div>

                <div class="form-group nm">
                    <button type="submit" class="btn btn-block btn-success"><?php echo app('translator')->getFromJson("basic.submit"); ?></button>
                </div>
                <div class="signup">
                    <a class="semibold" href="<?php echo e(route('login')); ?>">
                        <i class="ico ico-arrow-left"></i> <?php echo app('translator')->getFromJson("basic.back_to_login"); ?>
                    </a>
                </div>
            </div>
            <?php echo Form::close(); ?>

            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Shared.Layouts.MasterWithoutMenus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/Public/LoginAndRegister/ForgotPassword.blade.php ENDPATH**/ ?>