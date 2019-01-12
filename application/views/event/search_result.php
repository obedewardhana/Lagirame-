<!DOCTYPE HTML>
<html lang="en">
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <body>

<div class="wrapper style2">
                    
                    <center>
                            <h1>[ Hasil Pencarian ]</h1> 
                            <p><i class="fa fa-search" style="color: #040404;">&nbsp;</i>
                            Ditemukan kata kunci <?php echo $searchevents;?>
                            dengan jumlah <?php echo $jumlah;?></p>

                      <div class="container-4" >
                      <form action="<?php echo site_url('event/search');?>" method="post" >
                        <input class="container-4" name="searchevents" type="search" id="search" placeholder="Temukan Event Menarik Lainnya Disini" />
                        <button type="submit" name="submit" class="icon" style="margin-top:-0.1px"><i class="fa fa-search" style="color: #fff;"></i></button></form>
                          <?php 
                              echo $this->pagination->create_links();
                              ?>
                        </div>

                    </center></div>
<div class="wrapper style1">
                      </br>
                    <div class="container">
                    <div class="row">       
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
                if(is_array($hasil) && count($hasil) ) {  
                  foreach ($hasil as $item):
                      ?>                       
                    <div class="4u 12u(mobile)">
                    <table>
                    <tr>                  
                    <div class="wrappers" style="margin-top:-40px">
                    <div class="card radius shadowDepth1">
                      <div class="card__image border-tlr-radius">
                        <img alt="image" class="border-tlr-radius" style="height:120px" src="data:image/jpeg;base64,<?php echo base64_encode($item->image); ?>" >
                      </div>

                       

                      <div class="card__content card__padding">
                        <div class="card__share">

                        </div>

                        <a class="card-body-header-category" href="<?php echo site_url('event/types/'.($item->type)) ?>"><?php echo $item->type;?></a>

                        
                          
                          <a href="<?php echo site_url('event/categories/'.($item->category_id)) ?>" class="card-body-header-category2" >
                          <?php $categories=$this->category_model->get_paged_list()->result();
                                $data['categories']=$categories;
                                foreach($categories as $category) {
                                $result[$category->category_id] = $category->name ;} 
                                echo $item->category_id=$result[$item->category_id];?>
                                  
                                </a>
                        
                                                  
                         <?php if($item->start_date != $item->end_date) {?>
                          <p class="time"><label class="calendar">&nbsp;</label>
                          <?php 
                          setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
                          //$date = date_create($event['start_date']); 
                          $d = strtotime($item->start_date);
                          $format = '%d';
                          echo strftime($format, $d);?> - <?php 
                          setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
                          //$date = date_create($event['start_date']); 
                          $e = strtotime($item->end_date);
                          $format = '%d %B %Y';
                          echo strftime($format, $e);?></p><?php }else {?>
                          <p class="time"><label class="calendar">&nbsp;</label>
                          <?php 
                          setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
                          //$date = date_create($event['start_date']); 
                          $d = strtotime($item->start_date);
                          $format = '%d %B %Y';
                          echo strftime($format, $d);?></p>
                
                          <?php } ?> 

                          <h2 class="feature"><a href="<?php echo site_url('event/eventdetails/'.($item->event_id)) ?>"><?php custom_echo($item->title, 35);?></a></h2>
                          <p class="location"><label class="lokasi">&nbsp;</label><?php custom_echo($item->location, 35);?></p>
                          <a  href="<?php echo site_url('event/eventdetails/'.($item->event_id)) ?>">Click Details&nbsp;<label class="next"></label></a>
                      </div>                      
                    </div>
                    </div>                   
                      </tr>
                      </table>                                  
                    </div>
                        <?php                         
                        endforeach;
                        }
                        else {
                          echo "<tr><td colspan=50></br>Tidak Ada Event.</br> </br></td></tr>";
                        }
                        ?> 
                    </div>

                    </div> 
</div>

<script>
var x = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude;
}
</script>

    </body>
</html>


                        <!--<div class="card__author">
                          <img src="http://lorempixel.com/40/40/sports/" alt="user">
                          <div class="card__author-content">
                            By <a href="#">John Doe</a>
                          </div>
                        </div>-->