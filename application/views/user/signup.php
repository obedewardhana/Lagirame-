<?php 
$is_logged_in=$this->session->userdata('is_logged_in');
if($is_logged_in != true) { ?>

<div class="wrapper style1">
                            </br>

                            <h1>Register</h1>  
                            <p>Daftar sebagai user untuk membeli tiket dan sebagai event creator </br> untuk membuat event. Sudah memiliki akun?   <?php echo anchor('user/login',' Login disini.');?> </p> 
                           
                            <?php echo form_open('user/register'); ?>
                            <center>
                             <form>
                                  <ul>
                                      <li>
                                      <input type="text" name="name"  placeholder="Nama Lengkap" value="<?php echo set_value('name'); ?>"  />
                                      
                                      </li><div style="color:#D04C4C"><?php echo form_error('name'); ?></div>
                                      <li>
                                      <input type="text" name="email"  placeholder="Email" value="<?php echo set_value('email'); ?>"  />
                                      </li>                                      
                                        <div style="color:#D04C4C"><?php echo form_error('email'); ?></div>
                                      <li>
                                          <input type="password" name="password" class="field-divided" placeholder="Password" id="txtNewPassword" value="<?php echo set_value('password'); ?>"  />
                                      </li>
                                      <div style="color:#D04C4C"><?php echo form_error('password'); ?></div>
                                      <li>
                                        <input type="password" name="cpassword" class="field-divided" placeholder="Confirm Password" id="txtConfirmPassword" onChange="checkPasswordMatch();" value="<?php echo set_value('cpassword'); ?>"  />
                                      </li>                                      
                                        <div style="color:#D04C4C" id="divCheckPasswordMatch"></div>
                                        <div style="color:#D04C4C"><?php echo form_error('cpassword'); ?></div>
                                      <li>
                                      <input  type="text" name="phone"  placeholder="Nomor Telepon" value="<?php echo set_value('phone'); ?>" />
                                      </li>                                      
                                        <div style="color:#D04C4C"><?php echo form_error('phone'); ?></div>
                                      <li>
                                      <input  type="text" name="address"  placeholder="Alamat" rows="3" value="<?php echo set_value('address'); ?>" />
                                      </li>                                      
                                          <div style="color:#D04C4C; "><?php echo form_error('address'); ?></div>
                                      <li>
                                          <select name="level" class="field-select">
                                          <option style="display:none;" value="" disabled selected>Tipe User </option>
                                          <option value="user_umum"<?php echo set_select('level','user_umum', ( !empty($data) && $data == "user_umum" ? TRUE : FALSE )); ?>>User</option>
                                          <option value="event_creator"<?php echo set_select('level','event_creator', ( !empty($data) && $data == "event_creator" ? TRUE : FALSE )); ?>>Event Creator</option>
                                          </select>
                                      </li>                                      
                                        <div style="color:#D04C4C"><?php echo form_error('level'); ?></div>

                                        <li><div style="float: center; max-width: 400px;">
                                    <div class="squaredFour" style="float:left; margin-top: 10px; padding: 5px; ">
                                        <input type="checkbox" required value="None" id="squaredFour" name="check" /><label for="squaredFour"></label>
                                    </div>
                                    <div style="text-align: left; margin-left: 45px;">
                                        <p >Dengan mencentang ini berarti anda telah membaca dan menyetujui <a target="_blank" href="<?php echo site_url( 'home/syarat_ketentuan', '' );?>">Syarat & Ketentuan</a> yang berlaku. </p>
                                    </div></div>
                                    </li>
                                      
                                      <li>
                                        <div style="">
                                        <button  type="submit" name="submit" class="button btn-2 btn-2a">Submit</button>
                                         </div>
                                      </li>
                                  </ul>
                                  </form>  
                                  </center>
                          
                             <?php form_close(); ?>    &nbsp;


</div> 
<script type="text/javascript">
    function checkPasswordMatch() {
    var password = $("#txtNewPassword").val();
    var confirmPassword = $("#txtConfirmPassword").val();

    if (password != confirmPassword)
        $("#divCheckPasswordMatch").html("<p>Password tidak sesuai, periksa password.</p>");
    else if (password = confirmPassword)
        $("#divCheckPasswordMatch").html("");
    }

    $(document).ready(function () {
       $("#txtConfirmPassword").keyup(checkPasswordMatch);
    });

</script>



<?php } else {
    redirect('home'); }?>                         
 <!-- 
<div class="3u 12u$(xsmall)">-->              

