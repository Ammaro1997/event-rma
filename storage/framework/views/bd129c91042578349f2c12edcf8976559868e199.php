<?php $__env->startSection('title', trans("User.login")); ?>

<?php $__env->startSection('content'); ?>
    <?php echo Form::open(array('url' => route("login"))); ?>

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel">
                <div class="panel-body">
                    <div class="logo">
                        <?php echo HTML::image('assets/images/logo-rma1.png'); ?>

                    </div>

                    <?php if(Session::has('failed')): ?>
                        <h4 class="text-danger mt0"><?php echo app('translator')->getFromJson("basic.whoops"); ?>! </h4>
                        <ul class="list-group">
                            <li class="list-group-item"><?php echo app('translator')->getFromJson("User.login_fail_msg"); ?></li>
                        </ul>
                    <?php endif; ?>

                    <div class="form-group">
                        <?php echo Form::label('email', trans("User.email"), ['class' => 'control-label']); ?>

                        <?php echo Form::text('email', null, ['class' => 'form-control', 'autofocus' => true]); ?>

                    </div>
                    <div class="form-group">
                        <?php echo Form::label('password', trans("User.password"), ['class' => 'control-label']); ?>

                        (<a class="forgotPassword" href="<?php echo e(route('forgotPassword')); ?>" tabindex="-1"><?php echo app('translator')->getFromJson("User.forgot_password?"); ?></a>)
                        <?php echo Form::password('password',  ['class' => 'form-control']); ?>

                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-success"><?php echo app('translator')->getFromJson("User.login"); ?></button>
                    </div>

                    <?php if(Utils::isAttendize()): ?>
                    <div class="signup">
                        <span><?php echo app('translator')->getFromJson("User.dont_have_account_button", ["url"=> route('showSignup')]); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Shared.Layouts.MasterWithoutMenus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/Public/LoginAndRegister/Login.blade.php ENDPATH**/ ?>