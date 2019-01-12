<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('admin/home')?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="<?php echo site_url('admin/categories/all_categories')?>">Categories</a></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">CATEGORIES</h1>
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
					<div class="panel-heading">
						<div class="col-md-6">
						<form action="<?php echo site_url('admin/categories/add_category/');?>">						
						<button type="submit" class="btn btn-primary">Add New Category</button>
						</form></div>
						</div>
					<div class="panel-body">
						<table class="table fixed-table-container">
						    <thead>
						    <tr>
						        <th>ID</th>
						        <th>Name</th>
						        <th>Action</th>
						    </tr>
						    </thead>

							<?php 
		                if(is_array($rows) && count($rows) ) {  
		                  foreach ($rows as $row):
		                      ?> 
		                      <thead> 
						    <tr>
						    	<td><?= $row->category_id?></td>
						    	<td><?= $row->name?></td>
						    	<td class="col-sm-3 col-lg-1 sidebar"><a style="" href="<?php echo site_url('admin/categories/update_category/'.($row->category_id))?>"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg></a>
						    		<a href="<?php echo site_url('admin/categories/delete_category/'.($row->category_id))?>" onclick="return confirm('Anda yakin akan menghapus ini?')" ><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg></a>
						    	</td>
						    </tr> 
						    </thead>
						 <?php                         
                        endforeach;
                        }
                        else {
                          echo "<tr><td colspan=50></br>Tidak Ada Kategori.</br> </br></td></tr>";
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