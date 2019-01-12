<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('admin/home')?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="<?php echo site_url('admin/orders/all_orders')?>">Orders</a></li>
				<li><a href="<?php echo site_url('admin/orders/detail/'.$order['order_id'])?>">Detail Order</a></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
			</div>
		</div><!--/.row-->
				<?php if ($this->session->flashdata('success')): ?>
                                <div class="alert bg-success" role="alert">
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            <?php endif; ?>
		
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Detail Order</div>
						<div class="panel-body tabs">
							<table class="table table-bordered table-striped">
							        <tr >
							            <td >Kode</td><td><?php echo $order['code']; ?></td>
							        </tr>
							        <tr>
							            <td>Tanggal Pesan</td>
							            <td>
							                <?php 
							                          setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
							                          //$date = date_create($event['start_date']); 
							                          $d = strtotime($order['order_date']);
							                          $format = '%d %B %Y';
							                          echo strftime($format, $d);?>
							            </td>
							        </tr>
							        <tr>
							            <td>Total</td><td><strong>Rp. <?php echo number_format($order['total'],2,',','.'); ?></strong></td>
							        </tr>
							        <tr>
							            <td>Batas Pembayaran</td>
							            <td>
							                <?php 
							                          setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
							                          //$date = date_create($event['start_date']); 
							                          $d = strtotime($order['payment_deadline']);
							                          $format = '%d %B %Y';
							                          echo strftime($format, $d);?>
							            </td>
							        </tr>
							        <tr>
							            <td>Status</td>							 
							        	<?php if ($order['status'] == 'Menunggu Disetujui'): ?>
							            <td>
										<div class="form-group">
		                            			<form action="<?php echo site_url('admin/orders/update_status/'.$order['order_id']);?>" method="post">
		                            		<div class="col-md-6">
											<select class="form-control" name="status">
												<option value="Menunggu Disetujui"<?php if($order['status'] == 'Menunggu Disetujui') { ?> selected="selected"<?php } ?>
																		 <?php echo set_select('status','Menunggu Disetujui', ( !empty($data) && $data == "Menunggu Disetujui" ? TRUE : FALSE )); ?>>Menunggu Disetujui</option>
												<option value="Pemesanan Sukses"<?php if($order['status'] == 'Pemesanan Sukses') { ?> selected="selected"<?php } ?>
																		 <?php echo set_select('status','Pemesanan Sukses', ( !empty($data) && $data == "Pemesanan Sukses" ? TRUE : FALSE )); ?>>Pemesanan Sukses</option>
												<option value="Pemesanan Gagal"<?php if($order['status'] == 'Pemesanan Gagal') { ?> selected="selected"<?php } ?>
																		 <?php echo set_select('status','Pemesanan Gagal', ( !empty($data) && $data == "Pemesanan Gagal" ? TRUE : FALSE )); ?>>Pemesanan Gagal</option>
											</select></div>
										<div class="col-md-6">									
										<button type="submit" class="btn btn-primary">Ubah Status</button>
										</div>
										</form>
										</div></td>
										<?php else: ?>										
										<td><?php echo $order['status']; ?></td>  										
				                		<?php endif; ?> 
							        </tr>

			                        <tr>
			                            <td>Nama</td><td><?php echo $user['name']; ?></td>
			                        </tr>
			                        <tr>
			                            <td>Email</td><td><?php echo $user['email']; ?></td>
			                        </tr>
			                        <tr>
			                            <td>Alamat</td><td><?php echo $user['address']; ?></td>
			                        </tr>
							    </table>
							    <div class="panel-heading">Rincian Pemesanan</div>
							    <table class="table table-bordered table-striped">
							        <thead>
							            <tr>

							                <th>Nama Event</th>
							                <th>Jumlah Tiket</th>
							                <th>Harga</th>
							                <th>Total</th>

							            </tr>
							        </thead>
							        <?php 
								        $events=$this->event_model->get_paged_list1()->result();
		                                $data['events']=$events;
		                                foreach($events as $event) {
		                                $result[$event->event_id] = $event->title ;} ?>

							        <?php $i = 1; ?>

							        <?php foreach ($orderDetails as $orderDetail): ?>



							            <tr>

							                <td><?= $orderDetail->event_id=$result[$orderDetail->event_id];?></td>
							                <td><?php echo $orderDetail->quantity ?></td>
							                <td><?php echo number_format($orderDetail->price,2,',','.'); ?></td>
							                <td style="text-align:right"><?php echo number_format($orderDetail->price * $orderDetail->quantity,2,',','.'); ?></td>

							            </tr>

							            <?php $i++; ?>

							        <?php endforeach; ?>

							        <tr>
							            <td colspan="3" style="text-align:right"><h4>TOTAL :</h4></td>
							            <td style="text-align:right"><h4><strong>Rp. <?php echo number_format($order['total'],2,',','.'); ?></strong></h4> </td>               
							        </tr>                  

							    </table>


							    <?php if ($order['status'] == 'Menunggu Disetujui' || $order['status'] == 'Pemesanan Sukses' ): ?>
							    <div class="panel-heading">Data Konfirmasi</div>
							    <?php if ($this->session->flashdata('error')): ?>
                                <div class="error">
                                    <?php echo $this->session->flashdata('error'); ?>
                                </div>&nbsp;
                            <?php endif; ?>
                            <table class="table table-bordered table-striped">    
							            <tr>
								            <td>Bukti Transfer</td>
								            <td><img id="myImg" src="data:image/jpeg;base64,<?php echo base64_encode($confirmation['image']); ?>" style="float:center; min-width:500px; min-height: 400px; max-width:500px; max-height: 400px"  alt="" /></td>
							            </tr>
							            <tr>
							            <td>Nama Bank Pengirim</td>
								            <td><?php echo $confirmation['sender_bank']; ?></td>
							            </tr>
							            <tr>
							            	<td>Nama Pengirim</td>
							            	<td><?php echo $confirmation['name']; ?></td>
							            </tr>
							            <tr>
							            	<td>Tanggal Transfer</td>
							            	<td><?php echo $confirmation['payment_date']; ?></td>
							            </tr>
							            <tr>							
							                <td>Deskripsi</td>
							                <td><?php echo $confirmation['description']; ?></td>
							            </tr>
							</table>
                            <div class="col-md-12" style="margin-bottom: 12px;">
                            <center>
                            <form action="<?php echo site_url('admin/orders/approve/'.$order['order_id']);?>"> 					
							<button type="submit" class="btn btn-primary">Kirim Email</button>
							</form>
							</center>
							</div>
                             <?php echo form_close(); ?> 
                            </form>
                            	<?php else: ?>
                            		<div class="panel-heading">Data Konfirmasi</div>
                            		<table class="table table-bordered table-striped">    
							            <tr>
								            <td>Bukti Transfer</td>
								            <td><img id="myImg" src="data:image/jpeg;base64,<?php echo base64_encode($confirmation['image']); ?>" style="float:center; min-width:500px; min-height: 400px; max-width:500px; max-height: 400px"  alt="" /></td>
							            </tr>
							            <tr>
							            <td>Nama Bank Pengirim</td>
								            <td><?php echo $confirmation['sender_bank']; ?></td>
							            </tr>
							            <tr>
							            	<td>Nama Pengirim</td>
							            	<td><?php echo $confirmation['name']; ?></td>
							            </tr>
							            <tr>
							            	<td>Tanggal Transfer</td>
							            	<td><?php echo $confirmation['payment_date']; ?></td>
							            </tr>
							            <tr>							
							                <td>Deskripsi</td>
							                <td><?php echo $confirmation['description']; ?></td>
							            </tr>
							</table>
				                <?php endif; ?>     


                           
					</div>
				</div>
			</div><!--/.panel-->
		</div><!-- /.col-->
</div><!--/.row-->	