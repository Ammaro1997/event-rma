<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->getFromJson("Organiser.create_organiser"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>
    <style>
        .modal-header {
            background-color: transparent !important;
            color: #666 !important;
            text-shadow: none !important;;
        }
    </style>
    <script>
    <?php echo $__env->make('ManageOrganiser.Partials.OrganiserCreateAndEditJS', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            <div class="panel">
                <div class="panel-body">
                    <div class="logo">
                        <?php echo HTML::image('assets/images/logo-rma1.png'); ?>

                    </div>
                    <h2><?php echo app('translator')->getFromJson("Organiser.create_organiser"); ?></h2>

                    <?php echo Form::open(array('url' => route('postCreateOrganiser'), 'class' => 'ajax')); ?>

                    <?php if(@$_GET['first_run'] == '1'): ?>
                        <div class="alert alert-info">
                            <?php echo app('translator')->getFromJson("Organiser.create_organiser_text"); ?>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('name', trans("Organiser.organiser_name"), array('class'=>'required control-label ')); ?>

                                <?php echo Form::text('name', Input::old('name'),
                                            array(
                                            'class'=>'form-control'
                                            )); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('email', trans("Organiser.organiser_email"), array('class'=>'control-label required')); ?>

                                <?php echo Form::text('email', Input::old('email'),
                                            array(
                                            'class'=>'form-control ',
                                            'placeholder'=>trans("Organiser.organiser_email_placeholder")
                                            )); ?>

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo Form::label('about', trans("Organiser.organiser_description"), array('class'=>'control-label ')); ?>

                        <?php echo Form::textarea('about', Input::old('about'),
                                    array(
                                    'class'=>'form-control ',
                                    'placeholder'=>trans("Organiser.organiser_description_placeholder"),
                                    'rows' => 4
                                    )); ?>

                    </div>
                    <div class="form-group">
                        <p class="control-label"><?php echo trans("Organiser.organiser_tax_prompt"); ?></p>
                        <?php echo Form::label('Yes', 'Yes', array('class'=>'control-label', 'id' => 'charge_yes')); ?>

                        <?php echo e(Form::radio('charge_tax', '1' , false)); ?>

                        <?php echo Form::label('No', 'No', array('class'=>'control-label','id' => 'charge_no')); ?>

                        <?php echo e(Form::radio('charge_tax', '0' , true)); ?>

                    </div>

                    <div id="tax_fields" class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('tax_id', trans("Organiser.organiser_tax_id"), array('class'=>'control-label required')); ?>

                                <?php echo Form::text('tax_id', Input::old('tax_id'), array('class'=>'form-control', 'placeholder'=>'Tax ID')); ?>

                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('tax_name', trans("Organiser.organiser_tax_name"), array('class'=>'control-label required')); ?>

                                <?php echo Form::text('tax_name', Input::old('tax_name'), array('class'=>'form-control', 'placeholder'=>'Tax name')); ?>

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('tax_value', trans("Organiser.organiser_tax_value"), array('class'=>'control-label required')); ?>

                                <?php echo Form::text('tax_value', Input::old('tax_value'), array('class'=>'form-control', 'placeholder'=>'Tax Value')); ?>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('facebook', trans("Organiser.organiser_facebook"), array('class'=>'control-label ')); ?>


                                <div class="input-group">
                                    <span style="background-color: #eee;" class="input-group-addon">facebook.com/</span>
                                    <?php echo Form::text('facebook', Input::old('facebook'),
                                                    array(
                                                    'class'=>'form-control ',
                                                    'placeholder'=>trans("Organiser.organiser_username_facebook_placeholder")
                                                    )); ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('twitter', trans("Organiser.organiser_twitter"), array('class'=>'control-label ')); ?>


                                <div class="input-group">
                                    <span style="background-color: #eee;" class="input-group-addon">twitter.com/</span>
                                    <?php echo Form::text('twitter', Input::old('twitter'),
                                             array(
                                             'class'=>'form-control ',
                                                    'placeholder'=>trans("Organiser.organiser_username_twitter_placeholder")
                                             )); ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo Form::label('organiser_logo', trans("Organiser.organiser_logo"), array('class'=>'control-label ')); ?>

                        <?php echo Form::styledFile('organiser_logo'); ?>

                    </div>

                    <?php echo Form::submit(trans("Organiser.create_organiser"), ['class'=>" btn-block btn btn-success"]); ?>

                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Shared.Layouts.MasterWithoutMenus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageOrganiser/CreateOrganiser.blade.php ENDPATH**/ ?>