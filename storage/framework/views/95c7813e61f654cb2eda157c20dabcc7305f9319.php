<div role="dialog"  class="modal fade " style="display: none;">
    <?php echo Form::model($ticket, ['url' => route('postEditTicket', ['ticket_id' => $ticket->id, 'event_id' => $event->id]), 'class' => 'ajax']); ?>

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title">
                    <i class="ico-ticket"></i>
                    <?php echo app('translator')->getFromJson("ManageEvent.edit_ticket", ["title"=>$ticket->title]); ?></h3>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <?php echo Form::label('title', trans("ManageEvent.ticket_title"), array('class'=>'control-label required')); ?>

                    <?php echo Form::text('title', null,['class'=>'form-control', 'placeholder'=>'E.g: General Admission']); ?>

                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo Form::label('price', trans("ManageEvent.ticket_price"), array('class'=>'control-label required')); ?>

                            <?php echo Form::text('price', null,
                                        array(
                                        'class'=>'form-control',
                                        'placeholder'=>trans("ManageEvent.price_placeholder")
                                        )); ?>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo Form::label('quantity_available', trans("ManageEvent.quantity_available"), array('class'=>' control-label')); ?>

                            <?php echo Form::text('quantity_available', null,
                                        array(
                                        'class'=>'form-control',
                                        'placeholder'=>trans("ManageEvent.quantity_available_placeholder")
                                        )
                                        ); ?>

                        </div>
                    </div>
                </div>

                <div class="form-group more-options">
                    <?php echo Form::label('description', trans("ManageEvent.ticket_description"), array('class'=>'control-label')); ?>

                    <?php echo Form::text('description', null,
                                array(
                                'class'=>'form-control'
                                )); ?>

                </div>

                <div class="row more-options">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo Form::label('start_sale_date', trans("ManageEvent.start_sale_on"), array('class'=>' control-label')); ?>


                            <?php echo Form::text('start_sale_date', $ticket->getFormattedDate('start_sale_date'),
                                [
                                    'class' => 'form-control start hasDatepicker',
                                    'data-field' => 'datetime',
                                    'data-startend' => 'start',
                                    'data-startendelem' => '.end',
                                    'readonly' => ''
                                ]); ?>

                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo Form::label('end_sale_date', trans("ManageEvent.end_sale_on"),
                                        [
                                    'class'=>' control-label '
                                ]); ?>

                            <?php echo Form::text('end_sale_date', $ticket->getFormattedDate('end_sale_date'),
                                [
                                    'class' => 'form-control end hasDatepicker',
                                    'data-field' => 'datetime',
                                    'data-startend' => 'end',
                                    'data-startendelem' => '.start',
                                    'readonly' => ''
                                ]); ?>

                        </div>
                    </div>
                </div>

                <div class="row more-options">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('min_per_person', trans("ManageEvent.minimum_tickets_per_order"), array('class'=>' control-label')); ?>

                           <?php echo Form::selectRange('min_per_person', 1, 100, null, ['class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('max_per_person', trans("ManageEvent.maximum_tickets_per_order"), array('class'=>' control-label')); ?>

                           <?php echo Form::selectRange('max_per_person', 1, 100, null, ['class' => 'form-control']); ?>

                        </div>
                    </div>
                </div>
                <div class="row more-options">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="custom-checkbox">
                                <?php echo Form::checkbox('is_hidden', null, null, ['id' => 'is_hidden']); ?>

                                <?php echo Form::label('is_hidden', trans("ManageEvent.hide_this_ticket"), array('class'=>' control-label')); ?>

                            </div>
                        </div>
                    </div>
                    <?php if($ticket->is_hidden): ?>
                        <div class="col-md-12">
                            <h4><?php echo e(__('AccessCodes.select_access_code')); ?></h4>
                            <?php if($ticket->event->access_codes->count()): ?>
                                <?php
                                $isSelected = false;
                                $selectedAccessCodes = $ticket->event_access_codes()->get()->map(function($accessCode) {
                                    return $accessCode->pivot->event_access_code_id;
                                })->toArray();
                                ?>
                                <?php $__currentLoopData = $ticket->event->access_codes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $access_code): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="custom-checkbox mb5">
                                                <?php echo Form::checkbox('ticket_access_codes[]', $access_code->id, in_array($access_code->id, $selectedAccessCodes), ['id' => 'ticket_access_code_' . $access_code->id, 'data-toggle' => 'toggle']); ?>

                                                <?php echo Form::label('ticket_access_code_' . $access_code->id, $access_code->code); ?>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="alert alert-info">
                                    <?php echo app('translator')->getFromJson("AccessCodes.no_access_codes_yet"); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <a href="javascript:void(0);" class="show-more-options">
                    <?php echo app('translator')->getFromJson("ManageEvent.more_options"); ?>
                </a>
            </div> <!-- /end modal body-->
            <div class="modal-footer">
                <?php echo Form::button(trans("basic.cancel"), ['class'=>"btn modal-close btn-danger",'data-dismiss'=>'modal']); ?>

                <?php echo Form::submit(trans("ManageEvent.save_ticket"), ['class'=>"btn btn-success"]); ?>

            </div>
        </div><!-- /end modal content-->
       <?php echo Form::close(); ?>

    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageEvent/Modals/EditTicket.blade.php ENDPATH**/ ?>