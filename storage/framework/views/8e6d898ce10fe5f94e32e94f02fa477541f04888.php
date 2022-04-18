<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <?php echo $__env->make('includes.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<div id="app">
    <?php if (isset($component)) { $__componentOriginal565ac802a352a92b1930760028d7b31c15a31dd0 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\NavBar::class, [] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('nav-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\NavBar::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal565ac802a352a92b1930760028d7b31c15a31dd0)): ?>
<?php $component = $__componentOriginal565ac802a352a92b1930760028d7b31c15a31dd0; ?>
<?php unset($__componentOriginal565ac802a352a92b1930760028d7b31c15a31dd0); ?>
<?php endif; ?>

    <main class="container rounded mb-4 mt-4">
        <?php if(session()->has('success') || !empty($success)): ?>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session()->get('success') ?? $success); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <?php if (isset($component)) { $__componentOriginal40fe594eae3d7d27fa8bd9a508c1498f43cae280 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Breadcrumb::class, [] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\Breadcrumb::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal40fe594eae3d7d27fa8bd9a508c1498f43cae280)): ?>
<?php $component = $__componentOriginal40fe594eae3d7d27fa8bd9a508c1498f43cae280; ?>
<?php unset($__componentOriginal40fe594eae3d7d27fa8bd9a508c1498f43cae280); ?>
<?php endif; ?>
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
<?php /**PATH D:\xampp-school\htdocs\web-portal\resources\views/layouts/app.blade.php ENDPATH**/ ?>