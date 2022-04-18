

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between mb-3 mb-lg-0">
        <div class="col-md-auto d-flex align-items-center gap-2">
            <h1 class="title col-md-auto">
                <?php echo e($question->title); ?>

            </h1>
        </div>
        <div class="col-md-auto d-inline-flex flex-wrap gap-2 gap-sm-1">
            <div>
                <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Button::class, ['type' => 'secondary','link' => ''.e(route('questions.edit', [$research->id,$questionnaire->id, $section->id, $question->id])).''] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                    Vraag aanpassen
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
            </div>
            <form method="POST"
                  action="<?php echo e(route('questions.remove', [$research->id, $questionnaire->id, $section->id, $question->id])); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Button::class, ['type' => 'remove'] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                    Vraag verwijderen
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h2>Gegevens</h2>
            <div class="col-sm-6">
                <strong>Vraag</strong>
                <div>
                    <?php echo e($question->question); ?>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h2>Antwoordmogelijkheden</h2>
            <div class="accordion" id="questionTypes">
                <?php $__currentLoopData = $questionTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $questionType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="accordion-item">
                        <?php if(isset($questionType->extra_data) && count($questionType->extra_data) > 0): ?>
                            <span class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo e($loop->index); ?>" aria-expanded="false" aria-controls="collapseOne">
                                    <?php echo e($questionType->typeDisplay); ?>

                                </button>
                            </span>
                            <div id="collapse<?php echo e($loop->index); ?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#questionTypes">
                                <div class="accordion-body">
                                    <?php $__currentLoopData = $questionType->extra_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $extraData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <strong><?php echo e(__('question-types.'. $key)); ?></strong>
                                        <?php if(is_array($extraData)): ?>
                                            <ul>
                                                <?php $__currentLoopData = $extraData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extraDataItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><?php echo e($extraDataItem); ?></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php else: ?>
                                            <span><?php echo e($extraData === '1' ? 'Ja' : ($extraData === '0' ? 'Nee' : $extraData)); ?></span>
                                        <?php endif; ?>
                                        <br />
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <span class="accordion-header" id="headingOne">
                                <button disabled class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo e($loop->index); ?>" aria-expanded="true" aria-controls="collapseOne">
                                    <?php echo e($questionType->typeDisplay); ?>

                                </button>
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp-school\htdocs\web-portal\resources\views/admin/question/details.blade.php ENDPATH**/ ?>