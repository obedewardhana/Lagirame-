<?php 
$is_logged_in=$this->session->userdata('is_logged_in');
if($is_logged_in != true) { ?>

<style type="text/css">

    .alert{
    color: #fefefe; 
    width: 300px; 
    border-radius: 5px; 
    margin: 0; 
    float:center; 
    padding: 5px; 
    background-color: #7EB62E;
  }

  .error{
    color: #fefefe; 
    width: 300px; 
    border-radius: 5px; 
    margin: 0; 
    float:center; 
    padding: 5px; 
    background-color: #D04C4C;
  }

</style>
<div class="wrapper style1">
                            </br>
                            <h1>Reset Password </h1>       
                            <p> Silahkan masukan password anda yang baru  </p>                         

                             <?php if ($this->session->flashdata('success')): ?>
                                <div class="alert">
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($this->session->flashdata('failure')): ?>
                                <div class="error">
                                    <?php echo $this->session->flashdata('failure'); ?>
                                </div>
                            <?php endif; ?>
                            <?php
                            if (isset($error)){
                                echo "<div class='error'>$error</div></br>";
                            

                            }?>                   
                                                        <center>
                            <form autocomplete="off" method="post" action="<?php echo site_url('user/reset_password').'/'.$initoken; ?>">
                                    <ul>
                                    <li>
                                        <input type="password" name="password" placeholder="Password" id="txtNewPassword" value="<?php echo set_value('password'); ?>"  />
                                        <div style="color:#D04C4C"><?php echo form_error('password'); ?></div>
                                    </li>
                                    <li>
                                        <input type="password" name="cpassword" placeholder="Confirm Password" value="<?php echo set_value('cpassword'); ?>"  />
                                        <div style="color:#D04C4C" id="divCheckPasswordMatch"></div>
                                        <div style="color:#D04C4C"><?php echo form_error('cpassword'); ?></div>
                                    &nbsp;
                                    </li>
                                    <li>
                                    <div style=""> 
                                    <button  type="submit" name="submit" class="button btn-2 btn-2a">UPDATE</button>
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

