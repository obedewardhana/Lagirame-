<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('admin/home')?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="<?php echo site_url('admin/orders/all_orders')?>">Orders</a></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">ORDERS</h1>
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
					<div class="panel-heading">Data Pesanan</div>
					<div class="panel-body">
						<table class="table fixed-table-container">
						    <thead>
						    <tr>
						        <th>Code</th>
						        <th>Date</th>
						        <th>Total</th>
						        <th>Due Date</th>
						        <th>Status</th>
						        <th>Customer</th>
						        <th>Action</th>
						    </tr>
						    </thead>
						    <?php 
						        $users=$this->user_model->get_paged_list()->result();
                                $data['users']=$users;
                                foreach($users as $user) {
                                $result[$user->user_id] = $user->name ;} ?>
							<?php 
		                if(is_array($rows) && count($rows) ) {  
		                  foreach ($rows as $row):
		                      ?> 
		                      <thead> 
						    <tr>
						    	<td><?= $row->code?></td>
						    	<td><?= $row->order_date?></td>
						    	<td><?= $row->total?></td>
						    	<td><?= $row->payment_deadline?></td>
						    	<td><?= $row->status?></td>
						    	<td><?=$row->user_id=$result[$row->user_id];?></td>
						    	<td class="col-sm-3 col-lg-1 sidebar"><a style="" href="<?php echo site_url('admin/orders/detail/'.($row->order_id))?>"><svg class="glyph stroked eye"><use xlink:href="#stroked-eye"/></svg>Detail</a>
						    	</td>
						    </tr> 
						    </thead>
						 <?php                         
                        endforeach;
                        }
                        else {
                          echo "<tr><td colspan=50></br>Tidak Ada Order.</br> </br></td></tr>";
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