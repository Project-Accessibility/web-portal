<?php if(count($paths) > 0): ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" id="breadcrumbs">
            <?php $__currentLoopData = $paths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $path): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($loop->last): ?>
                    <li class="breadcrumb-item active"><?php echo e(ucfirst($path['display'])); ?></li>
                <?php else: ?>
                    <li class="breadcrumb-item"><a href="<?php echo e($path['url']); ?>"><?php echo e(ucfirst($path['display'])); ?></a></li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
    </nav>
<?php endif; ?>
<?php /**PATH D:\xampp-school\htdocs\web-portal\resources\views/components/breadcrumb.blade.php ENDPATH**/ ?>