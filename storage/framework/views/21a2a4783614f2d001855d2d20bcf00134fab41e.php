<script>
    $(function () {

        $('.payment_gateway_options').hide();
        $('#gateway_<?php echo e($default_payment_gateway_id); ?>').show();

        $('input[type=radio][name=payment_gateway]').on('change', function (e) {
            $('.payment_gateway_options').hide();
            $('#gateway_' + $(this).val()).fadeIn();
        });

    });
</script>


<?php echo Form::model($account, array('url' => route('postEditAccountPayment'), 'class' => 'ajax ')); ?>

<div class="form-group">
    <?php echo Form::label('payment_gateway_id', trans("ManageAccount.default_payment_gateway"), array('class'=>'control-label
    ')); ?><br/>

    <?php $__currentLoopData = $payment_gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $payment_gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo Form::radio('payment_gateway', $payment_gateway['id'], $payment_gateway['default'],
    array('id'=>'payment_gateway_' . $payment_gateway['id'])); ?>

    <?php echo Form::label($payment_gateway['provider_name'],$payment_gateway['provider_name'] , array('class'=>'control-label
    gateway_selector')); ?><br/>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


</div>

<?php $__currentLoopData = $payment_gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $payment_gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php if(View::exists($payment_gateway['admin_blade_template'])): ?>
    <?php echo $__env->make($payment_gateway['admin_blade_template'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>


<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<div class="row">
    <div class="col-md-12">
        <div class="panel-footer">
            <?php echo Form::submit(trans("ManageAccount.save_payment_details_submit"), ['class' => 'btn btn-success
            pull-right']); ?>

        </div>
    </div>
</div>


<?php echo Form::close(); ?><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageAccount/Partials/PaymentGatewayOptions.blade.php ENDPATH**/ ?>