<section id="organiser" class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="event_organiser_details" property="organizer" typeof="Organization">
                <div class="logo">
                    <img alt="<?php echo e($event->organiser->name); ?>" src="<?php echo e(asset($event->organiser->full_logo_path)); ?>" property="logo">
                </div>
                    <?php if($event->organiser->enable_organiser_page): ?>
                    <a href="<?php echo e(route('showOrganiserHome', [$event->organiser->id, Str::slug($event->organiser->name)])); ?>" title="Organiser Page">
                        <?php echo e($event->organiser->name); ?>

                    </a>
                    <?php else: ?>
                        <?php echo e($event->organiser->name); ?>

                    <?php endif; ?>
                </h3>

                <p property="description">
                    <?php echo nl2br($event->organiser->about); ?>

                </p>
                <p>
                    <?php if($event->organiser->facebook): ?>
                        <a property="sameAs" href="https://fb.com/<?php echo e($event->organiser->facebook); ?>" class="btn btn-facebook">
                            <i class="ico-facebook"></i>&nbsp; <?php echo app('translator')->getFromJson("Public_ViewEvent.Facebook"); ?>
                        </a>
                    <?php endif; ?>
                        <?php if($event->organiser->twitter): ?>
                            <a property="sameAs" href="https://twitter.com/<?php echo e($event->organiser->twitter); ?>" class="btn btn-twitter">
                                <i class="ico-twitter"></i>&nbsp; <?php echo app('translator')->getFromJson("Public_ViewEvent.Twitter"); ?>
                            </a>
                        <?php endif; ?>
                    <button onclick="$(function(){ $('.contact_form').slideToggle(); });" type="button" class="btn btn-primary">
                        <i class="ico-envelop"></i>&nbsp; <?php echo app('translator')->getFromJson("Public_ViewEvent.Contact"); ?>
                    </button>
                </p>
                <div class="contact_form well well-sm">
                    <?php echo Form::open(array('url' => route('postContactOrganiser', array('event_id' => $event->id)), 'class' => 'reset ajax')); ?>

                    <h3><?php echo app('translator')->getFromJson("Public_ViewEvent.Contact"); ?> <i><?php echo e($event->organiser->name); ?></i></h3>
                    <div class="form-group">
                        <?php echo Form::label(trans("Public_ViewEvent.your_name")); ?>

                        <?php echo Form::text('name', null,
                            array('required',
                                  'class'=>'form-control',
                                  'placeholder'=>trans("Public_ViewEvent.your_name"))); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Form::label(trans("Public_ViewEvent.your_email_address")); ?>

                        <?php echo Form::text('email', null,
                            array('required',
                                  'class'=>'form-control',
                                  'placeholder'=>trans("Public_ViewEvent.your_email_address"))); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Form::label(trans("Public_ViewEvent.your_message")); ?>

                        <?php echo Form::textarea('message', null,
                            array('required',
                                  'class'=>'form-control',
                                  'placeholder'=>trans("Public_ViewEvent.your_message"))); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Form::submit(trans("Public_ViewEvent.send_message_submit"),
                          array('class'=>'btn btn-primary')); ?>

                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</section>

<?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/Public/ViewEvent/Partials/EventOrganiserSection.blade.php ENDPATH**/ ?>