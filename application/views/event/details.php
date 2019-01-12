<?php 
                  function custom_echo($x, $length)
                    {
                      if(strlen($x)<=$length)
                      {
                        echo $x;
                      }
                      else
                      {
                        $y=substr($x,0,$length) . '...';
                        echo $y;
                      }
                    }
                    
                      ?>
  <style type="text/css">
 a.button-1 {
    text-decoration: none;
    color: #fff;
  }


 .button-1{
  max-width: 300px;
text-align:center;
text-decoration: none;
font-family: sans-serif;
-webkit-font-smoothing: antialiased;
color: #FFF;
background: #0CADA7;
display: inline-block;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
-webkit-transition: all 0.2s ease-in-out;
-ms-transition: all 0.2s ease-in-out;
-moz-transition: all 0.2s ease-in-out;
-o-transition: all 0.2s ease-in-out;
transition: all 0.2s ease-in-out;
}
.button-1:hover {
background: #1e9490;
}

  </style>

</br>
      <div class="wrapper style2">
        <article class="container" id="top" style="margin-top:">
          <div class="row">
            <div class="4u 12u(mobile)">
              <span style=""><img alt="image" style="width:100%; max-width:350px; min-height:300px;  box-shadow: 0 10px 6px -6px #777;" src="data:image/jpeg;base64,<?php echo base64_encode($events->image); ?>" >  </span>
            </div>

            <div class="8u 12u(mobile)" style="text-align: left;">
              <a href="<?php echo site_url('event/categories/'.($events->category_id)) ?>" style="font-size:1.2em; text-align: left;" >
                          <?php $categories=$this->category_model->get_paged_list()->result();
                                $data['categories']=$categories;
                                foreach($categories as $category) {
                                $result[$category->category_id] = $category->name ;} 
                                echo $events->category_id=$result[$events->category_id];?>
                                  
                                </a>&nbsp;<?php echo $events->type;?>
                <h1 class="feature"><?php echo $events->title;?></h1>
                <?php if($events->start_date != $events->end_date) {?>
                <p class="time2"><label class="calendar">&nbsp;</label>
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
                                          <?php if($events->type == 'Paid') {?>
                                          Harga Per Tiket : Rp.&nbsp;<?php echo $events->price; ?>,-</br>
                                          Kapasitas Tersisa : <?php echo $events->capacity; }else {?>
                                          <?php } ?> </p>

              <p style="font-size:1.1em; text-align: left"><?php echo $events->description;?></p>
              
            </div>
      
          
          </div>
        </article>
      </div><?php 
      $is_logged_in=$this->session->userdata('is_logged_in');
      if($events->type == 'Paid' && $is_logged_in == true) {?>
      <div class="wrapper style1">      
      <?php echo form_open_multipart('cart/add_cart/'. $events->event_id); ?>
        <input type="hidden" name="event_id" value="<?php echo $events->event_id; ?>"  />
        <input type="hidden" name="name" value="<?php echo $events->title; ?>"  />
        <input type="hidden" name="price" value="<?php echo $events->price; ?>"  />
        <input type="hidden" name="qty" value=""  />
      <button  type="submit" name="submit" class="button-1"><h2 class="pesan">Add to Cart</button>
      <?php form_close();
          ?> <?php }elseif($events->type == 'Free' && $is_logged_in == true) {?>
          <?php }elseif($events->type == 'Free'){ ?>
          <?php }else{ ?>
          <center></br>
          <a class="button-1" style="padding: 20px" href="<?php echo site_url('user/login')?>"><h2 class="pesan">Login to Order</h2></a>
          </center>
          <?php } ?>
      </div>