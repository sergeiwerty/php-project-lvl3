<?php $__env->startSection('content'); ?>
    <h1 class="mt-5 mb-3">Сайты</h1>
    <table class="table border">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Имя</th>
            <th scope="col">Последняя проверка</th>
            <th scope="col">Код ответа</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $urls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row"><?php echo e($url->id); ?></th>
                <td><a href="<?php echo e(route('urls.show', [$url->id])); ?>"><?php echo e($url->name); ?></a></td>
                <td><?php echo e(is_null($url->check) ? '' : $url->check->created_at); ?></td>
                <td><?php echo e(is_null($url->check) ? '' : $url->check->status_code); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/development/php-project-lvl3/php-project-lvl3/resources/views/url/index.blade.php ENDPATH**/ ?>