<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('admin/home')?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li >Users</li>
				<li><a href="<?php echo site_url('admin/users/all_user_umum')?>">User Umum</a></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">USERS</h1>
			</div>
		</div><!--/.row-->
				<?php if ($this->session->flashdata('success')): ?>
                                <div class="alert bg-success" role="alert">
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            <?php endif; ?>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">User Umum</div>
					<div class="panel-body">
						<table class="table fixed-table-container">
						    <thead>
						    <tr>
						        <th>ID</th>
						        <th>Name</th>
						        <th>Address</th>
						        <th>Phone</th>
						        <th>Email</th>
						        <th>Level</th>
						        <th>Action</th>
						    </tr>
						    </thead>

							<?php 
		                if(is_array($rows) && count($rows) ) {  
		                  foreach ($rows as $row):
		                      ?> 
		                      <thead> 
						    <tr>
						    	<td><?= $row->user_id?></td>
						    	<td><?= $row->name?></td>
						    	<td><?= $row->address?></td>
						    	<td><?= $row->phone?></td>
						    	<td><?= $row->email?></td>
						    	<td><?= $row->level?></td>
						    	<td class="col-sm-3 col-lg-1 sidebar"><a style="" href="<?php echo site_url('admin/users/update_user_umum/'.($row->user_id))?>"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg></a>
						    		<a href="<?php echo site_url('admin/users/delete_user_umum/'.($row->user_id))?>" onclick="return confirm('Anda yakin akan menghapus ini?')" ><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg></a>
						    	</td>
						    </tr> 
						    </thead>
						 <?php                         
                        endforeach;
                        }
                        else {
                          echo "<tr><td colspan=50></br>Tidak Ada User.</br> </br></td></tr>";
                        }
                        ?> 
						</table>
						<?php echo $this->pagination->create_links(); ?></br></br>	
					</div>
				</div>
			</div>
		</div><!--/.row-->	
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	

	<script type="text/javascript">
		var message = "Konfirmasi";
		var title = "Apakah anda yakin akan menghapus ini?";

		$(".delete").click(function(){
	  eModal.confirm(message, title);

	});
	</script>