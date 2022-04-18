<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between mb-3 mb-lg-0">
        <h1 class="title col-md-auto"><?php echo e($research->title); ?></h1>
        <div class="col-md-auto d-inline-flex flex-wrap gap-2 gap-sm-1">
            <div>
                <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Button::class, ['type' => 'secondary','link' => ''.e(route('researches.edit', $research->id)).''] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                    Onderzoek aanpassen
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
            </div>
            <form method="POST" action="<?php echo e(route('researches.remove', $research->id)); ?>">
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
                    Onderzoek verwijderen
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
<?php $component = $__env->getContainer()->make(App\View\Components\Tabs::class, ['title' => 'researchesDetails','tabs' => ['Details', 'Vragenlijsten']] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\Tabs::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['currentTab' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Details')]); ?>
        <?php $__env->startSection('Details'); ?>
            <div class="mt-2">
                <strong>Omschrijving</strong>
                <div>
                    <?php echo e($research->description); ?>

                </div>
            </div>
        <?php $__env->stopSection(); ?>
        <?php $__env->startSection('Vragenlijsten'); ?>
            <div class="mt-2">
                <div class="row justify-content-end">
                    <div class="w-auto">
                        <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Button::class, ['type' => 'secondary','link' => ''.e(route('questionnaires.create', $research->id)).''] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                            Nieuwe vragenlijst
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                    </div>
                </div>
                <?php if (isset($component)) { $__componentOriginal3606b82a545bf99a0878c9c35435df4aa9156b63 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Table\Table::class, ['tableLinks' => $questionnaireLinks,'headers' => $questionnaireHeaders,'items' => $questionnaires,'keys' => $questionnaireKeys,'rowLink' => $questionnaireRowLink] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
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
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalea5418acac2e176b0e603a2bc7ce448e7a29a714)): ?>
<?php $component = $__componentOriginalea5418acac2e176b0e603a2bc7ce448e7a29a714; ?>
<?php unset($__componentOriginalea5418acac2e176b0e603a2bc7ce448e7a29a714); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp-school\htdocs\web-portal\resources\views/admin/research/details.blade.php ENDPATH**/ ?>