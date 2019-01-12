<?php 
$is_logged_in=$this->session->userdata('is_logged_in');
$level=$this->session->userdata('level');
if($is_logged_in == true && $level == 'event_creator' ) { ?>

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

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAUR3YoOkjOsw6L86CS2yxIo79DcGg4HN8&libraries=places&region=id" type="text/javascript"></script>

<script type="text/javascript">
   function initialize() {
      var input = document.getElementById('location');
      var autocomplete = new google.maps.places.Autocomplete(input);
   }
   google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script>
google.maps.event.addDomListener(window, 'load', initialize);
function initialize() {
var input = document.getElementById('lo');
var autocomplete = new google.maps.places.Autocomplete(input);
autocomplete.addListener('place_changed', function () {
var place = autocomplete.getPlace();
// place variable will have all the information you are looking for.
console.log(place.geometry['location'].lat());
console.log(place.geometry['location'].lng());
});
}
</script>

<script type="text/javascript">
   function initialize() {
      var input = document.getElementById('city');
      var autocomplete = new google.maps.places.Autocomplete(input);
   }
   google.maps.event.addDomListener(window, 'load', initialize);
</script>





<div class="wrapper style1">
                            </br>

                            <h1>Create Event</h1>    

                            <center>
                             <p class="title-heading">Anda dapat membuat Event disini dengan melengkapi seluruh data yang dibutuhkan.</p>
                            
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
                            
                            
                            <?php echo form_open_multipart('event_creator/add_event'); ?>
                            <form action="<?php echo site_url('event_creator/add_event/');?>" method="post">
                  <div class="wrappercolumn"> 
                               <div class="col"> 
                               <ul>
                                    <li>
                                    <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ; ?>"  />
                                    </li>

                                    <li>
                                    <label class="form">Judul Event</label>
                                    <input type="text" name="title" placeholder="Maksimal 75 karakter." value="<?php echo set_value('title'); ?>"  />
                                        <div class="errorval"><?php echo form_error('title'); ?></div>
                                    </li>

                                    <li>
                                    <label class="form">Kota diselenggarakan</label>
                                        <input type="text" name="city"  placeholder="Nama Kota." value="<?php echo set_value('city'); ?>"/>
                                        <div class="errorval"><?php echo form_error('city'); ?></div>
                                    </li>

                                    <li>
                                     <label class="form">Lokasi diselenggarakan</label>
                                        <input type="text" name="location" id="location" autocomplete="on" placeholder="Lokasi event. ex: Gedung" value="<?php echo set_value('location'); ?>"  />
                                        <div class="errorval"><?php echo form_error('location'); ?></div>
                                    </li>

                                    <li>
                                     <label class="form">Tanggal Mulai</label> 
                                        <input type="date" id="start_date"   name="start_date"  placeholder="Tanggal Mulai" value="<?php echo set_value('start_date'); ?>"    onkeypress="return isNumberKey(event)"
                                         />
                                        <div class="errorval"><?php echo form_error('start_date'); ?></div>
                                    </li>

                                    <li>
                                     <label class="form">Tanggal Berakhir</label>
                                        <input type="date" id="end_date"   name="end_date"  placeholder="Tanggal Berakhir" value="<?php echo set_value('end_date'); ?>" onkeypress="return isNumberKey(event)"
                                         />
                                        <div class="errorval"><?php echo form_error('end_date'); ?></div>
                                    </li>
                                    </ul>
                                </div>


                                <div class="col" >
                                <ul>
                                    <li>
                                    <label class="form">Tipe Event</label>
                                    <select id="myselect" name="type" class="form-control" style="margin-bottom:12px">
                                    <option style="display:none;" value="" disabled selected>Tipe Event </option>
                                        <option value="Free"<?php echo set_select('type','Free', ( !empty($data) && $data == "Free" ? TRUE : FALSE )); ?>>Free</option>
                                        <option value="Paid"<?php echo set_select('type','Paid', ( !empty($data) && $data == "Paid" ? TRUE : FALSE )); ?>>Paid</option>
                                    </select>
                                    <div class="errorval"><?php echo form_error('type'); ?></div>
                                    </li>


                                    <li>
                                     <label class="form">Harga</label>
                                        <input  type="text" name="price" placeholder="Harga Tiket Untuk Tipe Paid" value="<?php echo set_value('price'); ?>" onkeypress="return isNumberKey(event)" id="mytext" disabled="disabled" />
                                    </li>


                                    <li>
                                     <label class="form">Kapasitas</label>
                                    <input type="text" name="capacity" placeholder="Kuota Peserta" value="<?php echo set_value('capacity'); ?>" onkeypress="return isNumberKey(event)" />
                                    </li>
                                    <div class="errorval"><?php echo form_error('capacity'); ?></div>

                                    <input type="hidden" name="status" value="Tunggu Validasi"  />



                                    <li>
                                    <label class="form">Kategori</label>
                                    <select name="category_id" value="<?php echo set_value('category_id'); ?>" style="margin-bottom:12px">
                                    <option style="display:none;" value="" disabled selected>Kategori</option>
                                    <?php                  
                                         
                                        $categories=$this->category_model->get_paged_list()->result();
                                        $data['categories']=$categories;
                                        //$selected="";
                                         foreach($categories as $category){?>
                                         <option value="<?=$category->category_id?>"  
                                         <?php echo set_select('category_id',$category->category_id, ( !empty($data) && $data == ".$category->category_id." ? TRUE : FALSE )); ?>><?=$category->name?></option>
                                    
                                    <?php  } ?>
                                     
                                    </select>
                                    <div class="errorval"><?php echo form_error('category_id'); ?>
                                    </div>
                                    </li>
                                    </ul>
                            </div>

                            <div class="col" >
                                  <ul>
                                    <li>
                                     <label class="form">Deskripsi</label>
                                        <textarea type="text" style="" name="description" placeholder="Deskripsikan event anda dan waktu penyelenggaraan secara jelas" value=""  /><?php echo set_value('description'); ?></textarea>
                                        <div class="errorval"><?php echo form_error('description'); ?></div>
                                    </li>

                                    <li><label class="form">Gambar / Poster Event</label>
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
                          </div>
                          <div class="colcen">
                                  <ul>
                                  <li><div class="10u 12u(mobile)">
                                    <div class="squaredFour" style="float:left; margin-top: 10px; padding: 5px; ">
                                        <input type="checkbox" required value="None" id="squaredFour" name="check" /><label for="squaredFour"></label>
                                    </div>
                                    <div style="text-align: left; margin-left: 45px;">
                                        <p >Dengan mencentang ini berarti anda telah membaca dan menyetujui <a target="_blank" href="<?php echo site_url( 'home/syarat_ketentuan', '' );?>">Syarat & Ketentuan</a> yang berlaku. </p>
                                    </div></div>
                                    </li>
                                        <button  type="submit" name="submit" class="button btn-2 btn-2a">Submit</button>
                                    </ul>
                          </div>                           
                      </ul>
                  </div>    
              </form>
          </center>
                             <?php form_close(); ?>                           
</div> 
<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="../assets/js/jquery-2.1.4.min.js"></script>
<script src="../assets/datepicker/js/datepicker.js"></script>
<script src="../assets/datepicker/js/i18n/datepicker.en.js"></script>

<script type="text/javascript">

$(document).ready(function () {
    $("#start_date").datepicker({
        dateFormat: 'yyyy-mm-dd',
        language: 'en',
        position: 'top center',        
        minDate : new Date(),
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






<?php } else {
    redirect('home'); }?> 

