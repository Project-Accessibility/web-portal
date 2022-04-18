<thead>
    <tr>
        <?php $__currentLoopData = $headers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <th scope="col"><?php echo e($header); ?></th>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if($amountOfLinks > 0): ?>
            <th>
                <?php if($amountOfLinks == 1): ?> Actie
                <?php else: ?> Acties <?php endif; ?>
            </th>
        <?php endif; ?>
    </tr>
</thead>
<?php /**PATH D:\xampp-school\htdocs\web-portal\resources\views/components/table/header.blade.php ENDPATH**/ ?>