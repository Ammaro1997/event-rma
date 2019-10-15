<?php $__env->startSection('title'); ?>
##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##

<?php echo app('translator')->getFromJson("Event.event_orders"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('top_nav'); ?>
<?php echo $__env->make('ManageEvent.Partials.TopNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('menu'); ?>
<?php echo $__env->make('ManageEvent.Partials.Sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title'); ?>
<i class='ico-cart mr5'></i>
<?php echo app('translator')->getFromJson("Event.event_orders"); ?>
<span class="page_title_sub_title hide">
    <?php echo e(@trans("Event.showing_num_of_orders", [30, \App\Models\Order::scope()->count()])); ?>

</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_header'); ?>
<div class="col-md-9 col-sm-6">
    <!-- Toolbar -->
    <div class="btn-toolbar" role="toolbar">
        <div class="btn-group btn-group btn-group-responsive">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                <i class="ico-users"></i> <?php echo app('translator')->getFromJson("basic.export"); ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo e(route('showExportOrders', ['event_id'=>$event->id,'export_as'=>'xlsx'])); ?>"><?php echo app('translator')->getFromJson("File_format.Excel_xlsx"); ?></a></li>
                <li><a href="<?php echo e(route('showExportOrders', ['event_id'=>$event->id,'export_as'=>'xls'])); ?>"><?php echo app('translator')->getFromJson("File_format.Excel_xls"); ?></a></li>
                <li><a href="<?php echo e(route('showExportOrders', ['event_id'=>$event->id,'export_as'=>'csv'])); ?>"><?php echo app('translator')->getFromJson("File_format.csv"); ?></a></li>
                <li><a href="<?php echo e(route('showExportOrders', ['event_id'=>$event->id,'export_as'=>'html'])); ?>"><?php echo app('translator')->getFromJson("File_format.html"); ?></a></li>
            </ul>
        </div>
    </div>
    <!--/ Toolbar -->
</div>
<div class="col-md-3 col-sm-6">
   <?php echo Form::open(array('url' => route('showEventOrders', ['event_id'=>$event->id,'sort_by'=>$sort_by]), 'method' => 'get')); ?>

    <div class="input-group">
        <input name='q' value="<?php echo e($q or ''); ?>" placeholder="<?php echo app('translator')->getFromJson('Order.search_placeholder'); ?>" type="text" class="form-control">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="ico-search"></i></button>
        </span>
    </div>
   <?php echo Form::close(); ?>

</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<!--Start Attendees table-->
<div class="row">

    <?php if($orders->count()): ?>

    <div class="col-md-12">

        <!-- START panel -->
        <div class="panel">
            <div class="table-responsive ">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                               <?php echo Html::sortable_link(trans("Order.order_ref"), $sort_by, 'order_reference', $sort_order, ['q' => $q , 'page' => $orders->currentPage()]); ?>

                            </th>
                            <th>
                               <?php echo Html::sortable_link(trans("Order.order_date"), $sort_by, 'created_at', $sort_order, ['q' => $q , 'page' => $orders->currentPage()]); ?>

                            </th>
                            <th>
                               <?php echo Html::sortable_link(trans("Attendee.name"), $sort_by, 'first_name', $sort_order, ['q' => $q , 'page' => $orders->currentPage()]); ?>

                            </th>
                            <th>
                               <?php echo Html::sortable_link(trans("Attendee.email"), $sort_by, 'email', $sort_order, ['q' => $q , 'page' => $orders->currentPage()]); ?>

                            </th>
                            <th>
                               <?php echo Html::sortable_link(trans("Order.amount"), $sort_by, 'amount', $sort_order, ['q' => $q , 'page' => $orders->currentPage()]); ?>

                            </th>
                            <th>
                               <?php echo Html::sortable_link(trans("Order.status"), $sort_by, 'order_status_id', $sort_order, ['q' => $q , 'page' => $orders->currentPage()]); ?>

                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <a href='javascript:void(0);' data-modal-id='view-order-<?php echo e($order->id); ?>' data-href="<?php echo e(route('showManageOrder', ['order_id'=>$order->id])); ?>" title="<?php echo app('translator')->getFromJson("Order.view_order_num", ["num"=>$order->order_reference]); ?>" class="loadModal">
                                    <?php echo e($order->order_reference); ?>

                                </a>
                            </td>
                            <td>
                                <?php echo e($order->created_at->format(config('attendize.default_datetime_format'))); ?>

                            </td>
                            <td>
                                <?php echo e($order->first_name.' '.$order->last_name); ?>

                            </td>
                            <td>
                                <a href="javascript:void(0);" class="loadModal"
                                    data-modal-id="MessageOrder"
                                    data-href="<?php echo e(route('showMessageOrder', ['order_id'=>$order->id])); ?>"
                                > <?php echo e($order->email); ?></a>
                            </td>
                            <td>
                                <a href="#" class="hint--top" data-hint="<?php echo e(money($order->amount, $event->currency)); ?> + <?php echo e(money($order->organiser_booking_fee, $event->currency)); ?> <?php echo app('translator')->getFromJson("Order.organiser_booking_fees"); ?>">
                                    <?php echo e(money($order->amount + $order->organiser_booking_fee + $order->taxamt, $event->currency)); ?>

                                    <?php if($order->is_refunded || $order->is_partially_refunded): ?>

                                    <?php endif; ?>
                                </a>
                            </td>
                            <td>
                                <span class="label label-<?php echo e((!$order->is_payment_received || $order->is_refunded || $order->is_partially_refunded) ? 'warning' : 'success'); ?>">
                                    <?php echo e($order->orderStatus->name); ?>

                                </span>
                            </td>
                            <td class="text-center">
                                <a href="javascript:void(0);" data-modal-id="cancel-order-<?php echo e($order->id); ?>" data-href="<?php echo e(route('showCancelOrder', ['order_id'=>$order->id])); ?>" title="<?php echo app('translator')->getFromJson("Order.cancel_order"); ?>" class="btn btn-xs btn-danger loadModal">
                                                <?php echo app('translator')->getFromJson("Order.refund/cancel"); ?>
                                            </a>
                                <a data-modal-id="view-order-<?php echo e($order->id); ?>" data-href="<?php echo e(route('showManageOrder', ['order_id'=>$order->id])); ?>" title="<?php echo app('translator')->getFromJson("Order.view_order"); ?>" class="btn btn-xs btn-primary loadModal"><?php echo app('translator')->getFromJson("Order.details"); ?></a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <?php echo $orders->appends(['sort_by' => $sort_by, 'sort_order' => $sort_order, 'q' => $q])->render(); ?>

    </div>

    <?php else: ?>

    <?php if($q): ?>
    <?php echo $__env->make('Shared.Partials.NoSearchResults', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
    <?php echo $__env->make('ManageEvent.Partials.OrdersBlankSlate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php endif; ?>
</div>    <!--/End attendees table-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Shared.Layouts.Master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageEvent/Orders.blade.php ENDPATH**/ ?>