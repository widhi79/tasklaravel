<?php $__env->startSection('content'); ?>
    <?php if(auth()->guard()->check()): ?>
        <div class="row text-center">
            <div class="col-lg-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <a href="<?php echo e(route('category')); ?>">
                                <div class="col-xs-2">
                                    <i class="fa-solid fa-layer-group fa-3x"></i>
                                </div>
                                <div class="col-xs-10 text-right">
                                    <h2>Category</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <a href="<?php echo e(route('tasks')); ?>">
                                <div class="col-xs-2">
                                    <i class="fa-solid fa-list-check fa-3x"></i>
                                </div>
                                <div class="col-xs-10 text-right">
                                    <h2>Tasks</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <a href="<?php echo e(route('users')); ?>">
                                <div class="col-xs-2">
                                    <i class="fa-solid fa-users fa-3x"></i>
                                </div>
                                <div class="col-xs-10 text-right">
                                    <h2>Users</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template\tmpl', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\project\laravel\task-manager\resources\views/home.blade.php ENDPATH**/ ?>