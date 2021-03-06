<?php $__env->startSection('headSection'); ?>
<link rel="stylesheet" href="<?php echo e(asset('admin/plugins/datatables/dataTables.bootstrap.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Roles List
            <!--small>it all starts here</small-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('admin.home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>            
            <li class="active">Roles</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        
        <div class="box box-danger <?php if(empty($cname)): ?> <?php echo e("collapsed-box"); ?> <?php endif; ?>">
            <div class="box-header with-border">
                <h3 class="box-title">Search in Role List's</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                        <?php if(empty($cname)): ?> 
                        <i class="fa fa-plus"></i>
                        <?php else: ?>
                        <i class="fa fa-minus"></i>
                        <?php endif; ?>

                    </button>                    
                </div>
            </div>
            <div class="box-body" style="<?php if(empty($cname)): ?> <?php echo e("display: none"); ?> <?php endif; ?>">
                <div class="row">
                    <form role="form" action="<?php echo e(route('role.index')); ?>" method="get">
                        <div class="col-xs-3">
                            <input type="text" class="form-control" name="cname" placeholder="Role Name" value="<?php echo e($cname); ?>">
                        </div>                        
                        <div class="col-xs-3">
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a class='btn btn-warning' href="<?php echo e(route('role.index')); ?>">Reset</a>
                        </div>                        
                    </form>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        
        <div class="box box-warning">                    
            <!-- /.box-header -->
            <div class="box-body">
                <div class="box-tools pull-left" style="padding: 10px;">
                    <a class='col-lg-offset-0 btn btn-success' href="<?php echo e(route('role.create')); ?>">Add New</a>
                </div>
                <div class="box-tools pull-right" style="margin-top: -16px;">
                    <?php echo e($roles->links()); ?>

                </div>
                <table id="" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Role Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e((($roles->currentPage() - 1) * $roles->perPage()) + $loop->iteration); ?></td>
                            <td><?php echo e($role->name); ?></td>
                            <td><a href="<?php echo e(route('role.edit',$role->id)); ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
                            <td>
                                <form id="delete-form-<?php echo e($role->id); ?>" method="post" action="<?php echo e(route('role.destroy',$role->id)); ?>" style="display: none">
                                    <?php echo e(csrf_field()); ?>

                                    <?php echo e(method_field('DELETE')); ?>

                                </form>
                                <a href="" onclick="
                                            if (confirm('Are you sure, You Want to delete this?'))
                                    {
                                    event.preventDefault();
                                    document.getElementById('delete-form-<?php echo e($role->id); ?>').submit();
                                        }
                                        else{
                                        event.preventDefault();
                                        }" ><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>S.No</th>
                            <th>Role Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="box-tools pull-right" style="margin-top: -16px;">
                    <?php echo e($roles->links()); ?>

                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footerSection'); ?>
<script src="<?php echo e(asset('admin/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/plugins/datatables/dataTables.bootstrap.min.js')); ?>"></script>
<script>
                                        $(function () {
                                        $("#example1").DataTable();
                                        });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>