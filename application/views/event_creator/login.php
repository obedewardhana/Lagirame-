<?php 
$is_logged_in=$this->session->userdata('is_logged_in');
if($is_logged_in != true) { ?>
<div class="wrapper style1">
                            </br>
                            <h1>Masuk</h1>       
                            <div>
                            <p>Belum memiliki akun? <?php echo anchor('event_creator/signup','Register disini.');?> </br>
                            Lupa Password Anda Saat ini? <?php echo anchor('event_creator/reset','Reset disini.');?> 
                            </p> 
                            </div>                          
                            <?php
                            if (isset($error)){
                                echo "<div style='color:#D04C4C'>$error</div></br>";
                            }?>                          
                            <center>
                            <form action="<?php echo site_url('login/validate/');?>" method="post">
                                    <div class="4u 12u(mobile)" style="color=#fff; margin-top: ; margin-bottom:20px">
                                        <input type="text" name="username" placeholder="Username" id="username" value="<?php echo set_value('username'); ?>"/>
                                        <div style="float:right; color:#D04C4C"><?php echo form_error('username'); ?></div>
                                    </div>
                                    <div class="4u 12u(mobile)" style="margin-bottom:80px">
                                        <input type="password" name="password" placeholder="Password" id="password" value="<?php echo set_value('password'); ?>" />
                                        <div style="float:right; color:#D04C4C"><?php echo form_error('password'); ?></div>
                                    </div>
                                    <div style=""> 
                                    <button  type="submit" name="submit" class="button btn-2 btn-2a">Login</button>
                                   </div>                            
                            </form> 
                             </center>                  
</div> 
<?php } else {
    redirect('home'); }?>                   
 <!-- 
<div class="3u 12u$(xsmall)">-->              

