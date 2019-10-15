<div role="dialog"  class="modal fade" style="display: none;">
    <style>
        .account_settings .modal-body {
            border: 0;
            margin-bottom: -35px;
            border: 0;
            padding: 0;
        }

        .account_settings .panel-footer {
            margin: -15px;
            margin-top: 20px;
        }

        .account_settings .panel {
            margin-bottom: 0;
            border: 0;
        }
    </style>
    <div class="modal-dialog account_settings">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">
                    <i class="ico-cogs"></i>
                    <?php echo app('translator')->getFromJson("ManageAccount.account"); ?></h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- tab -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#general_account" data-toggle="tab"><?php echo app('translator')->getFromJson("ManageAccount.general"); ?></a></li>
                            <li><a href="#payment_account" data-toggle="tab"><?php echo app('translator')->getFromJson("ManageAccount.payment"); ?></a></li>
                            <li><a href="#users_account" data-toggle="tab"><?php echo app('translator')->getFromJson("ManageAccount.users"); ?></a></li>
                            <li><a href="#about" data-toggle="tab"><?php echo app('translator')->getFromJson("ManageAccount.about"); ?></a></li>
                        </ul>
                        <div class="tab-content panel">
                            <div class="tab-pane active" id="general_account">
                                <?php echo Form::model($account, array('url' => route('postEditAccount'), 'class' => 'ajax ')); ?>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo Form::label('first_name', trans("ManageAccount.first_name"), array('class'=>'control-label required')); ?>

                                            <?php echo Form::text('first_name', Input::old('first_name'),
                                        array(
                                        'class'=>'form-control'
                                        )); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo Form::label('last_name', trans("ManageAccount.last_name"), array('class'=>'control-label required')); ?>

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
                                            <?php echo Form::label('email', trans("ManageAccount.email"), array('class'=>'control-label required')); ?>

                                            <?php echo Form::text('email', Input::old('email'),
                                        array(
                                        'class'=>'form-control'
                                        )); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo Form::label('timezone_id', trans("ManageAccount.timezone"), array('class'=>'control-label required')); ?>

                                            <?php echo Form::select('timezone_id', $timezones, $account->timezone_id, ['class' => 'form-control']); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo Form::label('currency_id', trans("ManageAccount.default_currency"), array('class'=>'control-label required')); ?>

                                            <?php echo Form::select('currency_id', $currencies, $account->currency_id, ['class' => 'form-control']); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel-footer">
                                            <?php echo Form::submit(trans("ManageAccount.save_account_details_submit"), ['class' => 'btn btn-success pull-right']); ?>

                                        </div>
                                    </div>
                                </div>

                                <?php echo Form::close(); ?>

                            </div>
                            <div class="tab-pane " id="payment_account">

                                <?php echo $__env->make('ManageAccount.Partials.PaymentGatewayOptions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            </div>
                            <div class="tab-pane" id="users_account">
                                <?php echo Form::open(array('url' => route('postInviteUser'), 'class' => 'ajax ')); ?>


                                <div class="table-responsive">
                                    <table class="table table-bordered">

                                        <tbody>
                                        <?php $__currentLoopData = $account->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($user->email); ?>

                                                </td>
                                                <td>
                                                    <?php echo $user->is_parent ? '<span class="label label-info">'.trans("ManageAccount.accout_owner").'</span>' : ''; ?>

                                                </td>

                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td colspan="3">
                                                <div class="input-group">
                                                    <?php echo Form::text('email', '',  ['class' => 'form-control', 'placeholder' => trans("ManageAccount.email_address_placeholder")]); ?>

                                                    <span class="input-group-btn">
                                                          <?php echo Form::submit(trans("ManageAccount.add_user_submit"), ['class' => 'btn btn-primary']); ?>

                                                    </span>
                                                </div>
                                                <span class="help-block">
                                                    <?php echo app('translator')->getFromJson("ManageAccount.add_user_help_block"); ?>
                                                </span>
                                            </td>

                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <?php echo Form::close(); ?>

                            </div>
                            <div class="tab-pane " id="about">
                                <h4>
                                    <?php echo app('translator')->getFromJson("ManageAccount.version_info"); ?>
                                </h4>
                                <p>
                                    <?php if($version_info['is_outdated']): ?>
                                        <?php echo app('translator')->getFromJson("ManageAccount.version_out_of_date", ["installed" => $version_info['installed'], "latest"=> $version_info['latest'], "url"=>"https://www.rmagroup.net/"]); ?>.
                                    <?php else: ?>
                                        <?php echo app('translator')->getFromJson("ManageAccount.version_up_to_date", ["installed" => $version_info['installed']]); ?>
                                    <?php endif; ?>
                                </p>
                                <h4>
                                    <?php echo @trans("ManageAccount.licence_info"); ?>

                                </h4>
                                <p>
                                    <?php echo @trans("ManageAccount.licence_info_description"); ?>

                                </p>
                                <h4>
                                    <?php echo @trans("ManageAccount.open_source_soft"); ?> Open-source Software
                                </h4>
                                <p>
                                    <?php echo @trans("ManageAccount.open_source_soft_description"); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageAccount/Modals/EditAccount.blade.php ENDPATH**/ ?>