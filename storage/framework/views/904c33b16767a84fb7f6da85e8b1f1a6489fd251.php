<?php $__env->startSection('title'); ?>
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
    <?php echo app('translator')->getFromJson("Organiser.organiser_events"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title'); ?>
    <?php echo app('translator')->getFromJson("Organiser.organiser_name_events", ["name"=>$organiser->name]); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('top_nav'); ?>
    <?php echo $__env->make('ManageOrganiser.Partials.TopNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>
    <style>
        .page-header {
            display: none;
        }
    </style>
    <script>
        $(function () {
            $('.colorpicker').minicolors({
                changeDelay: 500,
                change: function () {
                    var replaced = replaceUrlParam('<?php echo e(route('showOrganiserHome', ['organiser_id'=>$organiser->id])); ?>', 'preview_styles', encodeURIComponent($('#OrganiserPageDesign form').serialize()));
                    document.getElementById('previewIframe').src = replaced;
                }
            });

        });

        <?php echo $__env->make('ManageOrganiser.Partials.OrganiserCreateAndEditJS', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('menu'); ?>
    <?php echo $__env->make('ManageOrganiser.Partials.Sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#organiserSettings" data-toggle="tab"><?php echo app('translator')->getFromJson("Organiser.organiser_settings"); ?></a>
                </li>
                <li>
                    <a href="#OrganiserPageDesign" data-toggle="tab"><?php echo app('translator')->getFromJson("Organiser.organiser_page_design"); ?></a>
                </li>
            </ul>
            <div class="tab-content panel">
                <div class="tab-pane active" id="organiserSettings">
                    <?php echo Form::model($organiser, array('url' => route('postEditOrganiser', ['organiser_id' => $organiser->id]), 'class' => 'ajax')); ?>


                    <div class="form-group">
                        <?php echo Form::label('enable_organiser_page', trans("Organiser.enable_public_organiser_page"), array('class'=>'control-label required')); ?>

                        <?php echo Form::select('enable_organiser_page', [
                        '1' => trans("Organiser.make_organiser_public"),
                        '0' => trans("Organiser.make_organiser_hidden")],Input::old('enable_organiser_page'),
                                                    array(
                                                    'class'=>'form-control'
                                                    )); ?>

                        <div class="help-block">
                            <?php echo app('translator')->getFromJson("Organiser.organiser_page_visibility_text"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo Form::label('name', trans("Organiser.organiser_name"), array('class'=>'required control-label ')); ?>

                        <?php echo Form::text('name', Input::old('name'),
                                                array(
                                                'class'=>'form-control'
                                                )); ?>

                    </div>
                    <div class="form-group">
                        <?php echo Form::label('email', trans("Organiser.organiser_email"), array('class'=>'control-label required')); ?>

                        <?php echo Form::text('email', Input::old('email'),
                                                array(
                                                'class'=>'form-control ',
                                                'placeholder'=>trans("Organiser.organiser_email_placeholder")
                                                )); ?>

                    </div>
                    <div class="form-group">
                        <?php echo Form::label('about', trans("Organiser.organiser_description"), array('class'=>'control-label ')); ?>

                        <?php echo Form::textarea('about', Input::old('about'),
                                                array(
                                                'class'=>'form-control ',
                                                'placeholder'=>trans("Organiser.organiser_description_placeholder"),
                                                'rows' => 4
                                                )); ?>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <p class="control-label"><?php echo trans("Organiser.organiser_tax_prompt"); ?></p>
                                <label for="Yes" class="control-label" id="charge_yes"><?php echo trans("Organiser.yes"); ?></label>
                                <input id="charge_yes" name="charge_tax" type="radio" value="1" <?php echo e($organiser->charge_tax == 1 ? 'checked' : ''); ?>>
                                <label for="No" class="control-label" id="charge_no"><?php echo trans("Organiser.no"); ?></label>
                                <input id="charge_yes" name="charge_tax" type="radio" value="0" <?php echo e($organiser->charge_tax == 0 ? 'checked' : ''); ?>>
                            </div>
                        </div>
                        <div id="tax_fields">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo Form::label('tax_id', trans("Organiser.organiser_tax_id"), array('class'=>'control-label required')); ?>

                                    <?php echo Form::text('tax_id', Input::old('tax_id'), array('class'=>'form-control', 'placeholder'=>'Tax ID')); ?>

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo Form::label('tax_name', trans("Organiser.organiser_tax_name"), array('class'=>'control-label required')); ?>

                                    <?php echo Form::text('tax_name', Input::old('tax_name'), array('class'=>'form-control', 'placeholder'=>'Tax name')); ?>

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo Form::label('tax_value', trans("Organiser.organiser_tax_value"), array('class'=>'control-label required')); ?>

                                    <?php echo Form::text('tax_value', Input::old('tax_value'), array('class'=>'form-control', 'placeholder'=>'Tax Value')); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo Form::label('google_analytics_code', trans("Organiser.google_analytics_code"), array('class'=>'control-label')); ?>

                        <?php echo Form::text('google_analytics_code', Input::old('google_analytics_code'),
                                                array(
                                                'class'=>'form-control',
                                                'placeholder' => trans("Organiser.google_analytics_code_placeholder"),
                                                )); ?>

                    </div>
                    <div class="form-group">
                        <?php echo Form::label('google_tag_manager_code', trans("Organiser.google_tag_manager_code"), ['class'=>'control-label']); ?>

                        <?php echo Form::text('google_tag_manager_code', Input::old('google_tag_manager_code'), [
                                'class'=>'form-control',
                                'placeholder' => trans("Organiser.google_tag_manager_code_placeholder"),
                            ]); ?>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('facebook', trans("Organiser.organiser_facebook"), array('class'=>'control-label ')); ?>


                                <div class="input-group">
                                    <span style="background-color: #eee;" class="input-group-addon">facebook.com/</span>
                                    <?php echo Form::text('facebook', Input::old('facebook'),
                                                    array(
                                                    'class'=>'form-control ',
                                                    'placeholder'=> trans("Organiser.organiser_username_facebook_placeholder")
                                                    )); ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('twitter', trans("Organiser.organiser_twitter"), array('class'=>'control-label ')); ?>


                                <div class="input-group">
                                    <span style="background-color: #eee;" class="input-group-addon">twitter.com/</span>
                                    <?php echo Form::text('twitter', Input::old('twitter'),
                                             array(
                                             'class'=>'form-control ',
                                                    'placeholder'=> trans("Organiser.organiser_username_twitter_placeholder")
                                             )); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(is_file($organiser->logo_path)): ?>
                        <div class="form-group">
                            <?php echo Form::label('current_logo', trans("Organiser.current_logo"), array('class'=>'control-label ')); ?>


                            <div class="thumbnail">
                                <?php echo HTML::image($organiser->logo_path); ?>

                                <?php echo Form::label('remove_current_image', trans("Organiser.delete_logo?"), array('class'=>'control-label ')); ?>

                                <?php echo Form::checkbox('remove_current_image'); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <?php echo Form::labelWithHelp('organiser_logo', trans("Organiser.organiser_logo"), array('class'=>'control-label '),
                            trans("Organiser.organiser_logo_help")); ?>

                        <?php echo Form::styledFile('organiser_logo'); ?>

                    </div>
                    <div class="modal-footer">
                        <?php echo Form::submit(trans("Organiser.save_organiser"), ['class'=>"btn btn-success"]); ?>

                    </div>
                    <?php echo Form::close(); ?>

                </div>
                <div class="tab-pane scale_iframe" id="OrganiserPageDesign">
                    <?php echo Form::model($organiser, array('url' => route('postEditOrganiserPageDesign', ['event_id' => $organiser->id]), 'class' => 'ajax ')); ?>


                    <div class="row">

                        <div class="col-md-6">
                            <h4><?php echo app('translator')->getFromJson("Organiser.organiser_design"); ?></h4>

                            <div class="form-group">
                                <?php echo Form::label('page_header_bg_color', trans("Organiser.header_background_color"), ['class'=>'control-label required ']); ?>

                                <?php echo Form::input('text', 'page_header_bg_color', Input::old('page_header_bg_color'),
                                                            [
                                                            'class'=>'form-control colorpicker',
                                                            'placeholder'=>'#000000'
                                                            ]); ?>

                            </div>
                            <div class="form-group">
                                <?php echo Form::label('page_text_color', trans("Organiser.text_color"), ['class'=>'control-label required ']); ?>

                                <?php echo Form::input('text', 'page_text_color', Input::old('page_text_color'),
                                                            [
                                                            'class'=>'form-control colorpicker',
                                                            'placeholder'=>'#FFFFFF'
                                                            ]); ?>

                            </div>
                            <div class="form-group">
                                <?php echo Form::label('page_bg_color', trans("Organiser.background_color"), ['class'=>'control-label required ']); ?>

                                <?php echo Form::input('text', 'page_bg_color', Input::old('page_bg_color'),
                                                            [
                                                            'class'=>'form-control colorpicker',
                                                            'placeholder'=>'#EEEEEE'
                                                            ]); ?>

                            </div>
                            <div class="form-group">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4><?php echo app('translator')->getFromJson("Organiser.organiser_page_preview"); ?></h4>
                            <div class="preview iframe_wrap"
                                 style="overflow:hidden; height: 500px; border: 1px solid #ccc; overflow: hidden;">
                                <iframe id="previewIframe"
                                        src="<?php echo e(route('showOrganiserHome', ['organiser_id' => $organiser->id])); ?>"
                                        frameborder="0" style="overflow:hidden;height:100%;width:100%" width="100%"
                                        height="100%"></iframe>
                            </div>
                        </div>


                    </div>

                    <div class="panel-footer mt15 text-right">
                        <?php echo Form::submit(trans("basic.save_changes"), ['class'=>"btn btn-success"]); ?>

                    </div>

                    <?php echo Form::close(); ?>


                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Shared.Layouts.Master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageOrganiser/Customize.blade.php ENDPATH**/ ?>