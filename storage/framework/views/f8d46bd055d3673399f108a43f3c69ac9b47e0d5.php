<section id="tickets" class="container">
    <div class="row">
        <h1 class='section_head'>
            <?php echo app('translator')->getFromJson("Public_ViewEvent.tickets"); ?>
        </h1>
    </div>

    <?php if($event->end_date->isPast()): ?>
        <div class="alert alert-boring">
            <?php echo app('translator')->getFromJson("Public_ViewEvent.event_already", ['started' => trans('Public_ViewEvent.event_already_ended')]); ?>
        </div>
    <?php else: ?>

        <?php if($tickets->count() > 0): ?>

            <?php echo Form::open(['url' => route('postValidateTickets', ['event_id' => $event->id]), 'class' => 'ajax']); ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <div class="tickets_table_wrap">
                            <table class="table">
                                <?php
                                $is_free_event = true;
                                ?>
                                <?php $__currentLoopData = $tickets->where('is_hidden', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="ticket" property="offers" typeof="Offer">
                                        <td>
                                <span class="ticket-title semibold" property="name">
                                    <?php echo e($ticket->title); ?>

                                </span>
                                            <p class="ticket-descripton mb0 text-muted" property="description">
                                                <?php echo e($ticket->description); ?>

                                            </p>
                                        </td>
                                        <td style="width:200px; text-align: right;">
                                            <div class="ticket-pricing" style="margin-right: 20px;">
                                                <?php if($ticket->is_free): ?>
                                                    <?php echo app('translator')->getFromJson("Public_ViewEvent.free"); ?>
                                                    <meta property="price" content="0">
                                                <?php else: ?>
                                                    <?php
                                                    $is_free_event = false;
                                                    ?>
                                                    <span title='<?php echo e(money($ticket->price, $event->currency)); ?> <?php echo app('translator')->getFromJson("Public_ViewEvent.ticket_price"); ?> + <?php echo e(money($ticket->total_booking_fee, $event->currency)); ?> <?php echo app('translator')->getFromJson("Public_ViewEvent.booking_fees"); ?>'><?php echo e(money($ticket->total_price, $event->currency)); ?> </span>
                                                    <span class="tax-amount text-muted text-smaller"><?php echo e(($event->organiser->tax_name && $event->organiser->tax_value) ? '(+'.money(($ticket->total_price*($event->organiser->tax_value)/100), $event->currency).' '.$event->organiser->tax_name.')' : ''); ?></span>
                                                    <meta property="priceCurrency"
                                                          content="<?php echo e($event->currency->code); ?>">
                                                    <meta property="price"
                                                          content="<?php echo e(number_format($ticket->price, 2, '.', '')); ?>">
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td style="width:85px;">
                                            <?php if($ticket->is_paused): ?>

                                                <span class="text-danger">
                                    <?php echo app('translator')->getFromJson("Public_ViewEvent.currently_not_on_sale"); ?>
                                </span>

                                            <?php else: ?>

                                                <?php if($ticket->sale_status === config('attendize.ticket_status_sold_out')): ?>
                                                    <span class="text-danger" property="availability"
                                                          content="http://schema.org/SoldOut">
                                    <?php echo app('translator')->getFromJson("Public_ViewEvent.sold_out"); ?>
                                </span>
                                                <?php elseif($ticket->sale_status === config('attendize.ticket_status_before_sale_date')): ?>
                                                    <span class="text-danger">
                                    <?php echo app('translator')->getFromJson("Public_ViewEvent.sales_have_not_started"); ?>
                                </span>
                                                <?php elseif($ticket->sale_status === config('attendize.ticket_status_after_sale_date')): ?>
                                                    <span class="text-danger">
                                    <?php echo app('translator')->getFromJson("Public_ViewEvent.sales_have_ended"); ?>
                                </span>
                                                <?php else: ?>
                                                    <?php echo Form::hidden('tickets[]', $ticket->id); ?>

                                                    <meta property="availability" content="http://schema.org/InStock">
                                                    <select name="ticket_<?php echo e($ticket->id); ?>" class="form-control"
                                                            style="text-align: center">
                                                        <?php if($tickets->count() > 1): ?>
                                                            <option value="0">0</option>
                                                        <?php endif; ?>
                                                        <?php for($i=$ticket->min_per_person; $i<=$ticket->max_per_person; $i++): ?>
                                                            <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                <?php endif; ?>

                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($tickets->where('is_hidden', true)->count() > 0): ?>
                                <tr class="has-access-codes" data-url="<?php echo e(route('postShowHiddenTickets', ['event_id' => $event->id])); ?>">
                                    <td colspan="3"  style="text-align: left">
                                        <?php echo app('translator')->getFromJson("Public_ViewEvent.has_unlock_codes"); ?>
                                        <div class="form-group" style="display:inline-block;margin-bottom:0;margin-left:15px;">
                                            <?php echo Form::text('unlock_code', null, [
                                            'class' => 'form-control',
                                            'id' => 'unlock_code',
                                            'style' => 'display:inline-block;width:65%;text-transform:uppercase;',
                                            'placeholder' => 'ex: UNLOCKCODE01',
                                        ]); ?>

                                            <?php echo Form::button(trans("basic.apply"), [
                                                'class' => "btn btn-success",
                                                'id' => 'apply_access_code',
                                                'style' => 'display:inline-block;margin-top:-2px;',
                                                'data-dismiss' => 'modal',
                                            ]); ?>

                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <td colspan="3" style="text-align: center">
                                        <?php echo app('translator')->getFromJson("Public_ViewEvent.below_tickets"); ?>
                                    </td>
                                </tr>
                                <tr class="checkout">
                                    <td colspan="3">
                                        <?php if(!$is_free_event): ?>
                                            <div class="hidden-xs pull-left">
                                                <img class=""
                                                     src="<?php echo e(asset('assets/images/public/EventPage/credit-card-logos.png')); ?>"/>
                                                <?php if($event->enable_offline_payments): ?>

                                                    <div class="help-block" style="font-size: 11px;">
                                                        <?php echo app('translator')->getFromJson("Public_ViewEvent.offline_payment_methods_available"); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                        <?php endif; ?>
                                        <?php echo Form::submit(trans("Public_ViewEvent.register"), ['class' => 'btn btn-lg btn-primary pull-right']); ?>

                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo Form::hidden('is_embedded', $is_embedded); ?>

            <?php echo Form::close(); ?>


        <?php else: ?>

            <div class="alert alert-boring">
                <?php echo app('translator')->getFromJson("Public_ViewEvent.tickets_are_currently_unavailable"); ?>
            </div>

        <?php endif; ?>

    <?php endif; ?>

</section>
<?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/Public/ViewEvent/Partials/EventTicketsSection.blade.php ENDPATH**/ ?>