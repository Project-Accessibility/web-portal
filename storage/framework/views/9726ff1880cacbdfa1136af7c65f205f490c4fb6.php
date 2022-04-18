<div <?php echo e($attributes->merge(['class' => ($type != 'switch' ? 'form-group' : 'form-check form-switch').($errors->has($name) ? ($type == 'switch' ? 'is-invalid highlight-error': '') : '')])); ?>>
    <?php if($label): ?>
        <label for="<?php echo e($name); ?>" class="form-label">
            <?php echo e(ucfirst($label)); ?>

            <?php if($required): ?>
                <span class="text-red ml-1">*</span>
            <?php endif; ?>
        </label>
    <?php endif; ?>
    <?php switch($type):
        case ('text'): ?>
        <?php if(isset($extraData['before']) || isset($extraData['after'])): ?>
            <div class="input-group <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php if(isset($extraData['before'])): ?>
                    <span class="input-group-text"><?php echo e($extraData['before']); ?></span>
                <?php endif; ?>
                <input class="form-control" type="text" id="<?php echo e($name); ?>" title="<?php echo e($name); ?>" name="<?php echo e($name); ?>"
                       placeholder="<?php echo e($placeholder); ?>" value="<?php echo e(old($name, $value)); ?>"/>
                <?php if(isset($extraData['after'])): ?>
                    <span class="input-group-text"><?php echo e($extraData['after']); ?></span>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <input class="form-control <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" id="<?php echo e($name); ?>" title="<?php echo e($name); ?>"
                   name="<?php echo e($name); ?>"
                   placeholder="<?php echo e($placeholder); ?>" value="<?php echo e(old($name, $value)); ?>"/>
        <?php endif; ?>
        <?php break; ?>
        <?php case ('number'): ?>
        <?php if(isset($extraData['before']) || isset($extraData['after'])): ?>
            <div class="input-group <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php if(isset($extraData['before'])): ?>
                    <span class="input-group-text"><?php echo e($extraData['before']); ?></span>
                <?php endif; ?>
                <input class="form-control" type="number" id="<?php echo e($name); ?>" title="<?php echo e($name); ?>" name="<?php echo e($name); ?>"
                       placeholder="<?php echo e($placeholder); ?>" value="<?php echo e(old($name, $value)); ?>"/>
                <?php if(isset($extraData['after'])): ?>
                    <span class="input-group-text"><?php echo e($extraData['after']); ?></span>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <input class="form-control <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number" id="<?php echo e($name); ?>"
                   title="<?php echo e($name); ?>" name="<?php echo e($name); ?>"
                   placeholder="<?php echo e($placeholder); ?>" value="<?php echo e(old($name, $value)); ?>"/>
        <?php endif; ?>
        <?php break; ?>
        <?php case ('textarea'): ?>
        <textarea class="form-control <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" id="<?php echo e($name); ?>" title="<?php echo e($name); ?>"
                  name="<?php echo e($name); ?>"
                  placeholder="<?php echo e($placeholder); ?>"
                  rows="<?php echo e($extraData['rows']); ?>"><?php echo e(old($name, $value)); ?></textarea>
        <?php break; ?>
        <?php case ('password'): ?>
        <input class="form-control <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="password" id="<?php echo e($name); ?>" title="<?php echo e($name); ?>"
               name="<?php echo e($name); ?>"
               placeholder="<?php echo e($placeholder); ?>"/>
        <?php break; ?>
        <?php case ('select'): ?>
        <div class="<?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <?php if($extraData['multiple']): ?>
                <input type="hidden" name="<?php echo e($name); ?>" value=""/>
            <?php endif; ?>
            <select class="selectpicker form-control" id="<?php echo e($name); ?>" title="<?php echo e($name); ?>"
                    name="<?php echo e($name); ?><?php echo e($extraData['multiple']?'[]':''); ?>" <?php echo e($extraData['multiple']?'multiple':''); ?>>
                <?php $__currentLoopData = $extraData['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $value = $extraData['multiple'] ? (old($name, $value) ? old($name, $value) :  []) : old($name, $value) ?? [];
                        $isSelected = !empty($value) && ($extraData['multiple'] ? in_array($option[1], $value) : $value==$option[1])
                    ?>

                    <?php if($isSelected): ?>
                        <option selected value="<?php echo e($option[1]); ?>"><?php echo e($option[0]); ?></option>
                    <?php else: ?>
                        <option value="<?php echo e($option[1]); ?>"><?php echo e($option[0]); ?></option>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <?php break; ?>
        <?php case ('date'): ?>
        <input class="form-control <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="date" id="<?php echo e($name); ?>" title="<?php echo e($name); ?>"
               name="<?php echo e($name); ?>"
               value="<?php echo e(old($name, $value)); ?>"/>
        <?php break; ?>
        <?php case ('datetime'): ?>
        <input class="form-control <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="datetime-local" id="<?php echo e($name); ?>"
               title="<?php echo e($name); ?>" name="<?php echo e($name); ?>"
               value="<?php echo e(old($name, $value)); ?>"/>
        <?php break; ?>
        <?php case ('switch'): ?>
        <input type="hidden" value="0" name="<?php echo e($name); ?>"/>
        <input type="checkbox" value="1" class="form-check-input" id="<?php echo e($name); ?>" title="<?php echo e($name); ?>"
               name="<?php echo e($name); ?>" <?php echo e(is_string(old($name)) ? (old($name) == true ? 'checked': '') : ($value ? 'checked': '')); ?>/>
        <?php break; ?>
        <?php case ('range'): ?>
        <div class="d-flex <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid highlight-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <input type="range" class="form-range w-75" min="<?php echo e($extraData['min']); ?>" max="<?php echo e($extraData['max']); ?>"
                   step="<?php echo e($extraData['step']); ?>" id="<?php echo e($name); ?>" title="<?php echo e($name); ?>" name="<?php echo e($name); ?>"
                   placeholder="<?php echo e($placeholder); ?>" value="<?php echo e(old($name, $value) ?? 0); ?>">
            <output class="mx-3" name="output-<?php echo e($name); ?>"
                    id="output-<?php echo e($name); ?>"><?php echo e(old($name, $value) ?? 0); ?></output>
        </div>
        <script>
            window.addEventListener('load', () => {
                const input = document.getElementById('<?php echo e($name); ?>');
                const output = document.getElementById('output-<?php echo e($name); ?>');
                input.addEventListener('input', () => {
                    output.value = input.value;
                })
            })
        </script>
        <?php break; ?>
        <?php case ('file'): ?>
        <div class="<?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <input id="<?php echo e($name); ?>" title="<?php echo e($name); ?>" name="<?php echo e($name); ?><?php echo e($extraData['multiple']?'[]':''); ?>" type="file"
                   class="file" <?php echo e($extraData['multiple']?'multiple':''); ?>

                   data-show-upload="false" data-show-caption="true" data-msg-placeholder="<?php echo e($placeholder); ?>"
                   value="<?php echo e(old($name, $value)); ?>">
        </div>
        <?php break; ?>
    <?php endswitch; ?>
    <?php if($type != 'switch' ): ?>
        <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <?php endif; ?>
</div>
<?php if($type == 'switch' ): ?>
    <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="invalid-feedback"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
<?php endif; ?>
<?php /**PATH D:\xampp-school\htdocs\web-portal\resources\views/components/input.blade.php ENDPATH**/ ?>