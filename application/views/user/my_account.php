<?php 
$is_logged_in=$this->session->userdata('is_logged_in');
$level=$this->session->userdata('level');
if($is_logged_in == true && $level == 'user_umum' ) { ?>

<style type="text/css">
@import url("http://fonts.googleapis.com/css?family=Open+Sans:400,600,700");
@import url("http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css");
  main {
  min-width: 250px;
  max-width: 900px;
  padding: 50px;
  margin: 0 auto;
  background: #fff;
}

section {
  display: none;
  padding: 20px 0 0;
  border-top: 1px solid #ddd;
}

input {
  display: none;
}

.title-heading{
    border-bottom: 1px solid #ddd;
    font-size: 15px;
    padding-bottom: 5px;
    max-width: 400px;
}

.alert{
    color: #fefefe; 
    width: 300px; 
    border-radius: 5px; 
    margin: 0; 
    float:center; 
    padding: 5px; 
    background-color: #7EB62E;
  }

label.form {
    font-weight: bold;
    display: block;
    margin:0 0 3px 0;
    text-align: left;
    max-width: 400px;
    font: 14px/1 'Roboto', sans-serif;

  }

label.accordion {
  display: inline-block;
  margin: 0 0 -1px;
  padding: 15px 25px;
  font-weight: 600;
  text-align: center;
  color: #bbb;
  border: 1px solid transparent;
}



label.accordion:before {
  font-family: fontawesome;
  font-weight: normal;
  margin-right: 10px;
}

label.accordion[for*='1']:before {
  content: '\f007';
}

label.accordion[for*='2']:before {
  content: '\f1da';
}

label.accordion[for*='3']:before {
  content: '\f16b';
}

label.accordion[for*='4']:before {
  content: '\f1a9';
}

label.accordion:hover {
  color: #888;
  cursor: pointer;
}

input:checked + label {
  color: #555;
  border: 1px solid #ddd;
  border-top: 2px solid orange;
  border-bottom: 1px solid #fff;
}



#tab1:checked ~ #content1,
#tab2:checked ~ #content2,
#tab3:checked ~ #content3,
#tab4:checked ~ #content4 {
  display: block;
}

@media screen and (max-width: 650px) {
  label.accordion {
    font-size: 0;
  }

  label.accordion:before {
    margin: 0;
    font-size: 18px;
  }
}
@media screen and (max-width: 400px) {
  label.accordion {
    padding: 15px;
  }
}

table {
font: 14px/1 'Roboto', sans-serif; }   /* added custom font-family  */

table.one {                  
margin-bottom: 3em; 
border-collapse:collapse; } 

td {              /* removed the border from the table data rows  */
text-align: center;     
width: 10em;          
padding: 1em;     }   

th {                /* removed the border from the table heading row  */
text-align: center;         
padding: 1em;
background-color: #e8503a;       /* added a red background color to the heading cells  */
color: white;   }           /* added a white font color to the heading text */

tr {  
height: 1em;  }

table tr:nth-child(even) {          /* added all even rows a #eee color  */
       background-color: #eee;    }

table tr:nth-child(odd) {        /* added all odd rows a #fff color  */
background-color:#fff;    }
</style>

<?php
$email = $this->session->userdata('email');
$user_id = $this->session->userdata('user_id');
?>
<div class="wrapper style1">
</br>
    <h1><?php echo $user->name; ?></h1>
                                   
                <div class="container" style="margin-top: -30px">
                    
          <main>
  
              <input id="tab1" type="radio" name="tabs" checked>
              <label for="tab1" class="accordion">My Profile</label>
                
              <input id="tab2" type="radio" name="tabs">
              <label for="tab2" class="accordion">Order History</label>
             
                
              <section id="content1">
                            <center>
                            <?php if ($this->session->flashdata('success')): ?>
                                <div class="alert">
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            <?php endif; ?>
                             <form  method="post" action="<?php echo site_url('user_umum/my_account'); ?>">                             
                               <?php echo form_open('user_umum/my_account'.$user_id); ?>
                             <p class="title-heading">Perbarui data profil Anda di bawah ini.</p>
                                  <ul>
                                      <li><label class="form">Nama Lengkap</label>
                                      <input type="hidden" name="user_id" value="<?php echo $user->user_id;?><?php echo set_value('user_id'); ?>">
                                      <input type="text" name="name" value="<?php echo set_value('name', isset($user->name) ? $user->name : ''); ?>"  />
                                      </li><div style="color:#D04C4C"><?php echo form_error('name'); ?></div>
                                      <li><label class="form">Email</label>
                                      <input type="text" name="email"  value="<?php echo set_value('email', isset($user->email) ? $user->email : ''); ?>"  />
                                      </li>                                      
                                        <div style="color:#D04C4C"><?php echo form_error('email'); ?></div>
                                      <li><label class="form">Password</label>
                                          <input type="password" name="password" placeholder="Isi jika ingin ganti password"  id="txtNewPassword" value="<?php echo set_value('password'); ?>"  />
                                      </li>
                                      <div style="color:#D04C4C"><?php echo form_error('password'); ?></div>
                                      <li><label class="form">Konfirmasi Password</label>
                                        <input type="password" name="cpassword" class="field-divided"  id="txtConfirmPassword" onChange="checkPasswordMatch();" value="<?php echo set_value('cpassword'); ?>"  />
                                      </li>                                      
                                        <div style="color:#D04C4C" id="divCheckPasswordMatch"></div>
                                        <div style="color:#D04C4C"><?php echo form_error('cpassword'); ?></div>
                                      <li><label class="form">Nomor Telepon / HP</label>
                                      <input  type="text" name="phone"  value="<?php echo set_value('phone', isset($user->phone) ? $user->phone : ''); ?>" />
                                      </li>                                      
                                        <div style="color:#D04C4C"><?php echo form_error('phone'); ?></div>
                                      <li><label class="form">Alamat</label>
                                      <textarea name="address" ><?php echo set_value('address', isset($user->address) ? $user->address : ''); ?></textarea>
                                      
                                      </li>                                      
                                          <div style="color:#D04C4C; "><?php echo form_error('address'); ?></div>
                                        &nbsp;

                                      <li>
                                        <div style="">
                                        <button  type="submit" name="submit" class="button btn-2 btn-2a">Update</button>
                                         </div>
                                      </li>
                                  </ul>
                                  </form>  
                                  </center>
                          
                             <?php form_close(); ?>     
              </section>
                
              <section id="content2">
              <center>
              <p class="title-heading">Riwayat Pemesanan Tiket.</p>
              </center>
               <table class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>Kode</th>
                <th>Tanggal Pesan</th>
                <th>Total</th>
                <th>Tanggal Kadaluarsa</th>
                <th>Status</th>
                <th>Action</th>

                </tr>
              </thead>

              <?php $id = $this->session->userdata('user_id');
                    $data= $this->order_model->getorderbyid($id);
                    if(is_array($data) && count($data) ) {  
                  foreach ($data as $order):
                      ?>
            <tr>
                    <td><?php echo $order['code']; ?></td>
                    <td>
                      <?php 
                          setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
                          //$date = date_create($event['start_date']); 
                          $d = strtotime($order['order_date']);
                          $format = '%d %B %Y';
                          echo strftime($format, $d);?>
                    </td>
                    <td><strong><?php echo $this->cart->format_number($order['total']); ?></strong></td>
                    <td>
                      <?php 
                          setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
                          //$date = date_create($event['start_date']); 
                          $d = strtotime($order['payment_deadline']);
                          $format = '%d %B %Y';
                          echo strftime($format, $d);?>
                    </td>
                    <td><?php echo $order['status']; ?></td>
                    <td>
                        <?php if ($order['status'] == 'Tunda'): ?>
                            <?php echo anchor('confirmation/add_confirmation/' . $order['code'], 'Konfirmasi'); ?>
                            |
                        <?php endif; ?>

                        <?php echo anchor('order/detail/' . $order['code'], 'Rincian'); ?>
                    </td>
            </tr>

     <?php endforeach;
                        }
                        else {
                          echo "<tr><td colspan=50></br>Tidak Ada Order.</br> </br></td></tr>";
                        }
                        ?> 
    </table>
              </section>
                
                
            </main>
                    
      </div> 
                                                  
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

