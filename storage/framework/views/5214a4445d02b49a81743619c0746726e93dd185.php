<div class="table-responsive">
    <table class="table table-striped">
        <?php if (isset($component)) { $__componentOriginal93a64aff427b37447c6ae280100639d5b005438e = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Table\Header::class, ['headers' => $headers,'amountOfLinks' => $tableLinks->count()] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\Table\Header::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal93a64aff427b37447c6ae280100639d5b005438e)): ?>
<?php $component = $__componentOriginal93a64aff427b37447c6ae280100639d5b005438e; ?>
<?php unset($__componentOriginal93a64aff427b37447c6ae280100639d5b005438e); ?>
<?php endif; ?>
        <?php if(count($items) > 0): ?>
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (isset($component)) { $__componentOriginal194b1498e07d41898937a1db3b7c1f688ce9186c = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Table\Row::class, ['item' => $item,'keys' => $keys,'rowLink' => $rowLink,'tableLinks' => $tableLinks,'ifKey' => $ifKey,'ifValue' => $ifValue] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table-row'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\Table\Row::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal194b1498e07d41898937a1db3b7c1f688ce9186c)): ?>
<?php $component = $__componentOriginal194b1498e07d41898937a1db3b7c1f688ce9186c; ?>
<?php unset($__componentOriginal194b1498e07d41898937a1db3b7c1f688ce9186c); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <tr>
                <td colspan="<?php echo e(count($keys) + ($tableLinks->count() > 0 ? 1 : 0)); ?>">
                    <div class="d-flex justify-content-center">
                        <span class="lead">
                            Er zijn nog geen items.
                        </span>
                    </div>
                </td>
            </tr>
        <?php endif; ?>
    </table>
</div>
<?php /**PATH D:\xampp-school\htdocs\web-portal\resources\views/components/table/table.blade.php ENDPATH**/ ?>