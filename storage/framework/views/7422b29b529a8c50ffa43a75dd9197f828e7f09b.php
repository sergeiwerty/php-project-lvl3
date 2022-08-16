<?php $__env->startSection('content'); ?>
    <table class="table border">
        <tbody>
        <tr>
            <th scope="row">ID</th>
            <td><?php echo e($urlData->id); ?></td>
        </tr>
        <tr>
            <th scope="row">Имя</th>
            <td><?php echo e($urlData->name); ?></td>
        <tr>
            <th scope="row">Дата создания</th>
            <td><?php echo e($urlData->created_at); ?></td>
        </tr>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/development/php-project-lvl3/php-project-lvl3/resources/views/url/show.blade.php ENDPATH**/ ?>