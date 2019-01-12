<?php
$email = $this->session->userdata('email');
?>
<div class="wrapper style1">
                            </br>

                            <h1>My Event</h1>
                            <div style="">  
                            <p><?php echo $result['name'] ?></p>
                            <?php 
                            $id = $result['user_id'];
                            $data= $this->event_model->geteventbyid($id);?>
                            </div></br></br></br>
                            
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
                    
                  foreach ($data as $event){
                      ?>                       
                    <div class="4u 12u(mobile)">
                    <table>
                    <tr>                  
                    <div class="wrappers" style="margin-top:-40px">
                    <div class="card radius shadowDepth1">
                      <div class="card__image border-tlr-radius">
                        <img alt="image" class="border-tlr-radius" style="height:120px" src="data:image/jpeg;base64,<?php echo base64_encode($event['image']); ?>" >
                      </div>

                      <div class="card__content card__padding">
                        <div class="card__share">
                        </div>

                        <div class="card-body-header-category"><?php echo $event['type'];?></div>

                        <div class="card__meta">
                          <?php $categories=$this->category_model->get_paged_list()->result();
                                $data['categories']=$categories;
                                foreach($categories as $category) {
                                $result[$category->category_id] = $category->name ;} 
                                echo $event['category_id']=$result[$event['category_id']];?>
                          <time><?php $date = date_create($event['start_date']); echo date_format($date, 'j F');?></time>
                        </div>

                        <article class="card__article">
                          <h2 class="feature"><a href="#"><?php custom_echo($event['title'], 40);?></a></h2>
                          <p class="feature"><?php custom_echo($event['location'], 40);?></p>
                        </article>
                      </div>                      
                    </div>
                    </div>                   
                      </tr>
                      </table>                                  
                    </div>
                        <?php 
                        }
                        ?> 
                    </div>
                    </div> 
                                                  
</div> 

