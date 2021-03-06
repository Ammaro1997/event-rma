<div role="dialog"  class="modal fade" style="display: none;">
   <?php echo Form::open(array('url' => route('postCreateTicket', array('event_id' => $event->id)), 'class' => 'ajax')); ?>

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title">
                    <i class="ico-ticket"></i>
                    <?php echo app('translator')->getFromJson("ManageEvent.create_ticket"); ?></h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('title', trans("ManageEvent.ticket_title"), array('class'=>'control-label required')); ?>

                            <?php echo Form::text('title', Input::old('title'),
                                        array(
                                        'class'=>'form-control',
                                        'placeholder'=>trans("ManageEvent.ticket_title_placeholder")
                                        )); ?>

                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php echo Form::label('price', trans("ManageEvent.ticket_price"), array('class'=>'control-label required')); ?>

                                    <?php echo Form::text('price', Input::old('price'),
                                                array(
                                                'class'=>'form-control',
                                                'placeholder'=>trans("ManageEvent.price_placeholder")
                                                )); ?>



                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php echo Form::label('quantity_available', trans("ManageEvent.quantity_available"), array('class'=>' control-label')); ?>

                                    <?php echo Form::text('quantity_available', Input::old('quantity_available'),
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

                            <?php echo Form::text('description', Input::old('description'),
                                        array(
                                        'class'=>'form-control'
                                        )); ?>

                        </div>

                        <div class="row more-options">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php echo Form::label('start_sale_date', trans("ManageEvent.start_sale_on"), array('class'=>' control-label')); ?>

                                    <?php echo Form::text('start_sale_date', Input::old('start_sale_date'),
                                                    [
                                                'class'=>'form-control start hasDatepicker ',
                                                'data-field'=>'datetime',
                                                'data-startend'=>'start',
                                                'data-startendelem'=>'.end',
                                                'readonly'=>''

                                            ]); ?>

                                </div>
                            </div>

                            <div class="col-sm-6 ">
                                <div class="form-group">
                                    <?php echo Form::label('end_sale_date', trans("ManageEvent.end_sale_on"),
                                                [
                                            'class'=>' control-label '
                                        ]); ?>

                                    <?php echo Form::text('end_sale_date', Input::old('end_sale_date'),
                                            [
                                        'class'=>'form-control end hasDatepicker ',
                                        'data-field'=>'datetime',
                                        'data-startend'=>'end',
                                        'data-startendelem'=>'.start',
                                        'readonly'=>''
                                    ]); ?>

                                </div>
                            </div>
                        </div>

                        <div class="row more-options">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo Form::label('min_per_person', trans("ManageEvent.minimum_tickets_per_order"), array('class'=>' control-label')); ?>

                                    <?php echo Form::selectRange('min_per_person', 1, 100, 1, ['class' => 'form-control']); ?>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo Form::label('max_per_person', trans("ManageEvent.maximum_tickets_per_order"), array('class'=>' control-label')); ?>

                                    <?php echo Form::selectRange('max_per_person', 1, 100, 30, ['class' => 'form-control']); ?>

                                </div>
                            </div>
                        </div>
                        <div class="row more-options">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="custom-checkbox">
                                        <?php echo Form::checkbox('is_hidden', 1, false, ['id' => 'is_hidden']); ?>

                                        <?php echo Form::label('is_hidden', trans("ManageEvent.hide_this_ticket"), array('class'=>' control-label')); ?>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <a href="javascript:void(0);" class="show-more-options">
                            <?php echo app('translator')->getFromJson("ManageEvent.more_options"); ?>
                        </a>
                    </div>

                </div>

            </div> <!-- /end modal body-->
            <div class="modal-footer">
               <?php echo Form::button(trans("basic.cancel"), ['class'=>"btn modal-close btn-danger",'data-dismiss'=>'modal']); ?>

               <?php echo Form::submit(trans("ManageEvent.create_ticket"), ['class'=>"btn btn-success"]); ?>

            </div>
        </div><!-- /end modal content-->
       <?php echo Form::close(); ?>

    </div>
</div><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageEvent/Modals/CreateTicket.blade.php ENDPATH**/ ?>