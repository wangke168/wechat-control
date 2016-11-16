<?php $__env->startSection('title', 'Page Title'); ?>

<?php $__env->startSection('page-title', '每日阅读数'); ?>


<?php $__env->startSection('content'); ?>
   @parent 
  
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('control.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>