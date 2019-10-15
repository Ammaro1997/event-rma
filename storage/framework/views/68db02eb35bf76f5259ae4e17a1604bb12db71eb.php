<section id="events" class="container">
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <?php echo $__env->make('Public.ViewOrganiser.Partials.EventListingPanel',
                [
                    'panel_title' => trans("Public_ViewOrganiser.upcoming_events"),
                    'events'      => $upcoming_events
                ]
            , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('Public.ViewOrganiser.Partials.EventListingPanel',
                [
                    'panel_title' => trans("Public_ViewOrganiser.past_events"),
                    'events'      => $past_events
                ]
            , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <?php if($organiser->facebook): ?>
                <?php echo $__env->make('Shared.Partials.FacebookTimelinePanel',
                    [
                        'facebook_account' => $organiser->facebook
                    ]
                , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <?php if($organiser->twitter): ?>
                <?php echo $__env->make('Shared.Partials.TwitterTimelinePanel',
                    [
                        'twitter_account' => $organiser->twitter
                    ]
                , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    </div>
</section><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/Public/ViewOrganiser/Partials/OrganiserEventsSection.blade.php ENDPATH**/ ?>