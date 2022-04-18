<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between mb-3 mb-lg-0">
        <div class="col-md-auto d-flex align-items-center gap-2">
            <h1 class="title col-md-auto">
                <?php echo e($questionnaire->title); ?>

            </h1>
            <span>
            <?php if($questionnaire->open): ?>
                <span class="badge rounded-pill bg-success">Open</span>
            <?php else: ?>
                <span class="badge rounded-pill bg-danger">Gesloten</span>
            <?php endif; ?>
        </span>
        </div>
        <div class="col-md-auto d-inline-flex flex-wrap gap-2 gap-sm-1">
            <div>
                <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Button::class, ['type' => 'secondary','link' => ''.e(route('questionnaires.edit', [$research->id, $questionnaire->id])).''] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                    Vragenlijst aanpassen
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
            </div>
            <form method="POST" action="<?php echo e(route('questionnaires.remove', [$research->id, $questionnaire->id])); ?>">
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
                    Vragenlijst verwijderen
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
            </form>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginalea5418acac2e176b0e603a2bc7ce448e7a29a714 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Tabs::class, ['title' => 'questionnaireDetails','tabs' => ['Details', 'Onderdelen', 'Resultaten', 'Participanten']] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\Tabs::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <?php $__env->startSection('Details'); ?>
            <div class="row mt-2">
                <div class="col-sm-6">
                    <strong>Omschrijving</strong>
                    <div>
                        <?php echo e($questionnaire->description); ?>

                    </div>
                </div>
                <div class="col-sm-6">
                    <strong>Instructies</strong>
                    <div>
                        <?php echo e($questionnaire->instructions); ?>

                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <strong>Teachable Machine model</strong>
                <div>
                    <a href="<?php echo e($questionnaire->teachable_machine_link); ?>"><?php echo e($questionnaire->teachable_machine_link); ?></a>
                </div>
            </div>
        <?php $__env->stopSection(); ?>
        <?php $__env->startSection('Onderdelen'); ?>
                <div class="mt-2">
                    <div class="row justify-content-end">
                        <div class="w-auto">
                            <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Button::class, ['type' => 'secondary','link' => ''.e(route('sections.create', [$questionnaire->research->id, $questionnaire->id])).''] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                Nieuwe Onderdeel
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                        </div>
                    </div>
                    <?php if (isset($component)) { $__componentOriginal3606b82a545bf99a0878c9c35435df4aa9156b63 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Table\Table::class, ['tableLinks' => $sectionLinks,'headers' => $sectionHeaders,'items' => $sections,'keys' => $sectionKeys,'rowLink' => $sectionRowLink] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\Table\Table::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3606b82a545bf99a0878c9c35435df4aa9156b63)): ?>
<?php $component = $__componentOriginal3606b82a545bf99a0878c9c35435df4aa9156b63; ?>
<?php unset($__componentOriginal3606b82a545bf99a0878c9c35435df4aa9156b63); ?>
<?php endif; ?>
                </div>
        <?php $__env->stopSection(); ?>
        <?php $__env->startSection('Resultaten'); ?>
        <?php $__env->stopSection(); ?>
        <?php $__env->startSection('Participanten'); ?>
        <?php $__env->stopSection(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalea5418acac2e176b0e603a2bc7ce448e7a29a714)): ?>
<?php $component = $__componentOriginalea5418acac2e176b0e603a2bc7ce448e7a29a714; ?>
<?php unset($__componentOriginalea5418acac2e176b0e603a2bc7ce448e7a29a714); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp-school\htdocs\web-portal\resources\views/admin/questionnaire/details.blade.php ENDPATH**/ ?>