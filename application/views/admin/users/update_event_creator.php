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
				<li >Users</li>
				<li><a href="<?php echo site_url('admin/users/all_event_creators')?>">Event Creator</a></li>
				<li><a href="<?php echo site_url('admin/users/update_event_creator/'.$users->user_id)?>">Edit <?=$users->name?></a></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Edit Event Creator</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><?=$users->name?></div>
					<div class="panel-body">
						<div class="col-md-6">
							<?php echo form_open_multipart('admin/users/update_event_creator/'.$users->user_id); ?>
                            <form action="<?php echo site_url('admin/users/update_user_umum/'.$users->user_id);?>" method="post">
							
								<div class="form-group">
									<label>Nama Lengkap</label>
									<input class="form-control" name="name" value="<?php echo set_value('name', isset($users->name) ? $users->name : ''); ?>" placeholder="Nama Lengkap">
								</div>
								<div class="errorval"><?php echo form_error('name'); ?></div>
																
								<div class="form-group">
									<label>Email</label>
									<input class="form-control" name="email" value="<?php echo set_value('email', isset($users->email) ? $users->email : ''); ?>" placeholder="Email">
								</div>
								<div class="errorval"><?php echo form_error('email'); ?></div>

								<div class="form-group">
									<label>No HP / Telepon</label>
									<input class="form-control" name="phone" value="<?php echo set_value('phone', isset($users->phone) ? $users->phone : ''); ?>" placeholder="No HP / Telepon">
								</div>
								<div class="errorval"><?php echo form_error('phone'); ?></div>

								<div class="form-group">
									<label>Alamat</label>
									<textarea type="text" class="form-control" rows="2" name="address"><?php echo set_value('address', isset($users->address) ? $users->address :''); ?></textarea>
								</div>
								<div class="errorval"><?php echo form_error('address'); ?></div>

								<div class="form-group">
									<label>Level</label>
									<select class="form-control" name="level">
										<option value="user_umum"<?php if($users->level == 'user_umum') { ?> selected="selected"<?php } ?>
																 <?php echo set_select('level','user_umum', ( !empty($data) && $data == "user_umum" ? TRUE : FALSE )); ?>>User Umum</option>
										<option value="event_creator"<?php if($users->level == 'event_creator') { ?> selected="selected"<?php } ?>
																 <?php echo set_select('level','event_creator', ( !empty($data) && $data == "event_creator" ? TRUE : FALSE )); ?>>Event Creator</option>
									</select>
								</div>
								
							</div>				
								<div class="col-md-6">
								<button type="submit" class="btn btn-primary">Update</button>
								</div>			
							<?php form_close(); ?>  
						</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->