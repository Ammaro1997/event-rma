<?php $__currentLoopData = $ticket->questions->where('is_enabled', 1)->sortBy('sort_order'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label("ticket_holder_questions[{$ticket->id}][{$i}][$question->id]", $question->title, ['class' => $question->is_required ? 'required' : '']); ?>


            <?php if($question->question_type_id == config('attendize.question_textbox_single')): ?>
                <?php echo Form::text("ticket_holder_questions[{$ticket->id}][{$i}][$question->id]", null, [$question->is_required ? 'required' : '' => $question->is_required ? 'required' : '', 'class' => "ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}   form-control"]); ?>

            <?php elseif($question->question_type_id == config('attendize.question_textbox_multi')): ?>
                <?php echo Form::textarea("ticket_holder_questions[{$ticket->id}][{$i}][$question->id]", null, ['rows'=>5, $question->is_required ? 'required' : '' => $question->is_required ? 'required' : '', 'class' => "ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}  form-control"]); ?>

            <?php elseif($question->question_type_id == config('attendize.question_dropdown_single')): ?>
                <?php echo Form::select("ticket_holder_questions[{$ticket->id}][{$i}][$question->id]", array_merge(['' => '-- Please Select --'], $question->options->pluck('name', 'name')->toArray()), null, [$question->is_required ? 'required' : '' => $question->is_required ? 'required' : '', 'class' => "ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}   form-control"]); ?>

            <?php elseif($question->question_type_id == config('attendize.question_dropdown_multi')): ?>
                <?php echo Form::select("ticket_holder_questions[{$ticket->id}][{$i}][$question->id][]",$question->options->pluck('name', 'name'), null, [$question->is_required ? 'required' : '' => $question->is_required ? 'required' : '', 'multiple' => 'multiple','class' => "ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}   form-control"]); ?>

            <?php elseif($question->question_type_id == config('attendize.question_checkbox_multi')): ?>
                <br>
                <?php $__currentLoopData = $question->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $checkbox_id = md5($ticket->id.$i.$question->id.$option->name);
                    ?>
                    <div class="custom-checkbox">
                        <?php echo Form::checkbox("ticket_holder_questions[{$ticket->id}][{$i}][$question->id][]",$option->name, false,['class' => "ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}  ", 'id' => $checkbox_id]); ?>

                        <label for="<?php echo e($checkbox_id); ?>"><?php echo e($option->name); ?></label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php elseif($question->question_type_id == config('attendize.question_radio_single')): ?>
                <br>
                <?php $__currentLoopData = $question->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $radio_id = md5($ticket->id.$i.$question->id.$option->name);
                    ?>
                <div class="custom-radio">
                    <?php echo Form::radio("ticket_holder_questions[{$ticket->id}][{$i}][$question->id]",$option->name, false, ['id' => $radio_id, 'class' => "ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}  "]); ?>

                    <label for="<?php echo e($radio_id); ?>"><?php echo e($option->name); ?></label>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/Public/ViewEvent/Partials/AttendeeQuestions.blade.php ENDPATH**/ ?>