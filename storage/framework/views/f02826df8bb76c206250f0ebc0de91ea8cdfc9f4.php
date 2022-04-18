<nav>
    <ul class="nav nav-tabs" id="<?php echo e($title); ?>">
        <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="nav-item" role="presentation">
                <span
                    class="nav-link <?php echo e($tab == $currentTab? 'active' : null); ?>"
                    id="link-<?php echo e($tab); ?>"
                    data-bs-toggle="tab"
                    data-bs-target="#<?php echo e($tab); ?>"
                    role="tab"
                    aria-controls="<?php echo e($tab); ?>"
                    aria-selected="<?php echo e($tab === $currentTab); ?>">
                    <?php echo e(ucfirst($tab)); ?>

                </span>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</nav>
<div class="tab-content" id="<?php echo e($title); ?>content">
    <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div
            class="tab-pane fade show <?php echo e($tab === $currentTab ? 'show active' : null); ?>"
            id="<?php echo e($tab); ?>"
            aria-labelledby="<?php echo e($tab); ?>-tab">
            <?php echo $__env->yieldContent($tab); ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH D:\xampp-school\htdocs\web-portal\resources\views/components/tabs.blade.php ENDPATH**/ ?>