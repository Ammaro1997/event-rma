<section id='order_form' class="container">
    <div class="row">
        <h1 class="section_head">
            <?php echo app('translator')->getFromJson("Public_ViewEvent.payment_information"); ?>
        </h1>
    </div>
    <?php if($payment_failed): ?>
    <div class="row">
        <div class="col-md-8 alert-danger" style="text-align: left; padding: 10px">
            <?php echo app('translator')->getFromJson("Order.payment_failed"); ?>
        </div>
    </div>
    <?php endif; ?>
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
            <div class="row">

                <?php if($order_requires_payment): ?>
                    <?php echo $__env->make('Public.ViewEvent.Partials.OfflinePayments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>

                <?php if(View::exists($payment_gateway['checkout_blade_template'])): ?>
                    <?php echo $__env->make($payment_gateway['checkout_blade_template'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <img src="https://cdn.attendize.com/lg.png" />
</section>
<?php if(session()->get('message')): ?>
<script>showMessage('<?php echo e(session()->get('message')); ?>');</script>
<?php endif; ?>

<?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/Public/ViewEvent/Partials/EventPaymentSection.blade.php ENDPATH**/ ?>