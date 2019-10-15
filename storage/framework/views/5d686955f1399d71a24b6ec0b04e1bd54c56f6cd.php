<?php $__env->startSection('title'); ?>
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
    <?php echo app('translator')->getFromJson("Ticket.event_tickets"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('top_nav'); ?>
    <?php echo $__env->make('ManageEvent.Partials.TopNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title'); ?>
    <i class="ico-ticket mr5"></i>
    <?php echo app('translator')->getFromJson("Ticket.event_tickets"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>
    <script>
        $(function () {
            $('.sortable').sortable({
                handle: '.sortHandle',
                forcePlaceholderSize: true,
                placeholderClass: 'col-md-4 col-sm-6 col-xs-12',
            }).bind('sortupdate', function (e, ui) {

                var data = $('.sortable .ticket').map(function () {
                    return $(this).data('ticket-id');
                }).get();

                $.ajax({
                    type: 'POST',
                    url: '<?php echo e(route('postUpdateTicketsOrder' ,['event_id' => $event->id])); ?>',
                    dataType: 'json',
                    data: {ticket_ids: data},
                    success: function (data) {
                        showMessage(data.message);
                    },
                    error: function (data) {
                        showMessage(lang("whoops2"));
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('menu'); ?>
    <?php echo $__env->make('ManageEvent.Partials.Sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_header'); ?>
    <div class="col-md-9">
        <!-- Toolbar -->
        <div class="btn-toolbar" role="toolbar">
            <div class="btn-group btn-group-responsive">
                <button data-modal-id='CreateTicket'
                        data-href="<?php echo e(route('showCreateTicket', array('event_id'=>$event->id))); ?>"
                        class='loadModal btn btn-success' type="button"><i class="ico-ticket"></i> <?php echo app('translator')->getFromJson("Ticket.create_ticket"); ?>
                </button>
            </div>
            <?php if(false): ?>
                <div class="btn-group btn-group-responsive ">
                    <button data-modal-id='TicketQuestions'
                            data-href="<?php echo e(route('showTicketQuestions', array('event_id'=>$event->id))); ?>" type="button"
                            class="loadModal btn btn-success">
                        <i class="ico-question"></i> <?php echo app('translator')->getFromJson("Ticket.questions"); ?>
                    </button>
                </div>
                <div class="btn-group btn-group-responsive">
                    <button type="button" class="btn btn-success">
                        <i class="ico-tags"></i> <?php echo app('translator')->getFromJson("Ticket.coupon_codes"); ?>
                    </button>
                </div>
            <?php endif; ?>
        </div>
        <!--/ Toolbar -->
    </div>
    <div class="col-md-3">
        <?php echo Form::open(array('url' => route('showEventTickets', ['event_id'=>$event->id,'sort_by'=>$sort_by]), 'method' => 'get')); ?>

        <div class="input-group">
            <input name='q' value="<?php echo e($q or ''); ?>" placeholder="<?php echo app('translator')->getFromJson("Ticket.search_tickets"); ?>" type="text" class="form-control">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="ico-search"></i></button>
        </span>
            <?php echo Form::hidden('sort_by', $sort_by); ?>

        </div>
        <?php echo Form::close(); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($tickets->count()): ?>
        <div class="row">
            <div class="col-md-3 col-xs-6">
                <div class='order_options'>
                    <span class="event_count"><?php echo app('translator')->getFromJson("Ticket.n_tickets", ["num"=>$tickets->count()]); ?></span>
                </div>
            </div>
            <div class="col-md-2 col-xs-6 col-md-offset-7">
                <div class='order_options'>
                    <?php echo Form::select('sort_by_select', $allowed_sorts, $sort_by, ['class' => 'form-control pull right']); ?>

                </div>
            </div>
        </div>
    <?php endif; ?>
    <!--Start ticket table-->
    <div class="row sortable">
        <?php if($tickets->count()): ?>

            <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div id="ticket_<?php echo e($ticket->id); ?>" class="col-md-4 col-sm-6 col-xs-12">
                    <div class="panel panel-success ticket" data-ticket-id="<?php echo e($ticket->id); ?>">
                        <div style="cursor: pointer;" data-modal-id='ticket-<?php echo e($ticket->id); ?>'
                             data-href="<?php echo e(route('showEditTicket', ['event_id' => $event->id, 'ticket_id' => $ticket->id])); ?>"
                             class="panel-heading loadModal">
                            <h3 class="panel-title">
                                <?php if($ticket->is_hidden): ?>
                                    <i title="<?php echo app('translator')->getFromJson("Ticket.this_ticket_is_hidden"); ?>"
                                       class="ico-eye-blocked ticket_icon mr5 ellipsis"></i>
                                <?php else: ?>
                                    <i class="ico-ticket ticket_icon mr5 ellipsis"></i>
                                <?php endif; ?>
                                <?php echo e($ticket->title); ?>

                                <span class="pull-right">
                        <?php echo e(($ticket->is_free) ? trans("Order.free") : money($ticket->price, $event->currency)); ?>

                    </span>
                            </h3>
                        </div>
                        <div class='panel-body'>
                            <ul class="nav nav-section nav-justified mt5 mb5">
                                <li>
                                    <div class="section">
                                        <h4 class="nm"><?php echo e($ticket->quantity_sold); ?></h4>

                                        <p class="nm text-muted"><?php echo app('translator')->getFromJson("Ticket.sold"); ?></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="section">
                                        <h4 class="nm">
                                            <?php echo e(($ticket->quantity_available === null) ? '∞' : $ticket->quantity_remaining); ?>

                                        </h4>

                                        <p class="nm text-muted"><?php echo app('translator')->getFromJson("Ticket.remaining"); ?></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="section">
                                        <h4 class="nm hint--top"
                                            title="<?php echo e(money($ticket->sales_volume, $event->currency)); ?> + <?php echo e(money($ticket->organiser_fees_volume, $event->currency)); ?> <?php echo app('translator')->getFromJson("Order.organiser_booking_fees"); ?>">
                                            <?php echo e(money($ticket->sales_volume + $ticket->organiser_fees_volume, $event->currency)); ?>

                                            <sub title="<?php echo app('translator')->getFromJson("Ticket.doesnt_account_for_refunds"); ?>.">*</sub>
                                        </h4>
                                        <p class="nm text-muted"><?php echo app('translator')->getFromJson("Ticket.revenue"); ?></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="panel-footer" style="height: 56px;">
                            <div class="sortHandle" title="<?php echo app('translator')->getFromJson("basic.drag_to_reorder"); ?>">
                                <i class="ico-paragraph-justify"></i>
                            </div>
                            <ul class="nav nav-section nav-justified">
                                <li>
                                    <a href="javascript:void(0);">
                                        <?php if($ticket->sale_status === config('attendize.ticket_status_on_sale')): ?>
                                            <?php if($ticket->is_paused): ?>
                                                <?php echo app('translator')->getFromJson("Ticket.ticket_sales_paused"); ?> &nbsp;
                                                <span class="pauseTicketSales label label-info"
                                                      data-id="<?php echo e($ticket->id); ?>"
                                                      data-route="<?php echo e(route('postPauseTicket', ['event_id'=>$event->id])); ?>">
                                    <i class="ico-play4"></i> <?php echo app('translator')->getFromJson("Ticket.resume"); ?>
                                </span>
                                            <?php else: ?>
                                                <?php echo app('translator')->getFromJson("Ticket.on_sale"); ?> &nbsp;
                                                <span class="pauseTicketSales label label-info"
                                                      data-id="<?php echo e($ticket->id); ?>"
                                                      data-route="<?php echo e(route('postPauseTicket', ['event_id'=>$event->id])); ?>">
                                    <i class="ico-pause"></i> <?php echo app('translator')->getFromJson("Ticket.pause"); ?>
                                </span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php echo e(\App\Models\TicketStatus::find($ticket->sale_status)->name); ?>

                                        <?php endif; ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <?php if($q): ?>
                <?php echo $__env->make('Shared.Partials.NoSearchResults', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>
                <?php echo $__env->make('ManageEvent.Partials.TicketsBlankSlate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        <?php endif; ?>
    </div><!--/ end ticket table-->
    <div class="row">
        <div class="col-md-12">
            <?php echo $tickets->appends(['q' => $q, 'sort_by' => $sort_by])->render(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Shared.Layouts.Master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageEvent/Tickets.blade.php ENDPATH**/ ?>