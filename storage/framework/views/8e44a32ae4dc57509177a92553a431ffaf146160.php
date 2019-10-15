<?php $__env->startSection('head'); ?>
     <style>
          body { background-color: <?php echo e($organiser->page_bg_color); ?> !important; }
          section#intro {
               background-color: <?php echo e($organiser->page_header_bg_color); ?> !important;
               color: <?php echo e($organiser->page_text_color); ?> !important;
          }
          .event-list > li > time {
               color: <?php echo e($organiser->page_text_color); ?>;
               background-color: <?php echo e($organiser->page_header_bg_color); ?>;
          }

     </style>
     <?php if($organiser->google_analytics_code): ?>
          <?php echo $__env->make('Public.Partials.ga', ['analyticsCode' => $organiser->google_analytics_code], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
     <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
     <?php echo $__env->make('Public.ViewOrganiser.Partials.OrganiserHeaderSection', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
     <?php echo $__env->make('Public.ViewOrganiser.Partials.OrganiserEventsSection', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
     <?php echo $__env->make('Public.ViewOrganiser.Partials.OrganiserFooterSection', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('Public.ViewOrganiser.Layouts.OrganiserPage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/Public/ViewOrganiser/OrganiserPage.blade.php ENDPATH**/ ?>