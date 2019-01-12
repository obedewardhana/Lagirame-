
<style type="text/css">
  .title-heading{
    border-bottom: 1px solid #ddd;
    font-size: 15px;
    padding-bottom: 10px;
    max-width: 450px;
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

.error{
  color: #fefefe; 
  width: 400px; 
  border-radius: 5px; 
  margin: 0; 
  float:center; 
  padding: 5px; 
  background-color: #D04C4C;
}

.errorval{
    color:#D04C4C;
    max-width: 400px;
    margin: 0;
    text-align: right; 
  }

label.form {
    font-weight: bold;
    display: block;
    margin:0 0 3px 0;
    text-align: left;
    max-width: 400px;
    font: 14px/1 'Roboto', sans-serif;

  }

.syarat{
  max-width: 400px;
}

.colcen {
  max-width: 700px;
  float: left;
  margin-left: 5%;
  margin-bottom: 200px;
}


.wrappercolumn{
  max-width: 800px;
  float: center;
}
#two-column #left{
  width: 300px;
  float: left;
}
#two-column #right{
  width: 250px;
  float: right;
}

.grid3 .col:nth-of-type(3n+1),
.grid2 .col:nth-of-type(2n+1) {
  margin-left: 0;
  clear: left;
}
/* col */
.col {
  float: left;
  margin-left: 3.2%;
  margin-bottom: 30px;
}

/* grid3 col */
.grid3 .col {
  width: 31.2%;
}

/* grid2 col */
.grid2 .col {
  width: 48.4%;
}

@media screen and (max-width: 600px) {

  /* change grid3 to 2-column */
  .grid3 .col {
    width: 48.4%;
  }
  .grid3 .col:nth-of-type(3n+1) {
    margin-left: 3.2%;
    clear: none;
  }
  .grid3 .col:nth-of-type(2n+1) {
    margin-left: 0;
    clear: left;
  }
}
@media screen and (max-width: 500px) {
  .col {
    width: 100% !important;
    margin-left: 0 !important;
    clear: none !important;
  }
}

</style>



<div class="wrapper style1">
                            </br>

                            <h1>Add Confirmation</h1>    

                            <center>
                             <p class="title-heading">Masukkan data pembayaran anda secara lengkap dan benar untuk dapat di setujui.</p>
                            
                            <?php 

                            //setlocale(LC_ALL, 'IND'); 
                            $uid=$this->session->userdata('user_id');
                            $user=$this->user_model->getuid($uid);
                           
                            ?>

                            <?php if ($this->session->flashdata('error')): ?>
                                <div class="error">
                                    <?php echo $this->session->flashdata('error'); ?>
                                </div>
                            <?php endif; ?>
                            &nbsp;
                            
                            
                            <?php echo form_open_multipart('confirmation/add_confirmation'); ?>
                            <form action="<?php echo site_url('event_creator/add_event/');?>" method="post">
                  <div class="wrappercolumn"> 
                               <ul>
                                    <li>
                                    <input type="hidden" name="code" value="<?php echo $order['code'];?>"  />
                                    </li>

                                    <li>
                                    <label class="form">Nama Bank</label>
                                    <input type="text" name="sender_bank" placeholder="Nama Bank Pengirim" value="<?php echo set_value('sender_bank'); ?>"  />
                                        <div class="errorval"><?php echo form_error('sender_bank'); ?></div>
                                    </li>

                                    <li>
                                    <label class="form">Nama Pengirim</label>
                                        <input type="text" name="name"  placeholder="Atas nama Pengirim" value="<?php echo set_value('name'); ?>"/>
                                        <div class="errorval"><?php echo form_error('name'); ?></div>
                                    </li>

                                    <li>
                                     <label class="form">Tanggal Transfer</label> 
                                        <input type="date" id="start_date"   name="payment_date"  placeholder="Tanggal Pembayaran" value="<?php echo set_value('payment_date'); ?>"    onkeypress="return isNumberKey(event)"
                                         />
                                        <div class="errorval"><?php echo form_error('payment_date'); ?></div>
                                    </li>

                                    <li>
                                     <label class="form">Deskripsi</label>
                                        <textarea style="" name="description" placeholder="Deskripsi pembayaran" value=""  /><?php echo set_value('description'); ?></textarea>
                                        <div class="errorval"><?php echo form_error('description'); ?></div>
                                    </li>

                                    <li><label class="form">Gambar Bukti Pembayaran</label>
                                      <div class="Uploadbtn" >
                                        <img id="myImg" src="#" style="float:center; max-width:200px; max-height: 80px"  alt="" /> </br>                                
                                        <span>Drag gambar anda atau </br>click area ini.</span>
                                        <input type="file" name="userfile" class="input-upload"/>
                                      </div>

                                          <?php
                                          if (isset($error)){
                                              echo "<div class='error'>$error</div></br>";
                                          }?> 

                                    </li>
                                    </ul>

                                    <button  type="submit" name="submit" class="button btn-2 btn-2a">Submit</button>

                                   
                  </div>    
              </form>
          </center>
                             <?php form_close(); ?>                           
</div> 
<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="../../assets/js/jquery-2.1.4.min.js"></script>
<script src="../../assets/datepicker/js/datepicker.js"></script>
<script src="../../assets/datepicker/js/i18n/datepicker.en.js"></script>

<script type="text/javascript">

$(document).ready(function () {
    $("#start_date").datepicker({
        dateFormat: 'yyyy-mm-dd',
        language: 'en',
        position: 'top center',        
        //minDate : new Date(),
        onSelect: function (selected) {
            var min = new Date(selected);
            var to = $('#end_date').datepicker().data('datepicker');
            to.update('minDate', min);
        }
    });
    
    $("#end_date").datepicker({ 
        dateFormat: 'yyyy-mm-dd',
        language: 'en',
        position: 'top center',
        minDate : new Date(),     
        onSelect: function (selected) {
            var max = new Date(selected);
            var from = $('#start_date').datepicker().data('datepicker');
            from.update('maxDate', max);
        }
    });
});

</script>
 

<script type="text/javascript">
    $(document).ready(function(){
  $('form input').change(function () {    
    $('form span').text(this.files.length + " file terpilih");
     if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
  });
});

function imageIsLoaded(e) {
    $('#myImg').attr('src', e.target.result);
};
</script>



 <script >
  var myselect = document.getElementById('myselect');

function createOption() {
    var currentText = document.getElementById('mytext').value;
    var objOption = document.createElement("option");
    objOption.text = currentText;
    objOption.value = currentText;

    //myselect.add(objOption);
    myselect.options.add(objOption);
}


myselect.onchange = function() {
    var mytextfield = document.getElementById('mytext');
    if (myselect.value == 'Free'){
        mytextfield.disabled = true;
    }else {
        mytextfield.disabled = false;
    }
}
 </script>




<script type="text/javascript">
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>

