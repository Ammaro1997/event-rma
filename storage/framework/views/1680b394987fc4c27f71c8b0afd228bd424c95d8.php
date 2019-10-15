<section id="details" class="container">
    <div class="row">
        <h1 class="section_head">
            <?php echo app('translator')->getFromJson("Public_ViewEvent.event_details"); ?>
        </h1>
    </div>
    <div class="row">
        <?php
            $descriptionColSize =  $event->images->count()
                && in_array($event->event_image_position, ['left', 'right'])
                ? '7' : '12';
        ?>

        <?php if($event->images->count() && $event->event_image_position == 'left'): ?>
            <div class="col-md-5">
                <div class="content event_poster">
                    <img alt="<?php echo e($event->title); ?>" src="<?php echo e(config('attendize.cdn_url_user_assets').'/'.$event->images->first()['image_path']); ?>" property="image">
                </div>
            </div>
        <?php endif; ?>
        <?php if($event->images->count() && $event->event_image_position == 'before'): ?>
            <div class="col-md-12" style="margin-bottom: 20px">
                <div class="content event_poster">
                    <img alt="<?php echo e($event->title); ?>" src="<?php echo e(config('attendize.cdn_url_user_assets').'/'.$event->images->first()['image_path']); ?>" property="image">
                </div>
            </div>
        <?php endif; ?>

        <div class="col-md-<?php echo e($descriptionColSize); ?>">
            <div class="content event_details" property="description">
                <?php echo Markdown::parse($event->description); ?>

            </div>
        </div>

        <?php if($event->images->count() && $event->event_image_position == 'right'): ?>
            <div class="col-md-5">
                <div class="content event_poster">
                    <img alt="<?php echo e($event->title); ?>" src="<?php echo e(config('attendize.cdn_url_user_assets').'/'.$event->images->first()['image_path']); ?>" property="image">
                </div>
            </div>
        <?php endif; ?>
        <?php if($event->images->count() && $event->event_image_position == 'after'): ?>
            <div class="col-md-12" style="margin-top: 20px">
                <div class="content event_poster">
                    <img alt="<?php echo e($event->title); ?>" src="<?php echo e(config('attendize.cdn_url_user_assets').'/'.$event->images->first()['image_path']); ?>" property="image">
                </div>
            </div>
        <?php endif; ?>
    </div>
</section><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/Public/ViewEvent/Partials/EventDescriptionSection.blade.php ENDPATH**/ ?>