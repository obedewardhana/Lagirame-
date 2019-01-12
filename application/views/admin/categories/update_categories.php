<style type="text/css">
	.errorval{
    color:#D04C4C;
    max-width: 400px;
    margin: 0;
    text-align: right; 
  }
</style>

<div class="row">
			
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('admin/home')?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="<?php echo site_url('admin/categories/all_categories')?>">Categories</a></li>
				<li><a href="<?php echo site_url('admin/categories/update_category/'.$categories->category_id)?>">Edit <?=$categories->name?></a></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Edit Category</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><?=$categories->name?></div>
					<div class="panel-body">
						<div class="col-md-6">
							<?php echo form_open_multipart('admin/categories/update_category/'.$categories->category_id); ?>
                            <form action="<?php echo site_url('admin/categories/update_category/'.$categories->category_id);?>" method="post">
							
								<div class="form-group">
									<label>Name</label>
									<input class="form-control" name="name" value="<?php echo set_value('name', isset($categories->name) ? $categories->name : ''); ?>" placeholder="Nama Lengkap">
								</div>
								<div class="errorval"><?php echo form_error('name'); ?></div>
								
							</div>		
								<div class="col-md-6">
								</br>
								<button type="submit" class="btn btn-primary">Update</button>
								</div>			
							<?php form_close(); ?>  
						</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->