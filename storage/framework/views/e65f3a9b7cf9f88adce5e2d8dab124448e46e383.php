<?php echo $__env->make('ManageOrganiser.Partials.EventCreateAndEditJS', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo Form::model($event, array('url' => route('postEditEvent', ['event_id' => $event->id]), 'class' => 'ajax gf')); ?>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">
          <?php echo Form::label('currency_id', trans("ManageEvent.default_currency"), array('class'=>'control-label required')); ?>

          <?php echo Form::select('currency_id', $currencies, $event->currency_id, ['class' => 'form-control']); ?>

        </div>
        <div class="form-group">
            <?php echo Form::label('is_live', trans("Event.event_visibility"), array('class'=>'control-label required')); ?>

            <?php echo Form::select('is_live', [
            '1' => trans("Event.vis_public"),
            '0' => trans("Event.vis_hide")],null,
                                        array(
                                        'class'=>'form-control'
                                        )); ?>

        </div>
        <div class="form-group">
            <?php echo Form::label('title', trans("Event.event_title"), array('class'=>'control-label required')); ?>

            <?php echo Form::text('title', Input::old('title'),
                                        array(
                                        'class'=>'form-control',
                                        'placeholder'=>trans("Event.event_title_placeholder", ["name"=>Auth::user()->first_name])
                                        )); ?>

        </div>

        <div class="form-group">
           <?php echo Form::label('description', trans("Event.event_description"), array('class'=>'control-label')); ?>

            <?php echo Form::textarea('description', Input::old('description'),
                                        array(
                                        'class'=>'form-control editable',
                                        'rows' => 5
                                        )); ?>

        </div>

        <div class="form-group address-automatic" style="display:<?php echo e($event->location_is_manual ? 'none' : 'block'); ?>;">
            <?php echo Form::label('name', trans("Event.venue_name"), array('class'=>'control-label required ')); ?>

            <?php echo Form::text('venue_name_full', Input::old('venue_name_full'),
                                        array(
                                        'class'=>'form-control geocomplete location_field',
                                        'placeholder'=>trans("Event.venue_name_placeholder")//'E.g: The Crab Shack'
                                        )); ?>


            <!--These are populated with the Google places info-->
            <div>
               <?php echo Form::hidden('formatted_address', $event->location_address, ['class' => 'location_field']); ?>

               <?php echo Form::hidden('street_number', $event->location_street_number, ['class' => 'location_field']); ?>

               <?php echo Form::hidden('country', $event->location_country, ['class' => 'location_field']); ?>

               <?php echo Form::hidden('country_short', $event->location_country_short, ['class' => 'location_field']); ?>

               <?php echo Form::hidden('place_id', $event->location_google_place_id, ['class' => 'location_field']); ?>

               <?php echo Form::hidden('name', $event->venue_name, ['class' => 'location_field']); ?>

               <?php echo Form::hidden('location', '', ['class' => 'location_field']); ?>

               <?php echo Form::hidden('postal_code', $event->location_post_code, ['class' => 'location_field']); ?>

               <?php echo Form::hidden('route', $event->location_address_line_1, ['class' => 'location_field']); ?>

               <?php echo Form::hidden('lat', $event->location_lat, ['class' => 'location_field']); ?>

               <?php echo Form::hidden('lng', $event->location_long, ['class' => 'location_field']); ?>

               <?php echo Form::hidden('administrative_area_level_1', $event->location_state, ['class' => 'location_field']); ?>

               <?php echo Form::hidden('sublocality', '', ['class' => 'location_field']); ?>

               <?php echo Form::hidden('locality', $event->location_address_line_1, ['class' => 'location_field']); ?>

            </div>
            <!-- /These are populated with the Google places info-->

        </div>

        <div class="address-manual" style="display:<?php echo e($event->location_is_manual ? 'block' : 'none'); ?>;">
            <div class="form-group">
                <?php echo Form::label('location_venue_name', trans("Event.venue_name"), array('class'=>'control-label required ')); ?>

                <?php echo Form::text('location_venue_name', $event->venue_name, [
                                        'class'=>'form-control location_field',
                                        'placeholder'=>trans("Event.venue_name_placeholder") // same as above
                            ]); ?>

            </div>
            <div class="form-group">
                <?php echo Form::label('location_address_line_1', trans("Event.address_line_1"), array('class'=>'control-label')); ?>

                <?php echo Form::text('location_address_line_1', $event->location_address_line_1, [
                                        'class'=>'form-control location_field',
                                        'placeholder'=>trans("Event.address_line_1_placeholder")//'E.g: 45 Grafton St.'
                            ]); ?>

            </div>
            <div class="form-group">
                <?php echo Form::label('location_address_line_2', trans("Event.address_line_2"), array('class'=>'control-label')); ?>

                <?php echo Form::text('location_address_line_2', $event->location_address_line_2, [
                                        'class'=>'form-control location_field',
                                        'placeholder'=>trans("Event.address_line_2_placeholder")//'E.g: Dublin.'
                            ]); ?>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('location_state', trans("Event.city"), array('class'=>'control-label')); ?>

                        <?php echo Form::text('location_state', $event->location_state, [
                                        'class'=>'form-control location_field',
                                        'placeholder'=>trans("Event.city_placeholder")//'E.g: Dublin.'
                            ]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('location_post_code', trans("Event.post_code"), array('class'=>'control-label')); ?>

                        <?php echo Form::text('location_post_code', $event->location_post_code, [
                                        'class'=>'form-control location_field',
                                        'placeholder'=>trans("Event.post_code_placeholder")// 'E.g: 94568.'
                            ]); ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix" style="margin-top:-10px; padding: 5px; padding-top: 0px;">
            <span class="pull-right">
                <?php echo app('translator')->getFromJson("Event.or(manual/existing_venue)"); ?> <a data-clear-field=".location_field" data-toggle-class=".address-automatic, .address-manual" data-show-less-text="<?php echo e($event->location_is_manual ? trans("Event.enter_manual"):trans("Event.enter_existing")); ?>" href="javascript:void(0);" class="show-more-options clear_location"><?php echo e($event->location_is_manual ? trans("Event.enter_existing"):trans("Event.enter_manual")); ?></a>
            </span>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <?php echo Form::label('start_date', trans("Event.event_start_date"), array('class'=>'required control-label')); ?>

                    <?php echo Form::text('start_date', $event->getFormattedDate('start_date'),
                                                        [
                                                    'class'=>'form-control start hasDatepicker ',
                                                    'data-field'=>'datetime',
                                                    'data-startend'=>'start',
                                                    'data-startendelem'=>'.end',
                                                    'readonly'=>''

                                                ]); ?>

                </div>
            </div>

            <div class="col-sm-6 ">
                <div class="form-group">
                    <?php echo Form::label('end_date', trans("Event.event_end_date"),
                                        [
                                    'class'=>'required control-label '
                                ]); ?>

                    <?php echo Form::text('end_date', $event->getFormattedDate('end_date'),
                                                [
                                            'class'=>'form-control end hasDatepicker ',
                                            'data-field'=>'datetime',
                                            'data-startend'=>'end',
                                            'data-startendelem'=>'.start',
                                            'readonly'=>''
                                        ]); ?>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                   <?php echo Form::label('event_image', trans("Event.event_flyer"), array('class'=>'control-label ')); ?>

                   <?php echo Form::styledFile('event_image', 1); ?>

                </div>

                <?php if($event->images->count()): ?>
                    <div class="form-group">
                        <?php echo Form::label('event_image_position', trans("Event.event_image_position"), array('class'=>'control-label')); ?>

                        <?php echo Form::select('event_image_position', [
                                '' => trans("Event.event_image_position_hide"),
                                'before' => trans("Event.event_image_position_before"),
                                'after' => trans("Event.event_image_position_after"),
                                'left' => trans("Event.event_image_position_left"),
                                'right' => trans("Event.event_image_position_right"),
                            ],
                            Input::old('event_image_position'),
                            ['class'=>'form-control']
                        ); ?>

                    </div>
                    <?php echo Form::label('', trans("Event.current_event_flyer"), array('class'=>'control-label ')); ?>

                    <div class="form-group">
                        <div class="well well-sm well-small">
                           <?php echo Form::label('remove_current_image', trans("Event.delete?"), array('class'=>'control-label ')); ?>

                           <?php echo Form::checkbox('remove_current_image'); ?>


                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <div class="float-l">
                    <?php if($event->images->count()): ?>
                    <div class="thumbnail">
                       <?php echo HTML::image('/'.$event->images->first()['image_path']); ?>

                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('google_tag_manager_code', trans("Organiser.google_tag_manager_code"), ['class'=>'control-label']); ?>

                    <?php echo Form::text('google_tag_manager_code', Input::old('google_tag_manager_code'), [
                            'class'=>'form-control',
                            'placeholder' => trans("Organiser.google_tag_manager_code_placeholder"),
                        ]); ?>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="panel-footer mt15 text-right">
           <?php echo Form::hidden('organiser_id', $event->organiser_id); ?>

           <?php echo Form::submit(trans("Event.save_changes"), ['class'=>"btn btn-success"]); ?>

        </div>
    </div>
    <?php echo Form::close(); ?>

</div>

<?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageEvent/Partials/EditEventForm.blade.php ENDPATH**/ ?>