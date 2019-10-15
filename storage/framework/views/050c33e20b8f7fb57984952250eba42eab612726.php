<section id='order_form' class="container">
    <div class="row">
        <h1 class="section_head">
            <?php echo app('translator')->getFromJson("Public_ViewEvent.order_details"); ?>
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <?php echo app('translator')->getFromJson("Public_ViewEvent.below_order_details_header"); ?>
        </div>
        <div class="col-md-4 col-md-push-8">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="ico-cart mr5"></i>
                        <?php echo app('translator')->getFromJson("Public_ViewEvent.order_summary"); ?>
                    </h3>
                </div>

                <div class="panel-body pt0">
                    <table class="table mb0 table-condensed">
                        <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="pl0"><?php echo e($ticket['ticket']['title']); ?> X <b><?php echo e($ticket['qty']); ?></b></td>
                            <td style="text-align: right;">
                                <?php if((int)ceil($ticket['full_price']) === 0): ?>
                                    <?php echo app('translator')->getFromJson("Public_ViewEvent.free"); ?>
                                <?php else: ?>
                                <?php echo e(money($ticket['full_price'], $event->currency)); ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </div>
                <?php if($order_total > 0): ?>
                <div class="panel-footer">
                    <h5>
                        <?php echo app('translator')->getFromJson("Public_ViewEvent.total"); ?>: <span style="float: right;"><b><?php echo e($orderService->getOrderTotalWithBookingFee(true)); ?></b></span>
                    </h5>
                    <?php if($event->organiser->charge_tax): ?>
                    <h5>
                        <?php echo e($event->organiser->tax_name); ?> (<?php echo e($event->organiser->tax_value); ?>%):
                        <span style="float: right;"><b><?php echo e($orderService->getTaxAmount(true)); ?></b></span>
                    </h5>
                    <h5>
                        <strong><?php echo app('translator')->getFromJson("Public_ViewEvent.grand_total"); ?></strong>
                        <span style="float: right;"><b><?php echo e($orderService->getGrandTotal(true)); ?></b></span>
                    </h5>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

            </div>
            <div class="help-block">
                <?php echo @trans("Public_ViewEvent.time", ["time"=>"<span id='countdown'></span>"]); ?>

            </div>
        </div>
        <div class="col-md-8 col-md-pull-4">
            <div class="event_order_form">
                <?php echo Form::open(['url' => route('postValidateOrder', ['event_id' => $event->id ]), 'class' => 'ajax payment-form']); ?>


                <?php echo Form::hidden('event_id', $event->id); ?>


                <h3> <?php echo app('translator')->getFromJson("Public_ViewEvent.your_information"); ?></h3>

                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <?php echo Form::label("order_first_name", trans("Public_ViewEvent.first_name")); ?>

                            <?php echo Form::text("order_first_name", null, ['required' => 'required', 'class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <?php echo Form::label("order_last_name", trans("Public_ViewEvent.last_name")); ?>

                            <?php echo Form::text("order_last_name", null, ['required' => 'required', 'class' => 'form-control']); ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label("order_email", trans("Public_ViewEvent.email")); ?>

                            <?php echo Form::text("order_email", null, ['required' => 'required', 'class' => 'form-control']); ?>

                        </div>
                    </div>
                </div>
                <div class="row"><div class="col-md-12">&nbsp;</div></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="custom-checkbox">
                                <?php echo Form::checkbox('is_business', 1, null, ['data-toggle' => 'toggle', 'id' => 'is_business']); ?>

                                <?php echo Form::label('is_business', trans("Public_ViewEvent.is_business"), ['class' => 'control-label']); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row"><div class="col-md-12">&nbsp;</div></div>
                <div class="row hidden" id="business_details">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <?php echo Form::label("business_name", trans("Public_ViewEvent.business_name")); ?>

                                        <?php echo Form::text("business_name", null, ['class' => 'form-control']); ?>

                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <?php echo Form::label("business_tax_number", trans("Public_ViewEvent.business_tax_number")); ?>

                                        <?php echo Form::text("business_tax_number", null, ['class' => 'form-control']); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <?php echo Form::label("business_address_line1", trans("Public_ViewEvent.business_address_line1")); ?>

                                        <?php echo Form::text("business_address_line1", null, ['class' => 'form-control']); ?>

                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <?php echo Form::label("business_address_line2", trans("Public_ViewEvent.business_address_line2")); ?>

                                        <?php echo Form::text("business_address_line2", null, ['class' => 'form-control']); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <?php echo Form::label("business_address_state", trans("Public_ViewEvent.business_address_state_province")); ?>

                                        <?php echo Form::text("business_address_state", null, ['class' => 'form-control']); ?>

                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <?php echo Form::label("business_address_city", trans("Public_ViewEvent.business_address_city")); ?>

                                        <?php echo Form::text("business_address_city", null, ['class' => 'form-control']); ?>

                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <?php echo Form::label("business_address_code", trans("Public_ViewEvent.business_address_code")); ?>

                                        <?php echo Form::text("business_address_code", null, ['class' => 'form-control']); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row"><div class="col-md-12">&nbsp;</div></div>
                <div class="p20 pl0">
                    <a href="javascript:void(0);" class="btn btn-primary btn-xs" id="mirror_buyer_info">
                        <?php echo app('translator')->getFromJson("Public_ViewEvent.copy_buyer"); ?>
                    </a>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="ticket_holders_details" >
                            <h3><?php echo app('translator')->getFromJson("Public_ViewEvent.ticket_holder_information"); ?></h3>
                            <?php
                                $total_attendee_increment = 0;
                            ?>
                            <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php for($i=0; $i<=$ticket['qty']-1; $i++): ?>
                                <div class="panel panel-primary">

                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <b><?php echo e($ticket['ticket']['title']); ?></b>: <?php echo app('translator')->getFromJson("Public_ViewEvent.ticket_holder_n", ["n"=>$i+1]); ?>
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo Form::label("ticket_holder_first_name[{$i}][{$ticket['ticket']['id']}]", trans("Public_ViewEvent.first_name")); ?>

                                                    <?php echo Form::text("ticket_holder_first_name[{$i}][{$ticket['ticket']['id']}]", null, ['required' => 'required', 'class' => "ticket_holder_first_name.$i.{$ticket['ticket']['id']} ticket_holder_first_name form-control"]); ?>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo Form::label("ticket_holder_last_name[{$i}][{$ticket['ticket']['id']}]", trans("Public_ViewEvent.last_name")); ?>

                                                    <?php echo Form::text("ticket_holder_last_name[{$i}][{$ticket['ticket']['id']}]", null, ['required' => 'required', 'class' => "ticket_holder_last_name.$i.{$ticket['ticket']['id']} ticket_holder_last_name form-control"]); ?>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <?php echo Form::label("ticket_holder_email[{$i}][{$ticket['ticket']['id']}]", trans("Public_ViewEvent.email_address")); ?>

                                                    <?php echo Form::text("ticket_holder_email[{$i}][{$ticket['ticket']['id']}]", null, ['required' => 'required', 'class' => "ticket_holder_email.$i.{$ticket['ticket']['id']} ticket_holder_email form-control"]); ?>

                                                </div>
                                            </div>
                                            <?php echo $__env->make('Public.ViewEvent.Partials.AttendeeQuestions', ['ticket' => $ticket['ticket'],'attendee_number' => $total_attendee_increment++], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                        </div>
                                    </div>
                                </div>
                                <?php endfor; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                <?php if($event->pre_order_display_message): ?>
                <div class="well well-small">
                    <?php echo nl2br(e($event->pre_order_display_message)); ?>

                </div>
                <?php endif; ?>

               <?php echo Form::hidden('is_embedded', $is_embedded); ?>

               <?php echo Form::submit(trans("Public_ViewEvent.checkout_order"), ['class' => 'btn btn-lg btn-success card-submit', 'style' => 'width:100%;']); ?>

               <?php echo Form::close(); ?>


            </div>
        </div>
    </div>
    <img src="https://cdn.attendize.com/lg.png" />
</section>
<?php if(session()->get('message')): ?>
    <script>showMessage('<?php echo e(session()->get('message')); ?>');</script>
<?php endif; ?>

<?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/Public/ViewEvent/Partials/EventCreateOrderSection.blade.php ENDPATH**/ ?>