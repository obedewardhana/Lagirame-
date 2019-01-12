<?php 
$is_logged_in=$this->session->userdata('is_logged_in');
$name = $this->session->userdata('username');
if($is_logged_in == true) { ?>

<div class="wrapper style1">
                            </br>
                            <header>
                            <h1>Hi, <strong><?php echo $name; ?> </strong> !</h1>
                            </header>       
                            <div style="margin-top:-20px">                            
                            <h3> Kamu bisa membuat <?php echo anchor('event/create_event','eventmu');?> sekarang.</h3> 
                            </div></br>
                                                
</div>

<?php } else {
    redirect('home'); }?>                          
 <!-- 
<div class="3u 12u$(xsmall)">-->              

