<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('admin/home')?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>				
				<li><a href="<?php echo site_url('admin/users/all_events')?>">Events</a></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">EVENTS</h1>
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
					<div class="panel-heading">Event Terdaftar.</div>
					<div class="panel-body">
						<table class="table fixed-table-container">
						    <thead>
						    <tr>
						        <th>Image</th>
						        <th>Title</th>
						        <th>Date</th>
						        <th>City</th>
						        <th>Type</th>
						        <th>Price</th>
						        <th>Capacity</th>
						        <th>Status</th>
						        <th>Category</th>
						        <th>Action</th>
						    </tr>
						    </thead>
						    <?php 
						        $categories=$this->category_model->get_paged_list()->result();
                                $data['categories']=$categories;
                                foreach($categories as $category) {
                                $result[$category->category_id] = $category->name ;} ?>

							<?php 

		                if(is_array($rows) && count($rows) ) {  
		                  foreach ($rows as $row):
		                      ?> 
		                      <thead> 
						    <tr>
						    	<td><img alt="image" style="width:60px; height:60px" src="data:image/jpeg;base64,<?php echo base64_encode($row->image); ?>" ></td>
						    	<td><?= $row->title?></td>
						    	<td><?= $row->start_date?> - <?= $row->end_date?></td>
						    	<td><?= $row->city?></td>
						    	<td><?= $row->type?></td>
						    	<td><?= $row->price?></td>
						    	<td><?= $row->capacity?></td>
						    	<td><?= $row->status?></td>
						    	<td><?=$row->category_id=$result[$row->category_id];?></td>
						    	<td class="col-sm-2 col-lg-1 sidebar">
						    	<a href="<?php echo site_url('admin/events/detail_event/'.($row->event_id))?>"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg></a>
						    	<a href="<?php echo site_url('admin/events/delete_event/'.($row->event_id))?>" onclick="return confirm('Anda yakin akan menghapus ini?')" ><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg></a> 
						    	</td>
						    </tr> 
						    </thead>
						 <?php                         
                        endforeach;
                        }
                        else {
                          echo "<tr><td colspan=50></br>Tidak Ada Event.</br> </br></td></tr>";
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