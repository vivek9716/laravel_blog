<?php $__env->startSection('main-content'); ?>
	<!-- Content Wrapper. Contains method content -->
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->
	  <section class="content-header">
	    <h1>
	      Actions
	      <small>Edit <?php echo e($method->name); ?></small>
	    </h1>
	    <ol class="breadcrumb">
	      <li><a href="<?php echo e(route('admin.home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
	      <li><a href="<?php echo e(route('method.index')); ?>">List</a></li>
	      <li class="active">Edit Action</li>
	    </ol>
	  </section>

	  <!-- Main content -->
	  <section class="content">
	    <div class="row">
	      <div class="col-md-12">
	        <!-- general form elements -->
	        <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title">Edit Action</h3>
	          </div>

	          <?php echo $__env->make('includes.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" action="<?php echo e(route('method.update',$method->id)); ?>" method="post">
	          <?php echo e(csrf_field()); ?>

	          <?php echo e(method_field('PUT')); ?>

	            <div class="box-body">
	            <div class="col-lg-offset-3 col-lg-6">
                        <div class="form-group">
                            <label for="controller">Controller</label>
                            <select class="form-control" id="controller" name="controller">
                                <option value="0">Select Controller</option>
                                <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if($method->page->id == $page->id): ?> <?php echo e('selected'); ?> <?php endif; ?> value="<?php echo e($page->id); ?>" ><?php echo e($page->label); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
	              <div class="form-group">
	                <label for="name">Name</label>
	                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo e($method->name); ?>">
	              </div>

	              <div class="form-group">
	                <label for="slug">Label</label>
	                <input type="text" class="form-control" id="slug" name="label" placeholder="Label" value="<?php echo e($method->label); ?>"> 
	              </div>

	            <div class="form-group">
	              <button type="submit" class="btn btn-primary">Submit</button>
	              <a href='<?php echo e(route('method.index')); ?>' class="btn btn-warning">Back</a>
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
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>