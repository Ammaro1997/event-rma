<?php $__env->startSection('message_content'); ?>
Hello,<br><br>

You have received a new order for the event <b><?php echo e($order->event->title); ?></b>.<br><br>

<?php if(!$order->is_payment_received): ?>
    <b>Please note: This order still requires payment.</b>
    <br><br>
<?php endif; ?>


<h3>Order Summary</h3>
Order Reference: <b><?php echo e($order->order_reference); ?></b><br>
Order Name: <b><?php echo e($order->full_name); ?></b><br>
Order Date: <b><?php echo e($order->created_at->format(config('attendize.default_datetime_format'))); ?></b><br>
Order Email: <b><?php echo e($order->email); ?></b><br>
<?php if($order->is_business): ?>
<h3>Business Details</h3>
<?php if($order->business_name): ?> <?php echo app('translator')->getFromJson("Public_ViewEvent.business_name"); ?>: <strong><?php echo e($order->business_name); ?></strong><br><?php endif; ?>
<?php if($order->business_tax_number): ?> <?php echo app('translator')->getFromJson("Public_ViewEvent.business_tax_number"); ?>: <strong><?php echo e($order->business_tax_number); ?></strong><br><?php endif; ?>
<?php if($order->business_address_line_one): ?> <?php echo app('translator')->getFromJson("Public_ViewEvent.business_address_line1"); ?>: <strong><?php echo e($order->business_address_line_one); ?></strong><br><?php endif; ?>
<?php if($order->business_address_line_two): ?> <?php echo app('translator')->getFromJson("Public_ViewEvent.business_address_line2"); ?>: <strong><?php echo e($order->business_address_line_two); ?></strong><br><?php endif; ?>
<?php if($order->business_address_state_province): ?> <?php echo app('translator')->getFromJson("Public_ViewEvent.business_address_state_province"); ?>: <strong><?php echo e($order->business_address_state_province); ?></strong><br><?php endif; ?>
<?php if($order->business_address_city): ?> <?php echo app('translator')->getFromJson("Public_ViewEvent.business_address_city"); ?>: <strong><?php echo e($order->business_address_city); ?></strong><br><?php endif; ?>
<?php if($order->business_address_code): ?> <?php echo app('translator')->getFromJson("Public_ViewEvent.business_address_code"); ?>: <strong><?php echo e($order->business_address_code); ?></strong><br><?php endif; ?>
<?php endif; ?>

<h3>Order Items</h3>
<div style="padding:10px; background: #F9F9F9; border: 1px solid #f1f1f1;">

    <table style="width:100%; margin:10px;">
        <tr>
            <th>
                Ticket
            </th>
            <th>
                Quantity
            </th>
            <th>
                Price
            </th>
            <th>
                Booking Fee
            </th>
            <th>
                Total
            </th>
        </tr>
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
                FREE
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
                FREE
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
                <b>Sub Total</b>
            </td>
            <td colspan="2">
                <?php echo e($orderService->getOrderTotalWithBookingFee(true)); ?>

            </td>
        </tr>
        <?php if($order->event->organiser->charge_tax == 1): ?>
        <tr>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
                <strong><?php echo e($order->event->organiser->tax_name); ?></strong><em>(<?php echo e($order->event->organiser->tax_value); ?>%)</em>
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
    </table>


    <br><br>
    You can manage this order at: <?php echo e(route('showEventOrders', ['event_id' => $order->event->id, 'q'=>$order->order_reference])); ?>

    <br><br>
</div>
<br><br>
Thank you
<?php $__env->stopSection(); ?>

<?php echo $__env->make('en.Emails.Layouts.Master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views\en/Emails/OrderNotification.blade.php ENDPATH**/ ?>