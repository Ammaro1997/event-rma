<section class="payment_gateway_options" id="gateway_<?php echo e($payment_gateway['id']); ?>">
    <h4><?php echo app('translator')->getFromJson("ManageAccount.stripe_settings"); ?></h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo Form::label('stripe[apiKey]', trans("ManageAccount.stripe_secret_key"), array('class'=>'control-label ')); ?>

                <?php echo Form::text('stripe[apiKey]', $account->getGatewayConfigVal($payment_gateway['id'], 'apiKey'),[ 'class'=>'form-control']); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo Form::label('publishableKey', trans("ManageAccount.stripe_publishable_key"), array('class'=>'control-label ')); ?>

                <?php echo Form::text('stripe[publishableKey]', $account->getGatewayConfigVal($payment_gateway['id'], 'publishableKey'),[ 'class'=>'form-control']); ?>

            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageAccount/Partials/Stripe.blade.php ENDPATH**/ ?>