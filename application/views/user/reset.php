<?php 
$is_logged_in=$this->session->userdata('is_logged_in');
if($is_logged_in != true) { ?>
<div class="wrapper style1">
                            </br>
                            <h1>Reset Password</h1>       
                            <div style="margin-top:-10px">
                            <p>Belum memiliki akun? <?php echo anchor('event_creator/reset','Register disini.');?> </p> 
                            </div>                          
                            <?php if($this->session->flashdata('message')) {?>
                             <div style="color: #CC6633"><?php echo $this->session->flashdata('message');?></div>
                            <?php }?>                         
                                                        <center>
                            <form method="post" action="<?php echo site_url('event_creator/reset/');?>" >
                                    <div class="4u 12u(mobile)" style="color=#fff; margin-top: ; margin-bottom:20px">
                                        <input type="text" name="email" placeholder="Email" id="email" />
                                        <div style="float:right; color:#D04C4C"><?php echo form_error('username'); ?></div>
                                    </div>
                                    <div style=""> 
                                    <button  type="submit" name="submit" class="button btn-2 btn-2a">Submit</button>
                                   </div>                            
                            </form> 
                             </center>                  
</div> 
<?php } else {
    redirect('home'); }?>                   
 <!-- 
<div class="3u 12u$(xsmall)">-->              

