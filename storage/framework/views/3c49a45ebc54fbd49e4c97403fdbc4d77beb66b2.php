<div role="dialog"  class="modal fade" style="display: none;">
    <?php echo Form::model($user, array('url' => route('postEditUser'), 'class' => 'ajax closeModalAfter')); ?>

        <div class="modal-dialog account_settings">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">
                        <i class="ico-user"></i>
                        <?php echo app('translator')->getFromJson("User.my_profile"); ?></h3>
                </div>
                <div class="modal-body">
                    <?php if(!Auth::user()->first_name): ?>
                        <div class="alert alert-info">
                            <b>
                                <?php echo app('translator')->getFromJson("User.welcome_to_app", ["app"=>config('attendize.app_name')]); ?>
                            </b><br>
                            <?php echo app('translator')->getFromJson("User.after_welcome"); ?>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('first_name', trans("User.first_name"), array('class'=>'control-label required')); ?>

                                <?php echo Form::text('first_name', Input::old('first_name'),
                                            array(
                                            'class'=>'form-control'
                                            )); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('last_name', trans("User.last_name"), array('class'=>'control-label required')); ?>

                                <?php echo Form::text('last_name', Input::old('last_name'),
                                            array(
                                            'class'=>'form-control'
                                            )); ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo Form::label('email', trans("User.email"), array('class'=>'control-label required')); ?>

                                <?php echo Form::text('email', Input::old('email'),
                                            array(
                                            'class'=>'form-control '
                                            )); ?>

                            </div>
                        </div>
                    </div>

                    <div class="row more-options">
                        <div class="col-md-12">

                            <div class="form-group">
                                <?php echo Form::label('password', trans("User.old_password"), array('class'=>'control-label')); ?>

                                <?php echo Form::password('password',
                                            array(
                                            'class'=>'form-control'
                                            )); ?>

                            </div>
                            <div class="form-group">
                                <?php echo Form::label('new_password', trans("User.new_password"), array('class'=>'control-label')); ?>

                                <?php echo Form::password('new_password',
                                            array(
                                            'class'=>'form-control'
                                            )); ?>

                            </div>
                            <div class="form-group">
                                <?php echo Form::label('new_password_confirmation', trans("User.confirm_new_password"), array('class'=>'control-label')); ?>

                                <?php echo Form::password('new_password_confirmation',
                                            array(
                                            'class'=>'form-control'
                                            )); ?>

                            </div>
                        </div>
                    </div>
                    <a data-show-less-text='<?php echo app('translator')->getFromJson("User.hide_change_password"); ?>' href="javascript:void(0);" class="in-form-link show-more-options">
                        <?php echo app('translator')->getFromJson("User.change_password"); ?>
                    </a>
                </div>
                <div class="modal-footer">
                   <?php echo Form::button(trans("basic.cancel"), ['class'=>"btn modal-close btn-danger",'data-dismiss'=>'modal']); ?>

                   <?php echo Form::submit(trans("basic.save_details"), ['class' => 'btn btn-success pull-right']); ?>

                </div>
            </div>
        </div>
    <?php echo Form::close(); ?>

</div>
<?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageUser/Modals/EditUser.blade.php ENDPATH**/ ?>