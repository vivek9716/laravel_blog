<?php $__env->startSection('headSection'); ?>
<link rel="stylesheet" href="<?php echo e(asset('admin/css/role.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Role
            <small>Edit <?php echo e($role->name); ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo e(route('role.index')); ?>">List</a></li>
            <li class="active">Roles</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Role</h3>
                    </div>

                    <?php echo $__env->make('includes.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?php echo e(route('role.update',$role->id)); ?>" method="post">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('PATCH')); ?>

                        <div class="box-body">
                            <div class="col-lg-offset-3 col-lg-6">
                                <div class="form-group">
                                    <label for="name">Role title</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="role Title" value="<?php echo e($role->name); ?>">
                                </div>

                                <div class="row">



                                    <div class="col-lg-6">
                                        <label for="name">Modules</label>

                                        <div id="vertical-menu">
                                            <ul>
                                                <li><h3><input type="checkbox" class="all_checkbox" value="1"> All</h3></li>
                                            </ul>
                                            <ul>


                                                <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <li class="mainLi">
                                                    <h3><span class="plus">+</span><input type="checkbox" class="parent_checkbox_<?php echo e($page->id); ?> parent_checkbox" data-id="<?php echo e($page->id); ?>" <?php if(in_array($page->id, $checked['rolePage'])): ?> <?php echo e('checked'); ?> <?php endif; ?> name="pages[]" value="<?php echo e($page->id); ?>"><?php echo e($page->label); ?></h3>
                                                    <ul>
                                                        <?php $__currentLoopData = $page->methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><input type="checkbox" class="child_checkbox_<?php echo e($page->id); ?> child_checkbox" data-parent-id="<?php echo e($page->id); ?>" <?php if(in_array($method->id, $checked['roleMethods'])): ?> <?php echo e('checked'); ?> <?php endif; ?> name="methods[]" value="<?php echo e($method->id); ?>"> <?php echo e($method->label); ?></li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </li>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                            </ul>
                                        </div> 

                                    </div>
                                </div>



                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href='<?php echo e(route('role.index')); ?>' class="btn btn-warning">Back</a>
                                </div>

                            </div>

                        </div>

                    </form>
                </div>
                <!-- /.box -->


            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footerSection'); ?>
    <script src="<?php echo e(asset('admin/js/role.js')); ?>"></script>    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>