
    <?php
$profpic = base_url()."images/eh.png";
?>
<!DOCTYPE HTML>
<!--
    Spatial by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html lang="en">

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <body>
    <div class="wrapper style1 " style="background-image:url('<?php echo $profpic;?>'); max-width: 100%;  background-repeat:no-repeat; background-size: 160%; background-attachment: fixed;  background-position: top center; ">
                    <div class="container" style="">
                             <img src="<?php echo base_url() ?>images/lagirame.png" style="width: 100%; max-width: 400px;" >
                             <div style="font-size: 17px; color:#e1e1e1;">
                            <p class="tagline">Buat Event dan Beli Tiket Dalam Satu Tempat</p>
                            </div>
    </div></div>
<div class="wrapper style1">
                    
                    <center>
                      <div class="container-4" style="margin-bottom:60px; margin-top:-15px;">
                      <form action="<?php echo site_url('event/search');?>" method="post" >
                        <input class="container-4" name="searchevents" type="search" id="search" placeholder="Temukan Event Menarik Disini" />
                        <button type="submit" name="submit" class="icon" style="margin-top:-0.1px"><i class="fa fa-search" style="color: #fff;"></i></button></form>
                            <?php if ($this->session->flashdata('error')): ?></br>
                                <div style="color: #fefefe; width: 400px; border-radius: 5px; margin: 0; float:center; padding: 5px; background-color: #D04C4C;"">
                                    <?php echo $this->session->flashdata('error'); ?>
                                </div>
                            <?php endif; ?>
                             <?php if ($this->session->flashdata('success')): ?></br>
                                <div style="color: #fefefe; width: 400px; border-radius: 5px; margin: 0; float:center; padding: 5px; background-color: #85c56b;"">
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            <?php endif; ?>
                        </br></br>
                      <h1 class="bulantitle" >[ Event di <?php setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
                      echo strftime('%B %Y'); ?> ]</h1>

                        <?php 
                              echo $this->pagination->create_links();
                              ?>
                      </div>               
                    </center>
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
                if(is_array($rows) && count($rows) ) {  
                  foreach ($rows as $row):
                      ?>                       
                    <div class="4u 12u(mobile)">
                    <table>
                    <tr>                  
                    <div class="wrappers" style="margin-top:-40px">
                    <div class="card radius shadowDepth1">
                      <div class="card__image border-tlr-radius">
                        <img alt="image" class="border-tlr-radius" style="height:120px" src="data:image/jpeg;base64,<?php echo base64_encode($row->image); ?>" >
                      </div>

                       

                      <div class="card__content card__padding">
                        <div class="card__share">

                        </div>

                        <a class="card-body-header-category" href="<?php echo site_url('event/types/'.($row->type)) ?>"><?php echo $row->type;?></a>

                        
                          
                          <a href="<?php echo site_url('event/categories/'.($row->category_id)) ?>" class="card-body-header-category2" >
                          <?php $categories=$this->category_model->get_paged_list()->result();
                                $data['categories']=$categories;
                                foreach($categories as $category) {
                                $result[$category->category_id] = $category->name ;} 
                                echo $row->category_id=$result[$row->category_id];?>
                                  
                                </a>
                        
                                                  
                          <?php if($row->start_date != $row->end_date) {?>
                          <p class="time"><label class="calendar">&nbsp;</label>
                          <?php 
                          setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
                          //$date = date_create($event['start_date']); 
                          $d = strtotime($row->start_date);
                          $format = '%d';
                          echo strftime($format, $d);?> - <?php 
                          setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
                          //$date = date_create($event['start_date']); 
                          $e = strtotime($row->end_date);
                          $format = '%d %B %Y';
                          echo strftime($format, $e);?></p><?php }else {?>
                          <p class="time"><label class="calendar">&nbsp;</label>
                          <?php 
                          setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
                          //$date = date_create($event['start_date']); 
                          $d = strtotime($row->start_date);
                          $format = '%d %B %Y';
                          echo strftime($format, $d);?></p>
                
                          <?php } ?>          


                          <h2 class="feature"><a href="<?php echo site_url('event/eventdetails/'.($row->event_id)) ?>"><?php custom_echo($row->title, 35);?></a></h2>
                          <p class="location"><label class="lokasi">&nbsp;</label><?php custom_echo($row->location, 35);?></p>
                          <a  href="<?php echo site_url('event/eventdetails/'.($row->event_id)) ?>">Click Details&nbsp;<label class="next"></label></a>
                       
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

