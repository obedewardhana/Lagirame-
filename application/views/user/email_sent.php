<?php 
$is_logged_in=$this->session->userdata('is_logged_in');
if($is_logged_in != true) { ?>
<div class="wrapper style1">
                            </br>&nbsp;&nbsp;
                            <h1>Email sudah terkirim!</h1>       
                            &nbsp;&nbsp;
                            <p>Buka email anda dan link yang kami kirim untuk mereset password.</br>Belum memiliki akun? <?php echo anchor('user/register','Daftar disini.');?> </p> &nbsp;&nbsp;&nbsp;&nbsp;
                            
                             </center>                  
</div> 

<?php } else {
    redirect('home'); }?>                   
 <!-- 
<div class="3u 12u$(xsmall)">-->              

