<?php 
$is_logged_in=$this->session->userdata('is_logged_in');
if($is_logged_in != true) { ?>
<div class="wrapper style1">
                            </br>
                            <h1>Login to site</h1> 
                            
                            <center>
                            <p>
                            Lupa Password Anda Saat Ini? <?php echo anchor('user/forgot_password','Reset disini.  ');?></br>
                            Belum punya akun? <?php echo anchor('user/register','Daftar disini.');?> 
                             <?php
                            if (isset($error)){
                                echo "<div style='color: #fefefe; width: 400px; border-radius: 5px; margin: 0; float:center; padding: 5px; background-color: #D04C4C;'>$error</div>";
                            }?>
                            <?php
                            if (isset($success)){
                                echo "<div style='color: #fefefe; width: 300px; border-radius: 5px; margin: 0; float:center; padding: 5px; background-color: #7EB62E;'>$success</div>";
                            }?>
                            <?php if ($this->session->flashdata('error')): ?></br>
                                <div style="color: #fefefe; width: 400px; border-radius: 5px; margin: 0; float:center; padding: 5px; background-color: #D04C4C;"">
                                    <?php echo $this->session->flashdata('error'); ?>
                                </div>
                            <?php endif; ?>
                            </p>   
                            <form action="<?php echo site_url('user/login_to_page/');?>" method="post">
                                    <ul>
                                      <li>
                                        <input type="text" name="email" placeholder="Email" id="email" value="<?php echo set_value('email'); ?>"/>
                                    </li>                                    
                                        <div style="color:#D04C4C"><?php echo form_error('email'); ?></div>
                                    <li>
                                        <input type="password" name="password" placeholder="Password" id="password" value="<?php echo set_value('password'); ?>" />
                                    </li>                                    
                                        <div style="color:#D04C4C"><?php echo form_error('password'); ?></div>&nbsp;

                                     <li>
                                    <div style=""> 
                                    <button  type="submit" name="submit" class="button btn-2 btn-2a">Login</button>
                                   </div>  
                                   </li> 
                                   </ul>                          
                            </form> 
                            </center>                  
</div> 

<?php } else {
    redirect('home'); }?>                   
 <!-- 
<div class="3u 12u$(xsmall)">-->              

