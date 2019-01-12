
  <style type="text/css">
/*----- Accordion -----*/
.accordion, .accordion * {
    -webkit-box-sizing:border-box; 
    -moz-box-sizing:border-box; 
    box-sizing:border-box;
}

.accordion {
    overflow:hidden;
    box-shadow:0px 1px 3px rgba(0,0,0,0.25);
    border-radius:3px;
    background:#f7f7f7;
}

/*----- Section Titles -----*/
.accordion-section-title {
    text-align: left;
    width:100%;
    padding:15px;
    display:inline-block;
    border-bottom:1px solid #1a1a1a;
    background:#333;
    transition:all linear 0.15s;
    /* Type */
    font-size:1.200em;
    text-shadow:0px 1px 0px #1a1a1a;
    color:#fff;
}

.accordion-section-title.active, .accordion-section-title:hover {
    background:#4c4c4c;
    /* Type */
    text-decoration:none;
}

.accordion-section:last-child .accordion-section-title {
    border-bottom:none;
}

/*----- Section Content -----*/
.accordion-section-content {
    padding:15px;
    display:none;
}

  </style>

  <script type="text/javascript">
    $(document).ready(function() {
    function close_accordion_section() {
        $('.accordion .accordion-section-title').removeClass('active');
        $('.accordion .accordion-section-content').slideUp(300).removeClass('open');
    }

    $('.accordion-section-title').click(function(e) {
        // Grab current anchor value
        var currentAttrValue = $(this).attr('href');

        if($(e.target).is('.active')) {
            close_accordion_section();
        }else {
            close_accordion_section();

            // Add active class to section title
            $(this).addClass('active');
            // Open up the hidden content panel
            $('.accordion ' + currentAttrValue).slideDown(300).addClass('open'); 
        }

        e.preventDefault();
    });
});
  </script>

</br>

<div class="wrapper style1">
    <div class="container">

      <div class="row">  
            <div class="4u 12u(mobile)">        
                <div class="accordion">
                    <div class="accordion-section">
                        <a class="accordion-section-title" href="#accordion-1">Categories</a>
                        
                        <div id="accordion-1" class="accordion-section-content">
                        <?php 
                        $allcategories=$this->category_model->getallcategories();
                        $data['allcategories']=$allcategories;
                        foreach ($allcategories as $acategory):?>
                        <a class="catlinks" href="<?php echo site_url('event/categories/'.($acategory->category_id)) ?>">
                        <?php echo $acategory->name;?></br></a>
                        <?php endforeach;?>
                        </div><!--end .accordion-section-content-->
                    </div><!--end .accordion-section-->
                    <div class="accordion-section">
                        <a class="accordion-section-title" href="#accordion-2">Type</a>
                        
                        <div id="accordion-2" class="accordion-section-content">                        
                        <a class="catlinks" href="<?php echo site_url('event/types/Free') ?>">Free</a></br>
                         <a class="catlinks" href="<?php echo site_url('event/types/Paid') ?>">Paid</a>
                        </div><!--end .accordion-section-content-->
                    </div><!--end .accordion-section-->
                    <div class="accordion-section">
                    <a class="accordion-section-title" href="#accordion-3">Search</a>
                    <div id="accordion-3" class="accordion-section-content">
                    <div class="container-4" >
                    <form action="<?php echo site_url('event/search');?>" method="post" >
                        <input class="container-4" name="searchevents" type="search" id="search" placeholder="Temukan Event Menarik Disini" />
                        <button type="submit" name="submit" class="icon" style="margin-top:-0.1px"><i class="fa fa-search" style="color: #fff;"></i></button></form></div>
                        </div>
                    </div>
                </div><!--end .accordion-->

            </div>   
            <div class="8u 12u(mobile)" >
            <div  style="margin-bottom:20px;">
            <h1 class="categories"><?php echo $catename['name'];?></h1> </div>

            <div class="row" style="margin-bottom: 200px">  
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
                if(is_array($categories) && count($categories) ) {  
                  foreach ($categories as $category):
                      ?> 

                    <div class="6u 12u(mobile)">                     
                    <table>
                    <tr>                  
                    <div class="card radius shadowDepth1">
                      <div class="card__image border-tlr-radius">
                        <img alt="image" class="border-tlr-radius" style="height:120px" src="data:image/jpeg;base64,<?php echo base64_encode($category->image); ?>" >
                      </div>

                       

                      <div class="card__content card__padding">
                        <div class="card__share">

                        </div>

                        <a class="card-body-header-category" href="<?php echo site_url('event/types/'.($category->type)) ?>"><?php echo $category->type;?></a>

                        
                          
                          <a href="<?php echo site_url('event/categories/'.($category->category_id)) ?>" class="card-body-header-category2" >
                          <?php $categoris=$this->category_model->get_paged_list()->result();
                                $data['categoris']=$categoris;
                                foreach($categoris as $categori) {
                                $result[$categori->category_id] = $categori->name ;} 
                                echo $category->category_id=$result[$category->category_id];?>
                                  
                                </a>
                        
                                                  
                         <p class="time"><label class="calendar">&nbsp;</label>
                          <?php 
                          setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
                          //$date = date_create($event['start_date']); 
                          $d = strtotime($category->start_date);
                          $format = '%d %B %Y';
                          echo strftime($format, $d);?></p>
                          <h2 class="feature"><a href="<?php echo site_url('event/eventdetails/'.($category->event_id)) ?>"><?php custom_echo($category->title, 40);?></a></h2>
                          <p class="location"><label class="lokasi">&nbsp;</label><?php custom_echo($category->location, 35);?></p>
                          <a  href="<?php echo site_url('event/eventdetails/'.($category->event_id)) ?>">Click Details&nbsp;<label class="next"></label></a>
                       
                      </div>                      
                    </div>                  
                      </tr>
                      </table> 

                    </div>    
                        <?php                         
                        endforeach;
                        }
                        else {
                          echo " <td colspan=50>Tidak Ada Event.</tr></td><tr>";
                        }
                        ?> 
                    

</div> 
            </div>
          </div>
</div>
</div>
