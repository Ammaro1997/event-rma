<style>
    /*@todo  This is temp - move to styles*/
    h3 {
        border: none !important;
        font-size: 30px;
        text-align: center;
        margin: 0;
        margin-bottom: 30px;
        letter-spacing: .2em;
        font-weight: 200;
    }

    .order_header {
        text-align: center
    }

    .order_header .massive-icon {
        display: block;
        width: 120px;
        height: 120px;
        font-size: 100px;
        margin: 0 auto;
        color: #63C05E;
    }

    .order_header h1 {
        margin-top: 20px;
        text-transform: uppercase;
    }

    .order_header h2 {
        margin-top: 5px;
        font-size: 20px;
    }

    .order_details.well, .offline_payment_instructions {
        margin-top: 25px;
        background-color: #FCFCFC;
        line-height: 30px;
        text-shadow: 0 1px 0 rgba(255,255,255,.9);
        color: #656565;
        overflow: hidden;
    }

    .ticket_download_link {
        border-bottom: 3px solid;
    }
</style>

<section id="order_form" class="container">
    <div class="row">
        <div class="col-md-12 order_header">
            <span class="massive-icon">
                <i class="ico ico-checkmark-circle"></i>
            </span>
            <h1><?php echo e(@trans("Public_ViewEvent.thank_you_for_your_order")); ?></h1>
            <h2>
                <?php echo e(@trans("Public_ViewEvent.your")); ?>

                <a class="ticket_download_link"
                   href="<?php echo e(route('showOrderTickets', ['order_reference' => $order->order_reference] ).'?download=1'); ?>">
                    <?php echo e(@trans("Public_ViewEvent.tickets")); ?></a> <?php echo e(@trans("Public_ViewEvent.confirmation_email")); ?>

            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="content event_view_order">

                <?php if($event->post_order_display_message): ?>
                <div class="alert alert-dismissable alert-info">
                    <?php echo e(nl2br(e($event->post_order_display_message))); ?>

                </div>
                <?php endif; ?>

                <div class="order_details well">
                    <div class="row">
                        <div class="col-sm-4 col-xs-6">
                            <b><?php echo app('translator')->getFromJson("Public_ViewEvent.first_name"); ?></b><br> <?php echo e($order->first_name); ?>

                        </div>

                        <div class="col-sm-4 col-xs-6">
                            <b><?php echo app('translator')->getFromJson("Public_ViewEvent.last_name"); ?></b><br> <?php echo e($order->last_name); ?>

                        </div>

                        <div class="col-sm-4 col-xs-6">
                            <b><?php echo app('translator')->getFromJson("Public_ViewEvent.amount"); ?></b><br> <?php echo e($order->event->currency_symbol); ?><?php echo e(number_format($order->total_amount, 2)); ?>

                            <?php if($event->organiser->charge_tax): ?>
                            <small><?php echo e($orderService->getVatFormattedInBrackets()); ?></small>
                            <?php endif; ?>
                        </div>

                        <div class="col-sm-4 col-xs-6">
                            <b><?php echo app('translator')->getFromJson("Public_ViewEvent.reference"); ?></b><br> <?php echo e($order->order_reference); ?>

                        </div>

                        <div class="col-sm-4 col-xs-6">
                            <b><?php echo app('translator')->getFromJson("Public_ViewEvent.date"); ?></b><br> <?php echo e($order->created_at->format(config('attendize.default_datetime_format'))); ?>

                        </div>

                        <div class="col-sm-4 col-xs-6">
                            <b><?php echo app('translator')->getFromJson("Public_ViewEvent.email"); ?></b><br> <?php echo e($order->email); ?>

                        </div>
                        <?php if($order->is_business): ?>
                        <div class="col-sm-4 col-xs-6">
                            <b><?php echo app('translator')->getFromJson("Public_ViewEvent.business_name"); ?></b><br> <?php echo e($order->business_name); ?>

                        </div>
                        <div class="col-sm-4 col-xs-6">
                            <b><?php echo app('translator')->getFromJson("Public_ViewEvent.business_tax_number"); ?></b><br> <?php echo e($order->business_tax_number); ?>

                        </div>
                        <div class="col-sm-4 col-xs-6">
                            <b><?php echo app('translator')->getFromJson("Public_ViewEvent.business_address"); ?></b><br />
                            <?php if($order->business_address_line_one): ?>
                            <?php echo e($order->business_address_line_one); ?>,
                            <?php endif; ?>
                            <?php if($order->business_address_line_two): ?>
                            <?php echo e($order->business_address_line_two); ?>,
                            <?php endif; ?>
                            <?php if($order->business_address_state_province): ?>
                            <?php echo e($order->business_address_state_province); ?>,
                            <?php endif; ?>
                            <?php if($order->business_address_city): ?>
                            <?php echo e($order->business_address_city); ?>,
                            <?php endif; ?>
                            <?php if($order->business_address_code): ?>
                            <?php echo e($order->business_address_code); ?>

                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>


                    <?php if(!$order->is_payment_received): ?>
                        <h3>
                            <?php echo app('translator')->getFromJson("Public_ViewEvent.payment_instructions"); ?>
                        </h3>
                    <div class="alert alert-info">
                        <?php echo app('translator')->getFromJson("Public_ViewEvent.order_awaiting_payment"); ?>
                    </div>
                    <div class="offline_payment_instructions well">
                        <?php echo Markdown::parse($event->offline_payment_instructions); ?>

                    </div>

                    <?php endif; ?>

                <h3>
                    <?php echo app('translator')->getFromJson("Public_ViewEvent.order_items"); ?>
                </h3>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <?php echo app('translator')->getFromJson("Public_ViewEvent.ticket"); ?>
                                </th>
                                <th>
                                    <?php echo app('translator')->getFromJson("Public_ViewEvent.quantity_full"); ?>
                                </th>
                                <th>
                                    <?php echo app('translator')->getFromJson("Public_ViewEvent.price"); ?>
                                </th>
                                <th>
                                    <?php echo app('translator')->getFromJson("Public_ViewEvent.booking_fee"); ?>
                                </th>
                                <th>
                                    <?php echo app('translator')->getFromJson("Public_ViewEvent.total"); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php echo e($order_item->title); ?>

                                    </td>
                                    <td>
                                        <?php echo e($order_item->quantity); ?>

                                    </td>
                                    <td>
                                        <?php if((int)ceil($order_item->unit_price) == 0): ?>
                                            <?php echo app('translator')->getFromJson("Public_ViewEvent.free"); ?>
                                        <?php else: ?>
                                       <?php echo e(money($order_item->unit_price, $order->event->currency)); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if((int)ceil($order_item->unit_booking_fee) > 0): ?>
                                            <?php if((int)ceil($order_item->unit_price) == 0): ?>
                                            -
                                            <?php else: ?>
                                            <?php echo e(money($order_item->unit_booking_fee, $order->event->currency)); ?>

                                            <?php endif; ?>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if((int)ceil($order_item->unit_price) == 0): ?>
                                            <?php echo app('translator')->getFromJson("Public_ViewEvent.free"); ?>
                                        <?php else: ?>
                                        <?php echo e(money(($order_item->unit_price + $order_item->unit_booking_fee) * ($order_item->quantity), $order->event->currency)); ?>

                                        <?php endif; ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                    <b><?php echo app('translator')->getFromJson("Public_ViewEvent.sub_total"); ?></b>
                                </td>
                                <td colspan="2">
                                    <?php echo e($orderService->getOrderTotalWithBookingFee(true)); ?>

                                </td>
                            </tr>
                            <?php if($event->organiser->charge_tax): ?>
                            <tr>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                    <strong><?php echo e($event->organiser->tax_name); ?></strong><em>(<?php echo e($order->event->organiser->tax_value); ?>%)</em>
                                </td>
                                <td colspan="2">
                                    <?php echo e($orderService->getTaxAmount(true)); ?>

                                </td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                    <b>Total</b>
                                </td>
                                <td colspan="2">
                                   <?php echo e($orderService->getGrandTotal(true)); ?>

                                </td>
                            </tr>
                            <?php if($order->is_refunded || $order->is_partially_refunded): ?>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <b><?php echo app('translator')->getFromJson("Public_ViewEvent.refunded_amount"); ?></b>
                                    </td>
                                    <td colspan="2">
                                        <?php echo e(money($order->amount_refunded, $order->event->currency)); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <b><?php echo app('translator')->getFromJson("Public_ViewEvent.total"); ?></b>
                                    </td>
                                    <td colspan="2">
                                        <?php echo e(money($order->total_amount - $order->amount_refunded, $order->event->currency)); ?>

                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>

                <h3>
                    <?php echo app('translator')->getFromJson("Public_ViewEvent.order_attendees"); ?>
                </h3>

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <tbody>
                            <?php $__currentLoopData = $order->attendees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php echo e($attendee->first_name); ?>

                                    <?php echo e($attendee->last_name); ?>

                                    (<a href="mailto:<?php echo e($attendee->email); ?>"><?php echo e($attendee->email); ?></a>)
                                </td>
                                <td>
                                    <?php echo e($attendee->ticket->title); ?>

                                </td>
                                <td>
                                    <?php if($attendee->is_cancelled): ?>
                                        <?php echo app('translator')->getFromJson("Public_ViewEvent.attendee_cancelled"); ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</section>

<?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/Public/ViewEvent/Partials/EventViewOrderSection.blade.php ENDPATH**/ ?>