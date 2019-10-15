<?php $__env->startSection('title'); ?>
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
    <?php echo app('translator')->getFromJson("Event.customize_event"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('top_nav'); ?>
    <?php echo $__env->make('ManageEvent.Partials.TopNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('menu'); ?>
    <?php echo $__env->make('ManageEvent.Partials.Sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title'); ?>
    <i class="ico-cog mr5"></i>
    <?php echo app('translator')->getFromJson("Event.customize_event"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_header'); ?>
    <style>
        .page-header {
            display: none;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>
    <?php echo HTML::script('https://maps.googleapis.com/maps/api/js?libraries=places&key='.config("attendize.google_maps_geocoding_key")); ?>

    <?php echo HTML::script('vendor/geocomplete/jquery.geocomplete.min.js'); ?>

    <script>
        $(function () {

            $("input[name='organiser_fee_percentage']").TouchSpin({
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                verticalbuttons: true,
                forcestepdivisibility: 'none',
                postfix: '%',
                buttondown_class: "btn btn-link",
                buttonup_class: "btn btn-link",
                postfix_extraclass: "btn btn-link"
            });
            $("input[name='organiser_fee_fixed']").TouchSpin({
                min: 0,
                max: 100,
                step: 0.01,
                decimals: 2,
                verticalbuttons: true,
                postfix: '<?php echo e($event->currency->symbol_left); ?>',
                buttondown_class: "btn btn-link",
                buttonup_class: "btn btn-link",
                postfix_extraclass: "btn btn-link"
            });

            /* Affiliate generator */
            $('#affiliateGenerator').on('keyup', function () {
                var text = $(this).val().replace(/\W/g, ''),
                        referralUrl = '<?php echo e($event->event_url); ?>?ref=' + text;

                $('#referralUrl').toggle(text !== '');
                $('#referralUrl input').val(referralUrl);
            });

            /* Background selector */
            $('.bgImage').on('click', function (e) {
                $('.bgImage').removeClass('selected');
                $(this).addClass('selected');
                $('input[name=bg_image_path_custom]').val($(this).data('src'));

                var replaced = replaceUrlParam('<?php echo e(route('showEventPagePreview', ['event_id'=>$event->id])); ?>', 'bg_img_preview', $('input[name=bg_image_path_custom]').val());
                document.getElementById('previewIframe').src = replaced;
                e.preventDefault();
            });

            /* Background color */
            $('input[name=bg_color]').on('change', function (e) {
                var replaced = replaceUrlParam('<?php echo e(route('showEventPagePreview', ['event_id'=>$event->id])); ?>', 'bg_color_preview', $('input[name=bg_color]').val().substring(1));
                document.getElementById('previewIframe').src = replaced;
                e.preventDefault();
            });

            $('#bgOptions .panel').on('shown.bs.collapse', function (e) {
                var type = $(e.currentTarget).data('type');
                console.log(type);
                $('input[name=bg_type]').val(type);
            });

            $('input[name=bg_image_path], input[name=bg_color]').on('change', function () {
                //showMessage('Uploading...');
                //$('.customizeForm').submit();
            });

            /* Color picker */
            $('.colorpicker').minicolors();

            $('#ticket_design .colorpicker').on('change', function (e) {
                var borderColor = $('input[name="ticket_border_color"]').val();
                var bgColor = $('input[name="ticket_bg_color"]').val();
                var textColor = $('input[name="ticket_text_color"]').val();
                var subTextColor = $('input[name="ticket_sub_text_color"]').val();

                $('.ticket').css({
                    'border': '1px solid ' + borderColor,
                    'background-color': bgColor,
                    'color': subTextColor,
                    'border-left-color': borderColor
                });
                $('.ticket h4').css({
                    'color': textColor
                });
                $('.ticket .logo').css({
                    'border-left': '1px solid ' + borderColor,
                    'border-bottom': '1px solid ' + borderColor
                });
                $('.ticket .barcode').css({
                    'border-right': '1px solid ' + borderColor,
                    'border-bottom': '1px solid ' + borderColor,
                    'border-top': '1px solid ' + borderColor
                });

            });

            $('#enable_offline_payments').change(function () {
                $('.offline_payment_details').toggle(this.checked);
            }).change();
        });


    </script>

    <style type="text/css">
        .bootstrap-touchspin-postfix {
            background-color: #ffffff;
            color: #333;
            border-left: none;
        }

        .bgImage {
            cursor: pointer;
        }

        .bgImage.selected {
            outline: 4px solid #0099ff;
        }
    </style>
    <script>
        $(function () {

            var hash = document.location.hash;
            var prefix = "tab_";
            if (hash) {
                $('.nav-tabs a[href=' + hash + ']').tab('show');
            }

            $(window).on('hashchange', function () {
                var newHash = location.hash;
                if (typeof newHash === undefined) {
                    $('.nav-tabs a[href=' + '#general' + ']').tab('show');
                } else {
                    $('.nav-tabs a[href=' + newHash + ']').tab('show');
                }

            });

            $('.nav-tabs a').on('shown.bs.tab', function (e) {
                window.location.hash = e.target.hash;
            });

        });


    </script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <!-- tab -->
            <ul class="nav nav-tabs">
                <li data-route="<?php echo e(route('showEventCustomizeTab', ['event_id' => $event->id, 'tab' => 'general'])); ?>"
                    class="<?php echo e(($tab == 'general' || !$tab) ? 'active' : ''); ?>"><a href="#general" data-toggle="tab"><?php echo app('translator')->getFromJson("basic.general"); ?></a>
                </li>
                <li data-route="<?php echo e(route('showEventCustomizeTab', ['event_id' => $event->id, 'tab' => 'design'])); ?>"
                    class="<?php echo e($tab == 'design' ? 'active' : ''); ?>"><a href="#design" data-toggle="tab"><?php echo app('translator')->getFromJson("basic.event_page_design"); ?></a></li>
                <li data-route="<?php echo e(route('showEventCustomizeTab', ['event_id' => $event->id, 'tab' => 'order_page'])); ?>"
                    class="<?php echo e($tab == 'order_page' ? 'active' : ''); ?>"><a href="#order_page" data-toggle="tab"><?php echo app('translator')->getFromJson("basic.order_form"); ?></a></li>

                <li data-route="<?php echo e(route('showEventCustomizeTab', ['event_id' => $event->id, 'tab' => 'social'])); ?>"
                    class="<?php echo e($tab == 'social' ? 'active' : ''); ?>"><a href="#social" data-toggle="tab"><?php echo app('translator')->getFromJson("basic.social"); ?></a></li>
                <li data-route="<?php echo e(route('showEventCustomizeTab', ['event_id' => $event->id, 'tab' => 'affiliates'])); ?>"
                    class="<?php echo e($tab == 'affiliates' ? 'active' : ''); ?>"><a href="#affiliates"
                                                                        data-toggle="tab"><?php echo app('translator')->getFromJson("basic.affiliates"); ?></a></li>
                <li data-route="<?php echo e(route('showEventCustomizeTab', ['event_id' => $event->id, 'tab' => 'fees'])); ?>"
                    class="<?php echo e($tab == 'fees' ? 'active' : ''); ?>"><a href="#fees" data-toggle="tab"><?php echo app('translator')->getFromJson("basic.service_fees"); ?></a></li>
                <li data-route="<?php echo e(route('showEventCustomizeTab', ['event_id' => $event->id, 'tab' => 'ticket_design'])); ?>"
                    class="<?php echo e($tab == 'ticket_design' ? 'active' : ''); ?>"><a href="#ticket_design" data-toggle="tab"><?php echo app('translator')->getFromJson("basic.ticket_design"); ?></a></li>
            </ul>
            <!--/ tab -->
            <!-- tab content -->
            <div class="tab-content panel">
                <div class="tab-pane <?php echo e(($tab == 'general' || !$tab) ? 'active' : ''); ?>" id="general">
                    <?php echo $__env->make('ManageEvent.Partials.EditEventForm', ['event'=>$event, 'organisers'=>\Auth::user()->account->organisers], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

                <div class="tab-pane <?php echo e($tab == 'affiliates' ? 'active' : ''); ?>" id="affiliates">

                    <h4><?php echo app('translator')->getFromJson("Affiliates.affiliate_tracking"); ?></h4>

                    <div class="well">
                        <?php echo app('translator')->getFromJson("Affiliates.affiliate_tracking_text"); ?>

                        <br><br>

                        <input type="text" id="affiliateGenerator" name="affiliateGenerator" class="form-control"/>

                        <div style="display:none; margin-top:10px; " id="referralUrl">
                            <input onclick="this.select();" type="text" name="affiliateLink" class="form-control"/>
                        </div>
                    </div>

                    <?php if($event->affiliates->count()): ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><?php echo app('translator')->getFromJson("Affiliates.affiliate_name"); ?></th>
                                    <th><?php echo app('translator')->getFromJson("Affiliates.visits_generated"); ?></th>
                                    <th><?php echo app('translator')->getFromJson("Affiliates.ticket_sales_generated"); ?></th>
                                    <th><?php echo app('translator')->getFromJson("Affiliates.sales_volume_generated"); ?></th>
                                    <th><?php echo app('translator')->getFromJson("Affiliates.last_referral"); ?></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php $__currentLoopData = $event->affiliates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $affiliate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($affiliate->name); ?></td>
                                        <td><?php echo e($affiliate->visits); ?></td>
                                        <td><?php echo e($affiliate->tickets_sold); ?></td>
                                        <td><?php echo e(money($affiliate->sales_volume, $event->currency)); ?></td>
                                        <td><?php echo e($affiliate->updated_at->format(config("attendize.default_datetime_format"))); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <?php echo app('translator')->getFromJson("Affiliates.no_affiliate_referrals_yet"); ?>
                        </div>
                    <?php endif; ?>


                </div>
                <div class="tab-pane <?php echo e($tab == 'social' ? 'active' : ''); ?>" id="social">
                    <div class="well hide"> <?php /*Seems like unfinished feature -> not translating*/ ?>
                        <h5>The following short codes are available for use:</h5>
                        Display the event's public URL: <code>[event_url]</code><br>
                        Display the organiser's name: <code>[organiser_name]</code><br>
                        Display the event title: <code>[event_title]</code><br>
                        Display the event description: <code>[event_description]</code><br>
                        Display the event start date & time: <code>[event_start_date]</code><br>
                        Display the event end date & time: <code>[event_end_date]</code>
                    </div>

                    <?php echo Form::model($event, array('url' => route('postEditEventSocial', ['event_id' => $event->id]), 'class' => 'ajax ')); ?>


                    <h4><?php echo app('translator')->getFromJson("Social.social_settings"); ?></h4>

                    <div class="form-group hide">

                        <?php echo Form::label('social_share_text', trans("Social.social_share_text"), array('class'=>'control-label ')); ?>


                        <?php echo Form::textarea('social_share_text', $event->social_share_text, [
                            'class' => 'form-control',
                            'rows' => 4
                        ]); ?>

                        <div class="help-block">
                            <?php echo app('translator')->getFromJson("Social.social_share_text_help"); ?>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="control-label"><?php echo app('translator')->getFromJson("Social.share_buttons_to_show"); ?></label>
                        <br>

                        <div class="custom-checkbox mb5">
                            <?php echo Form::checkbox('social_show_facebook', 1, $event->social_show_facebook, ['id' => 'social_show_facebook', 'data-toggle' => 'toggle']); ?>

                            <?php echo Form::label('social_show_facebook', trans("Social.facebook")); ?>

                        </div>
                        <div class="custom-checkbox mb5">

                            <?php echo Form::checkbox('social_show_twitter', 1, $event->social_show_twitter, ['id' => 'social_show_twitter', 'data-toggle' => 'toggle']); ?>

                            <?php echo Form::label('social_show_twitter', trans("Social.twitter")); ?>


                        </div>

                        <div class="custom-checkbox mb5">
                            <?php echo Form::checkbox('social_show_email', 1, $event->social_show_email, ['id' => 'social_show_email', 'data-toggle' => 'toggle']); ?>

                            <?php echo Form::label('social_show_email', trans("Social.email")); ?>

                        </div>
                        <div class="custom-checkbox mb5">
                            <?php echo Form::checkbox('social_show_googleplus', 1, $event->social_show_googleplus, ['id' => 'social_show_googleplus', 'data-toggle' => 'toggle']); ?>

                            <?php echo Form::label('social_show_googleplus', trans("Social.g+")); ?>

                        </div>
                        <div class="custom-checkbox mb5">
                            <?php echo Form::checkbox('social_show_linkedin', 1, $event->social_show_linkedin, ['id' => 'social_show_linkedin', 'data-toggle' => 'toggle']); ?>

                            <?php echo Form::label('social_show_linkedin', trans("Social.linkedin")); ?>

                        </div>
                        <div class="custom-checkbox">

                            <?php echo Form::checkbox('social_show_whatsapp', 1, $event->social_show_whatsapp, ['id' => 'social_show_whatsapp', 'data-toggle' => 'toggle']); ?>

                            <?php echo Form::label('social_show_whatsapp', trans("Social.whatsapp")); ?>



                        </div>
                    </div>

                    <div class="panel-footer mt15 text-right">
                        <?php echo Form::submit(trans("basic.save_changes"), ['class'=>"btn btn-success"]); ?>

                    </div>

                    <?php echo Form::close(); ?>


                </div>
                <div class="tab-pane scale_iframe <?php echo e($tab == 'design' ? 'active' : ''); ?>" id="design">

                    <div class="row">
                        <div class="col-sm-6">

                            <?php echo Form::open(array('url' => route('postEditEventDesign', ['event_id' => $event->id]), 'files'=> true, 'class' => 'ajax customizeForm')); ?>


                            <?php echo Form::hidden('bg_type', $event->bg_type); ?>


                            <h4><?php echo app('translator')->getFromJson("Design.background_options"); ?></h4>

                            <div class="panel-group" id="bgOptions">

                                <div class="panel panel-default" data-type="color">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#bgOptions" href="#bgColor"
                                               class="<?php echo e(($event->bg_type == 'color') ? '' : 'collapsed'); ?>">
                                                <span class="arrow mr5"></span> <?php echo app('translator')->getFromJson("Design.use_a_colour_for_the_background"); ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="bgColor"
                                         class="panel-collapse <?php echo e(($event->bg_type == 'color') ? 'in' : 'collapse'); ?>">
                                        <div class="panel-body">
                                            <?php echo Form::text('bg_color', $event->bg_color, ['class' => 'colorpicker form-control']); ?>

                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default" data-type="image">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#bgOptions" href="#bgImage"
                                               class="<?php echo e(($event->bg_type == 'image') ? '' : 'collapsed'); ?>">
                                                <span class="arrow mr5"></span> <?php echo app('translator')->getFromJson("Design.select_from_available_images"); ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="bgImage"
                                         class="panel-collapse <?php echo e(($event->bg_type == 'image') ? 'in' : 'collapse'); ?>">
                                        <div class="panel-body">
                                            <?php $__currentLoopData = $available_bg_images_thumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bg_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <img data-3="<?php echo e(str_replace('/thumbs', '', $event->bg_image_path)); ?>"
                                                     class="img-thumbnail ma5 bgImage <?php echo e(($bg_image === str_replace('/thumbs', '', $event->bg_image_path) ? 'selected' : '')); ?>"
                                                     style="width: 120px;" src="<?php echo e(asset($bg_image)); ?>"
                                                     data-src="<?php echo e(str_replace('/thumbs', '', substr($bg_image,1))); ?>"/>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php echo Form::hidden('bg_image_path_custom', ($event->bg_type == 'image') ? $event->bg_image_path : ''); ?>

                                        </div>
                                            <a class="btn btn-link" href="https://pixabay.com?ref=attendize" title="PixaBay Free Images">
                                                <?php echo app('translator')->getFromJson("Design.images_provided_by_pixabay"); ?>
                                            </a>
                                    </div>
                                </div>

                            </div>
                            <div class="panel-footer mt15 text-right">
                                <span class="uploadProgress" style="display:none;"></span>
                                <?php echo Form::submit(trans("basic.save_changes"), ['class'=>"btn btn-success"]); ?>

                            </div>

                            <div class="panel-footer ar hide">
                                <?php echo Form::button(trans("basic.cancel"), ['class'=>"btn modal-close btn-danger",'data-dismiss'=>'modal']); ?>

                                <?php echo Form::submit(trans("basic.save_changes"), ['class'=>"btn btn-success"]); ?>

                            </div>

                            <?php echo Form::close(); ?>


                        </div>
                        <div class="col-sm-6">
                            <h4><?php echo app('translator')->getFromJson("Design.event_page_preview"); ?></h4>

                            <div class="iframe_wrap" style="overflow:hidden; height: 600px; border: 1px solid #ccc;">
                                <iframe id="previewIframe"
                                        src="<?php echo e(route('showEventPagePreview', ['event_id'=>$event->id])); ?>"
                                        frameborder="0" style="overflow:hidden;height:100%;width:100%" height="100%"
                                        width="100%">
                                </iframe>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane <?php echo e($tab == 'fees' ? 'active' : ''); ?>" id="fees">
                    <?php echo Form::model($event, array('url' => route('postEditEventFees', ['event_id' => $event->id]), 'class' => 'ajax')); ?>

                    <h4><?php echo app('translator')->getFromJson("Fees.organiser_fees"); ?></h4>

                    <div class="well">
                        <?php echo @trans("Fees.organiser_fees_text"); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Form::label('organiser_fee_percentage', trans("Fees.service_fee_percentage"), array('class'=>'control-label required')); ?>

                        <?php echo Form::text('organiser_fee_percentage', $event->organiser_fee_percentage, [
                            'class' => 'form-control',
                            'placeholder' => trans("Fees.service_fee_percentage_placeholder")
                        ]); ?>

                        <div class="help-block">
                            <?php echo @trans("Fees.service_fee_percentage_help"); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo Form::label('organiser_fee_fixed', trans("Fees.service_fee_fixed_price"), array('class'=>'control-label required')); ?>

                        <?php echo Form::text('organiser_fee_fixed', null, [
                            'class' => 'form-control',
                            'placeholder' => trans("Fees.service_fee_fixed_price_placeholder")
                        ]); ?>

                        <div class="help-block">
                            <?php echo @trans("Fees.service_fee_fixed_price_help", ["cur"=>$event->currency_symbol]); ?>

                        </div>
                    </div>
                    <div class="panel-footer mt15 text-right">
                        <?php echo Form::submit(trans("basic.save_changes"), ['class'=>"btn btn-success"]); ?>

                    </div>
                    <?php echo Form::close(); ?>

                </div>
                <div class="tab-pane" id="social"> <?php /* Seems like another unused section (duplicate id 'social') */ ?>
                    <h4>Social Settings</h4>

                    <div class="form-group">
                        <div class="checkbox custom-checkbox">
                            <?php echo Form::label('event_page_show_map', 'Show map on event page?', array('id' => 'customcheckbox', 'class'=>'control-label')); ?>

                            <?php echo Form::checkbox('event_page_show_map', 1, false); ?>

                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo Form::label('event_page_show_social_share', 'Show social share buttons?', array('class'=>'control-label')); ?>

                        <?php echo Form::checkbox('event_page_show_social_share', 1, false); ?>

                    </div>

                </div>

                <div class="tab-pane <?php echo e($tab == 'order_page' ? 'active' : ''); ?>" id="order_page">
                    <?php echo Form::model($event, array('url' => route('postEditEventOrderPage', ['event_id' => $event->id]), 'class' => 'ajax ')); ?>

                    <h4><?php echo app('translator')->getFromJson("Order.order_page_settings"); ?></h4>

                    <div class="form-group">
                        <?php echo Form::label('pre_order_display_message', trans("Order.before_order"), array('class'=>'control-label ')); ?>


                        <?php echo Form::textarea('pre_order_display_message', $event->pre_order_display_message, [
                            'class' => 'form-control',
                            'rows' => 4
                        ]); ?>

                        <div class="help-block">
                            <?php echo app('translator')->getFromJson("Order.before_order_help"); ?>
                        </div>

                    </div>
                    <div class="form-group">
                        <?php echo Form::label('post_order_display_message', trans("Order.after_order"), array('class'=>'control-label ')); ?>


                        <?php echo Form::textarea('post_order_display_message', $event->post_order_display_message, [
                            'class' => 'form-control',
                            'rows' => 4
                        ]); ?>

                        <div class="help-block">
                            <?php echo app('translator')->getFromJson("Order.after_order_help"); ?>
                        </div>
                    </div>


                        <h4><?php echo app('translator')->getFromJson("Order.offline_payment_settings"); ?></h4>
                        <div class="form-group">
                            <div class="custom-checkbox">
                                <input <?php echo e($event->enable_offline_payments ? 'checked="checked"' : ''); ?> data-toggle="toggle" id="enable_offline_payments" name="enable_offline_payments" type="checkbox" value="1">
                                <label for="enable_offline_payments"><?php echo app('translator')->getFromJson("Order.enable_offline_payments"); ?></label>
                            </div>
                        </div>
                        <div class="offline_payment_details" style="display: none;">
                            <?php echo Form::textarea('offline_payment_instructions', $event->offline_payment_instructions, ['class' => 'form-control editable']); ?>

                            <div class="help-block">
                                <?php echo app('translator')->getFromJson("Order.offline_payment_instructions"); ?>
                            </div>
                        </div>


                    <div class="panel-footer mt15 text-right">
                        <?php echo Form::submit(trans("basic.save_changes"), ['class'=>"btn btn-success"]); ?>

                    </div>

                    <?php echo Form::close(); ?>


                </div>


                <div class="tab-pane <?php echo e($tab == 'ticket_design' ? 'active' : ''); ?>" id="ticket_design">
                    <?php echo Form::model($event, array('url' => route('postEditEventTicketDesign', ['event_id' => $event->id]), 'class' => 'ajax ')); ?>

                    <h4><?php echo app('translator')->getFromJson("Ticket.ticket_design"); ?></h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('ticket_border_color', trans("Ticket.ticket_border_color"), ['class'=>'control-label required ']); ?>

                                <?php echo Form::input('text', 'ticket_border_color', Input::old('ticket_border_color'),
                                                            [
                                                            'class'=>'form-control colorpicker',
                                                            'placeholder'=>'#000000'
                                                            ]); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('ticket_bg_color', trans("Ticket.ticket_background_color"), ['class'=>'control-label required ']); ?>

                                <?php echo Form::input('text', 'ticket_bg_color', Input::old('ticket_bg_color'),
                                                            [
                                                            'class'=>'form-control colorpicker',
                                                            'placeholder'=>'#FFFFFF'
                                                            ]); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('ticket_text_color', trans("Ticket.ticket_text_color"), ['class'=>'control-label required ']); ?>

                                <?php echo Form::input('text', 'ticket_text_color', Input::old('ticket_text_color'),
                                                            [
                                                            'class'=>'form-control colorpicker',
                                                            'placeholder'=>'#000000'
                                                            ]); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('ticket_sub_text_color', trans("Ticket.ticket_sub_text_color"), ['class'=>'control-label required ']); ?>

                                <?php echo Form::input('text', 'ticket_sub_text_color', Input::old('ticket_border_color'),
                                                            [
                                                            'class'=>'form-control colorpicker',
                                                            'placeholder'=>'#000000'
                                                            ]); ?>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo Form::label('is_1d_barcode_enabled', trans("Ticket.show_1d_barcode"), ['class' => 'control-label required']); ?>

                                <?php echo Form::select('is_1d_barcode_enabled', [1 => trans("basic.yes"), 0 => trans("basic.no")], $event->is_1d_barcode_enabled, ['class'=>'form-control']); ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <h4><?php echo app('translator')->getFromJson("Ticket.ticket_preview"); ?></h4>
                            <?php echo $__env->make('ManageEvent.Partials.TicketDesignPreview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <div class="panel-footer mt15 text-right">
                        <?php echo Form::submit(trans("basic.save_changes"), ['class'=>"btn btn-success"]); ?>

                    </div>
                    <?php echo Form::close(); ?>

                </div>
            <!--/ tab content -->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Shared.Layouts.Master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/ManageEvent/Customize.blade.php ENDPATH**/ ?>