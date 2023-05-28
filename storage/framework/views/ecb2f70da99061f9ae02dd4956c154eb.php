<?php $__env->startComponent('mail::message'); ?>
    Dear <?php echo e($email); ?>,

    Current BTC rate for this moment is:  <i> <?php echo e($rate); ?> </i>

    with best regards,<br>
    <?php echo e(config('app.name')); ?> Team
<?php echo $__env->renderComponent(); ?>
<?php /**PATH D:\Учёба\PHP\caseKMAnGN\resources\views/emails/rate.blade.php ENDPATH**/ ?>