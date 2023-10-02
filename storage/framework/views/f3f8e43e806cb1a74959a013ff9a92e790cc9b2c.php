<!-- resources/views/auth/login.blade.php -->



<?php $__env->startSection('content'); ?>
    <form method="POST" action="<?php echo e(route('login')); ?>">
        <?php echo csrf_field(); ?>

        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required autofocus>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div>
            <input type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
            <label for="remember">Remember Me</label>
        </div>

        <div>
            <button type="submit">Login</button>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template\tmpl', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\project\laravel\task-manager\resources\views/auth/login.blade.php ENDPATH**/ ?>