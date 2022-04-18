

<?php $__env->startSection('content'); ?>

    <div class="row justify-content-between mb-3 mb-lg-0">
        <div class="col-md-auto d-flex align-items-center gap-2">
            <h1 class="title col-md-auto">
                <?php echo e($section->title); ?>

            </h1>
        </div>
        <div class="col-md-auto d-inline-flex flex-wrap gap-2 gap-sm-1">
            <div>
                <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Button::class, ['type' => 'secondary','link' => ''.e(route('sections.edit', [$research->id,$questionnaire->id, $section->id])).''] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                    Onderdeel aanpassen
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
            </div>
            <form method="POST"
                  action="<?php echo e(route('sections.remove', [$research->id, $questionnaire->id, $section->id])); ?>">
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
                    Onderdeel verwijderen
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
<?php $component = $__env->getContainer()->make(App\View\Components\Tabs::class, ['title' => 'sectionDetails','tabs' => ['Details', 'Vragen', 'Resultaten']] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\Tabs::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <?php $__env->startSection('Details'); ?>
            <div class="row mt-2">
                <h2>Gegevens</h2>
                <div class="col-sm-6">
                    <strong>Omschrijving</strong>
                    <div>
                        <?php echo e($section->description ?? 'Geen onderdeel omschrijving'); ?>

                    </div>
                </div>
                <div class="col-sm-6">
                    <strong>Locatie omschrijving</strong>
                    <div>
                        <?php echo e($section->location_description ?? 'Geen locatie omschrijving'); ?>

                    </div>
                </div>
            </div>
            <div class="row" id="geofence-section" hidden>
                <h2>Geofence</h2>
                <input id="radius" value="<?php echo e($geofence ? $geofence->radius : 30); ?>" hidden/>
                <input id="latitude" value="<?php echo e($geofence ? $geofence->latitude : ''); ?>" hidden/>
                <input id="longitude" value="<?php echo e($geofence ? $geofence->longitude : ''); ?>" hidden/>
                <div id="map" class="h-100 border border-primary" style="min-height: 200px;"></div>
            </div>
            <link href="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.css" rel="stylesheet">
            <script src="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.js"></script>
            <script>mapboxgl.accessToken = 'pk.eyJ1IjoibWlsb3ZkcGFzIiwiYSI6ImNsMW5veGNtcjByaXozYnFycmdlOW1mY2gifQ.XlD67O_pB2Q-ULGzQ_HQOw';</script>
            <script src="<?php echo e(asset('js/location.js')); ?>"></script>
        <?php $__env->stopSection(); ?>
        <?php $__env->startSection('Vragen'); ?>
            <div class="mt-2">
                <div class="row justify-content-end">
                    <div class="w-auto">
                        <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Button::class, ['type' => 'secondary','link' => ''.e(route('questions.create', [$questionnaire->research->id, $questionnaire->id, $section->id])).''] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                            Nieuwe vraag
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                    </div>
                </div>
                <?php if (isset($component)) { $__componentOriginal3606b82a545bf99a0878c9c35435df4aa9156b63 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Table\Table::class, ['headers' => $questionHeaders,'items' => $questions,'keys' => $questionKeys,'rowLink' => $questionRowLink] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
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
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalea5418acac2e176b0e603a2bc7ce448e7a29a714)): ?>
<?php $component = $__componentOriginalea5418acac2e176b0e603a2bc7ce448e7a29a714; ?>
<?php unset($__componentOriginalea5418acac2e176b0e603a2bc7ce448e7a29a714); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp-school\htdocs\web-portal\resources\views/admin/section/details.blade.php ENDPATH**/ ?>