<?php 
$is_logged_in=$this->session->userdata('is_logged_in');
if($is_logged_in != true) { ?>

<div class="wrapper style1">
                            </br>

                            <h1>Daftar</h1>       
                            <div >
                            <p>Anda harus mendaftar untuk membuat event atau memesan tiket.</br>Sudah memiliki akun? <?php echo anchor('login','Login disini.');?> </p> 
                            </div></br>
                            <?php echo form_open('event_creator/signup'); ?>
                            <center>
                                    <div class="4u 12u(mobile)" style="color=#fff; margin-top: -40px; margin-bottom:8px">
                                        <input type="text" name="name" placeholder="Complete Name" value="<?php echo set_value('name'); ?>"  />
                                        <div style="float:right; color:#D04C4C"><?php echo form_error('name'); ?></div>
                                    </div>
                                    <div class="4u 12u(mobile)" style="margin-bottom:8px">
                                        <input type="text" name="username"  placeholder="Username" value="<?php echo set_value('username'); ?>" />
                                        <div style="float:right; color:#D04C4C"><?php echo form_error('username'); ?></div>
                                    </div>
                                    <div class="4u 12u(mobile)" style="margin-bottom:8px">
                                        <input type="password" name="password" placeholder="Password" id="txtNewPassword" value="<?php echo set_value('password'); ?>"  />
                                        <div style="float:right; color:#D04C4C"><?php echo form_error('password'); ?></div>
                                    </div>
                                    <div class="4u 12u(mobile)" style="margin-bottom:8px">
                                        <input type="password" name="cpassword" placeholder="Confirm Password" id="txtConfirmPassword" onChange="checkPasswordMatch();" value="<?php echo set_value('cpassword'); ?>"  />
                                        <div style="color:#D04C4C" id="divCheckPasswordMatch"></div>
                                        <div style="float:right; color:#D04C4C"><?php echo form_error('cpassword'); ?></div>
                                    </div>
                                    <div class="4u 12u(mobile)" style="margin-bottom:8px">
                                        <input type="text" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>"  />
                                        <div style="float:right; color:#D04C4C"><?php echo form_error('email'); ?></div>
                                    </div>
                                    <div class="4u 12u(mobile)" style="margin-bottom:50px">
                                        <input type="text" name="organization" placeholder="Organization" value="<?php echo set_value('organization'); ?>"  />
                                        <div style="float:right; color:#D04C4C; "><?php echo form_error('organization'); ?></div>
                                    </div>
                                    <div class="4u 12u(mobile)">
                                    <div class="squaredFour" style="float:left; padding: 5px;">
                                        <input type="checkbox" required value="None" id="squaredFour" name="check" /><label for="squaredFour"></label>
                                    </div>
                                    <div style="font-size:14px; text-align: left; margin-left: 45px;">
                                        <p>Dengan mencentang ini berarti anda telah membaca dan menyetujui <?php echo anchor('ham','Syarat dan Ketentuan');?> yang berlaku. </p></div></div>
                                    <div style="">
                                    <button  type="submit" name="submit" class="button btn-2 btn-2a">Submit</button>
                                   </div>
                             </center>
                             </form> 
                             <?php form_close(); ?>                           
</div> 
<script type="text/javascript">
    function checkPasswordMatch() {
    var password = $("#txtNewPassword").val();
    var confirmPassword = $("#txtConfirmPassword").val();

    if (password != confirmPassword)
        $("#divCheckPasswordMatch").html("Password Tidak Cocok!");
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

