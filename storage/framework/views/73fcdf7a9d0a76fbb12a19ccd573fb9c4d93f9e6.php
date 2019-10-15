<?php echo HTML::style(asset('assets/stylesheet/ticket.css')); ?>

<style>
    .ticket {
        border: 1px solid <?php echo e($event->ticket_border_color); ?>;
        background: <?php echo e($event->ticket_bg_color); ?> ;
        color: <?php echo e($event->ticket_sub_text_color); ?>;
        border-left-color: <?php echo e($event->ticket_border_color); ?> ;
    }
    .ticket h4 {color: <?php echo e($event->ticket_text_color); ?>;}
    .ticket .logo {
        border-left: 1px solid <?php echo e($event->ticket_border_color); ?>;
        border-bottom: 1px solid <?php echo e($event->ticket_border_color); ?>;

    }
</style>
<div class="ticket">
    <div class="logo">
        <?php echo HTML::image(asset($image_path)); ?>

    </div>

    <div class="layout_even">
        <div class="event_details">
            <h4><?php echo app('translator')->getFromJson("Ticket.event"); ?></h4>
            <?php echo app('translator')->getFromJson("Ticket.demo_event"); ?>
            <h4><?php echo app('translator')->getFromJson("Ticket.organiser"); ?></h4>
            <?php echo app('translator')->getFromJson("Ticket.demo_organiser"); ?>
            <h4><?php echo app('translator')->getFromJson("Ticket.venue"); ?></h4>
            <?php echo app('translator')->getFromJson("Ticket.demo_venue"); ?>
            <h4><?php echo app('translator')->getFromJson("Ticket.start_date_time"); ?></h4>
            <?php echo app('translator')->getFromJson("Ticket.demo_start_date_time"); ?>
            <h4><?php echo app('translator')->getFromJson("Ticket.end_date_time"); ?></h4>
            <?php echo app('translator')->getFromJson("Ticket.demo_end_date_time"); ?>
        </div>

        <div class="attendee_details">
            <h4><?php echo app('translator')->getFromJson("Ticket.name"); ?></h4>
            <?php echo app('translator')->getFromJson("Ticket.demo_name"); ?>
            <h4><?php echo app('translator')->getFromJson("Ticket.ticket_type"); ?></h4>
            <?php echo app('translator')->getFromJson("Ticket.demo_ticket_type"); ?>
            <h4><?php echo app('translator')->getFromJson("Ticket.order_ref"); ?></h4>
            <?php echo app('translator')->getFromJson("Ticket.demo_order_ref"); ?>
            <h4><?php echo app('translator')->getFromJson("Ticket.attendee_ref"); ?></h4>
            <?php echo app('translator')->getFromJson("Ticket.demo_attendee_ref"); ?>
            <h4><?php echo app('translator')->getFromJson("Ticket.price"); ?></h4>
            <?php echo app('translator')->getFromJson("Ticket.demo_price"); ?>
        </div>
    </div>

    <div class="barcode">
        <?php echo DNS2D::getBarcodeSVG('hello', "QRCODE", 6, 6); ?>

    </div>
    <?php if($event->is_1d_barcode_enabled): ?>
        <div class="barcode_vertical">
            <?php echo DNS1D::getBarcodeSVG(12211221, "C39+", 1, 50); ?>

        </div>
    <?php endif; ?>
    <div class="foot">
        <?php echo app('translator')->getFromJson("Ticket.footer"); ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageEvent/Partials/TicketDesignPreview.blade.php ENDPATH**/ ?>