<?php 
$is_logged_in=$this->session->userdata('is_logged_in');
if($is_logged_in != true) { ?>

<style type="text/css">

    .alert{
    color: #fefefe; 
    width: 300px; 
    border-radius: 5px;
    margin:0;
    float:center; 
    padding: 5px; 
    background-color: #7EB62E;
  }

  .error{
    color: #fefefe; 
    width: 300px; 
    border-radius: 5px; 
    margin:0;
    float:center; 
    padding: 5px; 
    background-color: #D04C4C;
  }

</style>

<div class="wrapper style1">
                            </br>
                            <h1>Lupa Password ?</h1>       
                            <div style="margin-top:-10px">
                            <p>Masukan alamat email yang anda gunakan sebagai akun. </br>Belum memiliki akun? <?php echo anchor('user/register','Daftar disini.');?> </p> 
                            </div>    

                            
                            <center>
                            <?php if ($this->session->flashdata('failure')): ?>
                                <div class="error">
                                    <?php echo $this->session->flashdata('failure'); ?>
                                </div>
                            <?php endif; ?>

                             <?php if ($this->session->flashdata('success')): ?>
                                <div  class="alert">
                            <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            <?php endif; ?>     
                            <form autocomplete="off" method="post"  action="<?php echo site_url('user/forgot_password/');?>" >  <ul>
                                    <li>
                                        <input type="text" name="email" placeholder="Email" id="email" />
                                        <div style="color:#D04C4C"><?php echo form_error('email'); ?></div>&nbsp;
                                    </li>
                                    <li>
                                    <div style=""> 
                                    <button  type="submit" name="submit" class="button btn-2 btn-2a">SEND</button>
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

