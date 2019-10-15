<section id="intro" class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="organiser_logo">
                <div class="thumbnail">
                    <img src="<?php echo e(URL::to($organiser->full_logo_path)); ?>" />
                </div>
            </div>
            <h1><?php echo e($organiser->name); ?></h1>
            <?php if($organiser->about): ?>
            <div class="description pa10">
                <?php echo $organiser->about; ?>

            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/Public/ViewOrganiser/Partials/OrganiserHeaderSection.blade.php ENDPATH**/ ?>