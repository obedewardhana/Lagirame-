<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('admin/home')?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="<?php echo site_url('admin/events/all_events')?>">Events</a></li>
				<li><a href="<?php echo site_url('admin/events/detail_event/'.$events->event_id)?>">Event Detail</a></li>
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
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading"><?=$events->title?></div>
					<div class="panel-body tabs">
					
						<ul class="nav nav-pills">
							<li ><a href="#pilltab1" data-toggle="tab">Gambar</a></li>
							<li><a href="#pilltab2" data-toggle="tab">Lokasi & Waktu</a></li>
							<li><a href="#pilltab3" data-toggle="tab">Deskripsi</a></li>
							<li><a href="#pilltab4" data-toggle="tab">Tipe & Harga</a></li>
							<li class="active"><a href="#pilltab5" data-toggle="tab">Status</a></li>
							<li><a href="#pilltab6" data-toggle="tab">Kategori</a></li>
							<li><a href="#pilltab7" data-toggle="tab">Event Creator</a></li>
						</ul>
		
						<div class="tab-content">
							<div class="tab-pane fade " id="pilltab1">
							<img alt="image" style="width:100%; max-width:350px; min-height:300px;  box-shadow: 0 10px 6px -6px #777;" src="data:image/jpeg;base64,<?php echo base64_encode($events->image); ?>" >
							</div>
							<div class="tab-pane fade" id="pilltab2">
								<h4>Lokasi & Waktu</h4>
								<?php if($events->start_date != $events->end_date) {?>
                			<p class="time2">
                          <?php 
                          setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
                          //$date = date_create($event['start_date']); 
                          $d = strtotime($events->start_date);
                          $format = '%d';
                          echo strftime($format, $d);?> - <?php 
                          setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
                          //$date = date_create($event['start_date']); 
                          $e = strtotime($events->end_date);
                          $format = '%d %B %Y';
                          echo strftime($format, $e);?></p><?php }else {?>
                			<p class="time2"><label class="calendar">&nbsp;</label>
                          <?php 
                          setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
                          //$date = date_create($event['start_date']); 
                          $d = strtotime($events->start_date);
                          $format = '%d %B %Y';
                          echo strftime($format, $d);?></p>
                			
                          <?php } ?> 
                          <p style="font-size:1em;">Kota : <?php echo $events->city;?></br>
                                          Lokasi : <?php echo $events->location;?></br>
							</div>

							<div class="tab-pane fade" id="pilltab3">
								<h4>Deskripsi</h4>
								<p><?php echo $events->description;?> </p>
							</div>
							<div class="tab-pane fade" id="pilltab4">							
								<div class="form-group">
								<form action="<?php echo site_url('admin/events/update_capacity/'.$events->event_id);?>" method="post">
								<div class="form-group" style="max-width: 100px;">
									<label>Kapasitas</label>
									<input class="form-control" name="capacity" value="<?php echo set_value('capacity', isset($events->capacity) ? $events->capacity : ''); ?>" placeholder="Kapasitas">
								</div>
								<div class="errorval"><?php echo form_error('capacity'); ?></div>
								<button type="submit" class="btn btn-primary">Update</button>
								</form>
								</div>
								<h4>Tipe & Harga</h4>
								<p>Tipe : <?php echo $events->type;?> </p>
								<p>Harga : <?php echo $events->price;?> </p>
							</div>
							<div class="tab-pane fade in active" id="pilltab5">
								<h4>Status</h4>
								<div class="col-md-6">
								<div class="form-group">
										<?php echo form_open_multipart('admin/events/update_status/'.$events->event_id); ?>
                            			<form action="<?php echo site_url('admin/events/update_status/'.$events->event_id);?>" method="post">
									<select class="form-control" name="status">
										<option value="Menunggu Validasi"<?php if($events->status == 'Menunggu Validasi') { ?> selected="selected"<?php } ?>
																 <?php echo set_select('status','Menunggu Validasi', ( !empty($data) && $data == "Menunggu Validasi" ? TRUE : FALSE )); ?>>Menunggu Validasi</option>
										<option value="Terpublikasi"<?php if($events->status == 'Terpublikasi') { ?> selected="selected"<?php } ?>
																 <?php echo set_select('status','Terpublikasi', ( !empty($data) && $data == "Terpublikasi" ? TRUE : FALSE )); ?>>Terpublikasi</option>
										<option value="Tidak Aktif"<?php if($events->status == 'Tidak Aktif') { ?> selected="selected"<?php } ?>
																 <?php echo set_select('status','Tidak Aktif', ( !empty($data) && $data == "Tidak Aktif" ? TRUE : FALSE )); ?>>Tidak Aktif</option>
									</select>
								</div>
								</div>
								<div class="col-md-6">
								<button type="submit" class="btn btn-primary">Ubah Status</button>
								</div>
								<?php form_close(); ?>  
									</form>
							</div>
							<div class="tab-pane fade" id="pilltab6">
								<h4>Kategori</h4>
								<p>
								<?php $categories=$this->category_model->get_paged_list()->result();
                                $data['categories']=$categories;
                                foreach($categories as $category) {
                                $result[$category->category_id] = $category->name ;} 
                                echo $events->category_id=$result[$events->category_id];?> </p>

							</div>
							<div class="tab-pane fade" id="pilltab7">
								<h4>Event Creator</h4>
								<p> Nama :
								<?php $users=$this->user_model->get_paged_list()->result();
                                $data['users']=$users;
                                foreach($users as $user) {
                                $result[$user->user_id] = $user->name ;} 
                                echo $events->user_id=$result[$events->user_id];?> 
                                </p>

							</div>
						</div>
					</div>
				</div><!--/.panel-->
			</div><!-- /.col-->
		</div><!--/.row-->	