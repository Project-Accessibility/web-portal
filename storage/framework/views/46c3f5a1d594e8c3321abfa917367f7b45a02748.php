<tr <?php if($rowLink): ?> class="clickable-row" data-href="<?php echo e($rowLink); ?>" <?php endif; ?>>
    <?php $__currentLoopData = $rowItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rowItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <td class="align-middle">
            <span class="table-row-text" style="--truncateLines: <?php echo e(count($tableLinks) + 1); ?>;"><?php echo e($rowItem); ?></span>
        </td>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php if(count($tableLinks) > 0 && $tableLinkActive): ?>
        <td class="align-middle smallCell">
            <div class="d-flex flex-md-nowrap flex-wrap gap-2">
                <?php $__currentLoopData = $tableLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $display => $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Button::class, ['type' => 'primary','link' => $link] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e(ucfirst($display)); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </td>
    <?php endif; ?>
</tr>
<?php /**PATH D:\xampp-school\htdocs\web-portal\resources\views/components/table/row.blade.php ENDPATH**/ ?>