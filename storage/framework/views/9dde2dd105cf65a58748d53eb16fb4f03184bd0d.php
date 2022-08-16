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
    <h1>Проверки</h1>
    <form action="/urls/<?php echo e($urlData->id); ?>/checks" method="POST">
        <?php echo csrf_field(); ?>
        <input class="btn btn-primary" type="submit" value="Запустить проверку">
    </form>
    <?php if(isset($checks)): ?>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Код ответа</th>
                <th scope="col">h1</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Дата создания</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $checks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $check): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($check->id); ?></th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php echo e($check->created_at); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/url/show.blade.php ENDPATH**/ ?>