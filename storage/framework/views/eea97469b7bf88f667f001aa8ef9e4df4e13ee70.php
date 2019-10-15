<div role="dialog"  class="modal fade" style="display: none;">

    <?php echo $__env->make('ManageOrganiser.Partials.EventCreateAndEditJS', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;

    <?php echo Form::open(array('url' => route('postCreateEvent'), 'class' => 'ajax gf')); ?>

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">
                    <i class="ico-calendar"></i>
                    <?php echo app('translator')->getFromJson("Event.create_event"); ?></h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('title', trans("Event.event_title"), array('class'=>'control-label required')); ?>

                            <?php echo Form::text('title', Input::old('title'),array('class'=>'form-control','placeholder'=>trans("Event.event_title_placeholder", ["name"=>Auth::user()->first_name]) )); ?>

                        </div>

                        <div class="form-group custom-theme">
                            <?php echo Form::label('description', trans("Event.event_description"), array('class'=>'control-label required')); ?>

                            <?php echo Form::textarea('description', Input::old('description'),
                                        array(
                                        'class'=>'form-control  editable',
                                        'rows' => 5
                                        )); ?>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php echo Form::label('start_date', trans("Event.event_start_date"), array('class'=>'required control-label')); ?>

                                    <?php echo Form::text('start_date', Input::old('start_date'),
                                                        [
                                                    'class'=>'form-control start hasDatepicker ',
                                                    'data-field'=>'datetime',
                                                    'data-startend'=>'start',
                                                    'data-startendelem'=>'.end',
                                                    'readonly'=>''

                                                ]); ?>

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php echo Form::label('end_date', trans("Event.event_end_date"),
                                                [
                                            'class'=>'required control-label '
                                        ]); ?>


                                    <?php echo Form::text('end_date', Input::old('end_date'),
                                                [
                                            'class'=>'form-control end hasDatepicker ',
                                            'data-field'=>'datetime',
                                            'data-startend'=>'end',
                                            'data-startendelem'=>'.start',
                                            'readonly'=> ''
                                        ]); ?>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo Form::label('event_image', trans("Event.event_image"), array('class'=>'control-label ')); ?>

                            <?php echo Form::styledFile('event_image'); ?>


                        </div>
                        <div class="form-group address-automatic">
                            <?php echo Form::label('name', trans("Event.venue_name"), array('class'=>'control-label required ')); ?>

                            <?php echo Form::text('venue_name_full', Input::old('venue_name_full'),
                                        array(
                                        'class'=>'form-control geocomplete location_field',
                                        'placeholder'=>trans("Event.venue_name_placeholder")
                                        )); ?>


                                    <!--These are populated with the Google places info-->
                            <div>
                                <?php echo Form::hidden('formatted_address', '', ['class' => 'location_field']); ?>

                                <?php echo Form::hidden('street_number', '', ['class' => 'location_field']); ?>

                                <?php echo Form::hidden('country', '', ['class' => 'location_field']); ?>

                                <?php echo Form::hidden('country_short', '', ['class' => 'location_field']); ?>

                                <?php echo Form::hidden('place_id', '', ['class' => 'location_field']); ?>

                                <?php echo Form::hidden('name', '', ['class' => 'location_field']); ?>

                                <?php echo Form::hidden('location', '', ['class' => 'location_field']); ?>

                                <?php echo Form::hidden('postal_code', '', ['class' => 'location_field']); ?>

                                <?php echo Form::hidden('route', '', ['class' => 'location_field']); ?>

                                <?php echo Form::hidden('lat', '', ['class' => 'location_field']); ?>

                                <?php echo Form::hidden('lng', '', ['class' => 'location_field']); ?>

                                <?php echo Form::hidden('administrative_area_level_1', '', ['class' => 'location_field']); ?>

                                <?php echo Form::hidden('sublocality', '', ['class' => 'location_field']); ?>

                                <?php echo Form::hidden('locality', '', ['class' => 'location_field']); ?>

                            </div>
                            <!-- /These are populated with the Google places info-->
                        </div>

                        <div class="address-manual" style="display:none;">
                            <h5>
                                <?php echo app('translator')->getFromJson("Event.address_details"); ?>
                            </h5>

                            <div class="form-group">
                                <?php echo Form::label('location_venue_name', trans("Event.venue_name"), array('class'=>'control-label required ')); ?>

                                <?php echo Form::text('location_venue_name', Input::old('location_venue_name'), [
                                        'class'=>'form-control location_field',
                                        'placeholder'=>trans("Event.venue_name_placeholder")
                                        ]); ?>

                            </div>
                            <div class="form-group">
                                <?php echo Form::label('location_address_line_1', trans("Event.address_line_1"), array('class'=>'control-label')); ?>

                                <?php echo Form::text('location_address_line_1', Input::old('location_address_line_1'), [
                                        'class'=>'form-control location_field',
                                        'placeholder'=>trans("Event.address_line_1_placeholder")
                                        ]); ?>

                            </div>
                            <div class="form-group">
                                <?php echo Form::label('location_address_line_2', trans("Event.address_line_2"), array('class'=>'control-label')); ?>

                                <?php echo Form::text('location_address_line_2', Input::old('location_address_line_2'), [
                                        'class'=>'form-control location_field',
                                        'placeholder'=>trans("Event.address_line_2_placeholder")
                                        ]); ?>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo Form::label('location_state', trans("Event.city"), array('class'=>'control-label')); ?>

                                        <?php echo Form::text('location_state', Input::old('location_state'), [
                                                'class'=>'form-control location_field',
                                                'placeholder'=>trans("Event.city_placeholder")
                                                ]); ?>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo Form::label('location_post_code', trans("Event.post_code"), array('class'=>'control-label')); ?>

                                        <?php echo Form::text('location_post_code', Input::old('location_post_code'), [
                                                'class'=>'form-control location_field',
                                                'placeholder'=>trans("Event.post_code_placeholder")
                                                ]); ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <span>
                            <a data-clear-field=".location_field"
                               data-toggle-class=".address-automatic, .address-manual"
                               data-show-less-text="<?php echo app('translator')->getFromJson("Event.or(manual/existing_venue)"); ?> <b><?php echo app('translator')->getFromJson("Event.enter_existing"); ?></b>" href="javascript:void(0);"
                               class="in-form-link show-more-options clear_location">
                            <?php echo app('translator')->getFromJson("Event.or(manual/existing_venue)"); ?> <b><?php echo app('translator')->getFromJson("Event.enter_manual"); ?></b>
                            </a>
                        </span>

                        <?php if($organiser_id): ?>
                            <?php echo Form::hidden('organiser_id', $organiser_id); ?>

                        <?php else: ?>
                            <div class="create_organiser" style="<?php echo e($organisers->isEmpty() ? '' : 'display:none;'); ?>">
                                <h5>
                                    <?php echo app('translator')->getFromJson("Organiser.organiser_details"); ?>
                                </h5>

                                <div class="form-group">
                                    <?php echo Form::label('organiser_name', trans("Organiser.organiser_name"), array('class'=>'required control-label ')); ?>

                                    <?php echo Form::text('organiser_name', Input::old('organiser_name'),
                                                array(
                                                'class'=>'form-control',
                                                'placeholder'=>trans("Organiser.organiser_name_placeholder")
                                                )); ?>

                                </div>
                                <div class="form-group">
                                    <?php echo Form::label('organiser_email', trans("Organiser.organiser_email"), array('class'=>'control-label required')); ?>

                                    <?php echo Form::text('organiser_email', Input::old('organiser_email'),
                                                array(
                                                'class'=>'form-control ',
                                                'placeholder'=>trans("Organiser.organiser_email_placeholder")
                                                )); ?>

                                </div>
                                <div class="form-group">
                                    <?php echo Form::label('organiser_about', trans("Organiser.organiser_description"), array('class'=>'control-label ')); ?>

                                    <?php echo Form::textarea('organiser_about', Input::old('organiser_about'),
                                                array(
                                                'class'=>'form-control editable2',
                                                'placeholder'=>trans("Organiser.organiser_description_placeholder"),
                                                'rows' => 4
                                                )); ?>

                                </div>
                                <div class="form-group more-options">
                                    <?php echo Form::label('organiser_logo', trans("Organiser.organiser_logo"), array('class'=>'control-label ')); ?>

                                    <?php echo Form::styledFile('organiser_logo'); ?>

                                </div>
                                <div class="row more-options">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo Form::label('organiser_facebook', trans("Organiser.organiser_facebook"), array('class'=>'control-label ')); ?>

                                            <?php echo Form::text('organiser_facebook', Input::old('organiser_facebook'),
                                                array(
                                                'class'=>'form-control ',
                                                'placeholder'=>trans("Organiser.organiser_facebook_placeholder")
                                                )); ?>


                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo Form::label('organiser_twitter', trans("Organiser.organiser_twitter"), array('class'=>'control-label ')); ?>

                                            <?php echo Form::text('organiser_twitter', Input::old('organiser_twitter'),
                                                array(
                                                'class'=>'form-control ',
                                                'placeholder'=>trans("Organiser.organiser_twitter_placeholder")
                                                )); ?>


                                        </div>
                                    </div>
                                </div>

                                <a data-show-less-text="<?php echo app('translator')->getFromJson("Organiser.hide_additional_organiser_options"); ?>" href="javascript:void(0);"
                                   class="in-form-link show-more-options">
                                    <?php echo app('translator')->getFromJson("Organiser.additional_organiser_options"); ?>
                                </a>
                            </div>

                            <?php if(!$organisers->isEmpty()): ?>
                                <div class="form-group select_organiser" style="<?php echo e($organisers ? '' : 'display:none;'); ?>">

                                    <?php echo Form::label('organiser_id', trans("Organiser.select_organiser"), array('class'=>'control-label ')); ?>

                                    <?php echo Form::select('organiser_id', $organisers, $organiser_id, ['class' => 'form-control']); ?>


                                </div>
                                <span class="">
                                    <?php echo app('translator')->getFromJson("Organiser.or"); ?> <a data-toggle-class=".select_organiser, .create_organiser"
                                       data-show-less-text="<b><?php echo app('translator')->getFromJson("Organiser.select_an_organiser"); ?></b>" href="javascript:void(0);"
                                       class="in-form-link show-more-options">
                                        <b><?php echo app('translator')->getFromJson("Organiser.create_an_organiser"); ?></b>
                                    </a>
                                </span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span class="uploadProgress"></span>
                <?php echo Form::button(trans("basic.cancel"), ['class'=>"btn modal-close btn-danger",'data-dismiss'=>'modal']); ?>

                <?php echo Form::submit(trans("Event.create_event"), ['class'=>"btn btn-success"]); ?>

            </div>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageOrganiser/Modals/CreateEvent.blade.php ENDPATH**/ ?>