<?php if($link != null): ?>
    <a href="<?php echo e($link); ?>"
    <?php switch($type):
        case ('primary'): ?>
            <?php echo e($attributes->merge(['class' => 'btn btn-primary'])); ?>

        <?php break; ?>
        <?php case ('secondary'): ?>
            <?php echo e($attributes->merge(['class' => 'btn btn-secondary'])); ?>

        <?php break; ?>
        <?php case ('remove'): ?>
            <?php echo e($attributes->merge(['class' => 'btn btn-danger'])); ?>

        <?php break; ?>
        <?php default: ?>
            <?php echo e($attributes->merge(['class' => 'btn btn-primary'])); ?>

        <?php break; ?>
        <?php endswitch; ?>
    >
        <?php echo e($slot); ?>

    </a>
<?php else: ?>
    <button type="submit"
    <?php switch($type):
        case ("primary"): ?>
            <?php echo e($attributes->merge(['class' => 'btn btn-primary'])); ?>

            <?php break; ?>
            <?php case ("secondary"): ?>
            <?php echo e($attributes->merge(['class' => 'btn btn-secondary'])); ?>

            <?php break; ?>
            <?php case ("remove"): ?>
            <?php echo e($attributes->merge(['class' => 'btn btn-danger'])); ?>

            <?php break; ?>
            <?php default: ?>
            <?php echo e($attributes->merge(['class' => 'btn btn-primary'])); ?>

            <?php break; ?>
        <?php endswitch; ?>
    >
        <span class="text-nowrap"><?php echo e($slot); ?></span>
    </button>
<?php endif; ?>
<?php /**PATH D:\xampp-school\htdocs\web-portal\resources\views/components/button.blade.php ENDPATH**/ ?>