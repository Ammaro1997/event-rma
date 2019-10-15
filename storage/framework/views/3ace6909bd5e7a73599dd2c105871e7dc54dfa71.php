<?php $__env->startSection('title'); ?>
##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php echo app('translator')->getFromJson("Attendee.event_attendees"); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page_title'); ?>
<i class="ico-users"></i>
<?php echo app('translator')->getFromJson("Attendee.attendees"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('top_nav'); ?>
<?php echo $__env->make('ManageEvent.Partials.TopNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('menu'); ?>
<?php echo $__env->make('ManageEvent.Partials.Sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('head'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_header'); ?>

<div class="col-md-9">
    <div class="btn-toolbar" role="toolbar">
        <div class="btn-group btn-group-responsive">
            <button data-modal-id="InviteAttendee" href="javascript:void(0);"  data-href="<?php echo e(route('showInviteAttendee', ['event_id'=>$event->id])); ?>" class="loadModal btn btn-success" type="button"><i class="ico-user-plus"></i> <?php echo app('translator')->getFromJson("ManageEvent.invite_attendee"); ?></button>
        </div>
        
        <div class="btn-group btn-group-responsive">
            <button data-modal-id="ImportAttendees" href="javascript:void(0);"  data-href="<?php echo e(route('showImportAttendee', ['event_id'=>$event->id])); ?>" class="loadModal btn btn-success" type="button"><i class="ico-file"></i> <?php echo app('translator')->getFromJson("ManageEvent.invite_attendees"); ?></button>
        </div>
        
        <div class="btn-group btn-group-responsive">
            <a class="btn btn-success" href="<?php echo e(route('showPrintAttendees', ['event_id'=>$event->id])); ?>" target="_blank" ><i class="ico-print"></i> <?php echo app('translator')->getFromJson("ManageEvent.print_attendee_list"); ?></a>
        </div>
        <div class="btn-group btn-group-responsive">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                <i class="ico-users"></i> <?php echo app('translator')->getFromJson("ManageEvent.export"); ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo e(route('showExportAttendees', ['event_id'=>$event->id,'export_as'=>'xlsx'])); ?>"><?php echo app('translator')->getFromJson("File_format.Excel_xlsx"); ?></a></li>
                <li><a href="<?php echo e(route('showExportAttendees', ['event_id'=>$event->id,'export_as'=>'xls'])); ?>"><?php echo app('translator')->getFromJson("File_format.Excel_xls"); ?></a></li>
                <li><a href="<?php echo e(route('showExportAttendees', ['event_id'=>$event->id,'export_as'=>'csv'])); ?>"><?php echo app('translator')->getFromJson("File_format.csv"); ?></a></li>
                <li><a href="<?php echo e(route('showExportAttendees', ['event_id'=>$event->id,'export_as'=>'html'])); ?>"><?php echo app('translator')->getFromJson("File_format.html"); ?></a></li>
            </ul>
        </div>
        <div class="btn-group btn-group-responsive">
            <button data-modal-id="MessageAttendees" href="javascript:void(0);" data-href="<?php echo e(route('showMessageAttendees', ['event_id'=>$event->id])); ?>" class="loadModal btn btn-success" type="button"><i class="ico-envelope"></i> <?php echo app('translator')->getFromJson("ManageEvent.message_attendees"); ?></button>
        </div>
    </div>
</div>
<div class="col-md-3">
   <?php echo Form::open(array('url' => route('showEventAttendees', ['event_id'=>$event->id,'sort_by'=>$sort_by]), 'method' => 'get')); ?>

    <div class="input-group">
        <input name="q" value="<?php echo e($q or ''); ?>" placeholder="<?php echo app('translator')->getFromJson("Attendee.search_attendees"); ?>" type="text" class="form-control" />
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
    <div class="col-md-12">
        <?php if($attendees->count()): ?>
        <div class="panel">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                               <?php echo Html::sortable_link(trans("Attendee.name"), $sort_by, 'first_name', $sort_order, ['q' => $q , 'page' => $attendees->currentPage()]); ?>

                            </th>
                            <th>
                               <?php echo Html::sortable_link(trans("Attendee.email"), $sort_by, 'email', $sort_order, ['q' => $q , 'page' => $attendees->currentPage()]); ?>

                            </th>
                            <th>
                               <?php echo Html::sortable_link(trans("ManageEvent.ticket"), $sort_by, 'ticket_id', $sort_order, ['q' => $q , 'page' => $attendees->currentPage()]); ?>

                            </th>
                            <th>
                               <?php echo Html::sortable_link(trans("Order.order_ref"), $sort_by, 'order_reference', $sort_order, ['q' => $q , 'page' => $attendees->currentPage()]); ?>

                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $attendees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="attendee_<?php echo e($attendee->id); ?> <?php echo e($attendee->is_cancelled ? 'danger' : ''); ?>">
                            <td><?php echo e($attendee->full_name); ?></td>
                            <td>
                                <a data-modal-id="MessageAttendee" href="javascript:void(0);" class="loadModal"
                                    data-href="<?php echo e(route('showMessageAttendee', ['attendee_id'=>$attendee->id])); ?>"
                                    > <?php echo e($attendee->email); ?></a>
                            </td>
                            <td>
                                <?php echo e($attendee->ticket->title); ?>

                            </td>
                            <td>
                                <a href="javascript:void(0);" data-modal-id="view-order-<?php echo e($attendee->order->id); ?>" data-href="<?php echo e(route('showManageOrder', ['order_id'=>$attendee->order->id])); ?>" title="View Order #<?php echo e($attendee->order->order_reference); ?>" class="loadModal">
                                    <?php echo e($attendee->order->order_reference); ?>

                                </a>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo app('translator')->getFromJson("basic.action"); ?> <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <?php if($attendee->email): ?>
                                        <li><a
                                            data-modal-id="MessageAttendee"
                                            href="javascript:void(0);"
                                            data-href="<?php echo e(route('showMessageAttendee', ['attendee_id'=>$attendee->id])); ?>"
                                            class="loadModal"
                                            > <?php echo app('translator')->getFromJson("basic.message"); ?></a></li>
                                        <?php endif; ?>
                                        <li><a
                                            data-modal-id="ResendTicketToAttendee"
                                            href="javascript:void(0);"
                                            data-href="<?php echo e(route('showResendTicketToAttendee', ['attendee_id'=>$attendee->id])); ?>"
                                            class="loadModal"
                                            > <?php echo app('translator')->getFromJson("ManageEvent.resend_ticket"); ?></a></li>
                                        <li><a
                                            href="<?php echo e(route('showExportTicket', ['event_id'=>$event->id, 'attendee_id'=>$attendee->id])); ?>"
                                            ><?php echo app('translator')->getFromJson("ManageEvent.download_pdf_ticket"); ?></a></li>
                                    </ul>
                                </div>

                                <a
                                    data-modal-id="EditAttendee"
                                    href="javascript:void(0);"
                                    data-href="<?php echo e(route('showEditAttendee', ['event_id'=>$event->id, 'attendee_id'=>$attendee->id])); ?>"
                                    class="loadModal btn btn-xs btn-primary"
                                    > <?php echo app('translator')->getFromJson("basic.edit"); ?></a>

                                <a
                                    data-modal-id="CancelAttendee"
                                    href="javascript:void(0);"
                                    data-href="<?php echo e(route('showCancelAttendee', ['event_id'=>$event->id, 'attendee_id'=>$attendee->id])); ?>"
                                    class="loadModal btn btn-xs btn-danger"
                                    > <?php echo app('translator')->getFromJson("basic.cancel"); ?></a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php else: ?>

        <?php if(!empty($q)): ?>
        <?php echo $__env->make('Shared.Partials.NoSearchResults', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
        <?php echo $__env->make('ManageEvent.Partials.AttendeesBlankSlate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php endif; ?>
    </div>
    <div class="col-md-12">
        <?php echo $attendees->appends(['sort_by' => $sort_by, 'sort_order' => $sort_order, 'q' => $q])->render(); ?>

    </div>
</div>    <!--/End attendees table-->

<?php $__env->stopSection(); ?>



<?php echo $__env->make('Shared.Layouts.Master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageEvent/Attendees.blade.php ENDPATH**/ ?>