<?php 
$is_logged_in=$this->session->userdata('is_logged_in');
$level=$this->session->userdata('level');
if($is_logged_in == true && $level != 'admin' ) { ?>

 <style type="text/css">

 * {
  box-sizing: border-box;
}
 
html,
body {
  font-family: 'Roboto', sans-serif;
}

 a.button-1 {
    text-decoration: none;
    color: #fff;
  }


 .button-1{
 padding: 10px; 
 max-width: 90px;
text-align:center;
text-decoration: none;
font-family: sans-serif;
-webkit-font-smoothing: antialiased;
color: #FFF;
background: #4ebeea;
display: inline-block;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
-webkit-transition: all 0.2s ease-in-out;
-ms-transition: all 0.2s ease-in-out;
-moz-transition: all 0.2s ease-in-out;
-o-transition: all 0.2s ease-in-out;
transition: all 0.2s ease-in-out;
}
.button-1:hover {
background: #44add6;
}

.button-2{
float: left;
padding: 8px; 
max-width: 300px;
text-align:center;
text-decoration: none;
font-family: sans-serif;
-webkit-font-smoothing: antialiased;
color: #FFF;
background: #1e9490;
display: inline-block;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
-webkit-transition: all 0.2s ease-in-out;
-ms-transition: all 0.2s ease-in-out;
-moz-transition: all 0.2s ease-in-out;
-o-transition: all 0.2s ease-in-out;
transition: all 0.2s ease-in-out;
}
.button-2:hover {
background: #1e9490;
}

.proses{
padding: 8px; 
max-width: 300px;
text-align:center;
text-decoration: none;
font-family: sans-serif;
-webkit-font-smoothing: antialiased;
color: #FFF;
background: #a8e340;
display: inline-block;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
-webkit-transition: all 0.2s ease-in-out;
-ms-transition: all 0.2s ease-in-out;
-moz-transition: all 0.2s ease-in-out;
-o-transition: all 0.2s ease-in-out;
transition: all 0.2s ease-in-out;
}
.proses:hover {
background: #98d231;
}

.clearall{
padding: 8px; 
max-width: 300px;
text-align:center;
text-decoration: none;
font-family: sans-serif;
-webkit-font-smoothing: antialiased;
color: #FFF;
background: #ee6767;
display: inline-block;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
-webkit-transition: all 0.2s ease-in-out;
-ms-transition: all 0.2s ease-in-out;
-moz-transition: all 0.2s ease-in-out;
-o-transition: all 0.2s ease-in-out;
transition: all 0.2s ease-in-out;
}
.clearall:hover {
background: #e54c4c;
}

.shopping-cart {
  max-width: 750px;
  margin: 80px auto;
  background: #ffffff;
  box-shadow: 1px 2px 3px 0px rgba(0,0,0,0.10);
  border-radius: 6px; 
  display: flex;
  flex-direction: column;
}

.title {
  height: 60px;
  border-bottom: 1px solid #E1E8EE;
  padding: 20px 30px;
  color: #5E6977;
  font-size: 18px;
  font-weight: 400;
}

.totalorder {
  text-align: right;
  height: 60px;
  padding: 20px 30px;
  color: #5E6977;
  font-size: 18px;
  font-weight: 400;
}

.tombol {
  padding: 20px 30px;
  color: #5E6977;
  font-size: 18px;
  font-weight: 400;
}
 
.item {
  padding: 20px 30px;
  display: flex;
  border-bottom:  1px solid #E1E8EE;
}
 
.buttons {
  position: relative;
  padding-top: 30px;
  margin-right: 40px;
}
.delete-btn,
.like-btn {
  display: inline-block;
  Cursor: pointer;
}
.delete-btn:before {
  content: '\f00d';
  font-family: FontAwesome;
  width: 18px;
  height: 17px;
  margin-right: 60px;
  background: url("delete-icn.svg") no-repeat center;
}
 
.like-btn {
  position: absolute;
  top: 9px;
  left: 15px;
  background: url('twitter-heart.png');
  width: 60px;
  height: 60px;
  background-size: 2900%;
  background-repeat: no-repeat;
}

.is-active {
  animation-name: animate;
  animation-duration: .8s;
  animation-iteration-count: 1;
  animation-timing-function: steps(28);
  animation-fill-mode: forwards;
}
 
@keyframes animate {
  0%   { background-position: left;  }
  50%  { background-position: right; }
  100% { background-position: right; }
}

.image {
  margin-right: 50px;
}
 
.description {
  padding-top: 20px;
  margin-right: 30px;
  min-width: 120px;
  max-width: 120px;
  margin-bottom: 20px;
}
 
.description span {
text-align: left;
  display: block;
  font-size: 14px;
  color: #43484D;
  font-weight: 400;
}
 

.quantity {
  width: 50px;
  height: 50px;
  color: #ddd;
  font-size: 16px;
  font-weight: 300;
  text-align: center;
  padding-top: 10px;
  margin-right: 60px;
}
.quantity input {
  -webkit-appearance: none;
  border: none;
  text-align: center;
  width: 32px;
  font-size: 16px;
  color: #43484D;
  font-weight: 300;
}
 
button[class*=btn] {
  width: 30px;
  height: 30px;
  background-color: #E1E8EE;
  border-radius: 6px;
  border: none;
  cursor: pointer;
}
.minus-btn img {
  margin-bottom: 3px;
}
.plus-btn img {
  margin-top: 2px;
}
 
button:focus,
input:focus {
  outline:0;
}

.total-price {
  min-width: 120px;
  max-width: 120px;
  padding-top: 27px;
  text-align: center;
  font-size: 16px;
  color: #43484D;
  font-weight: 300;
  margin-right: 40px;
}

@media (max-width: 800px) {
  .shopping-cart {
    width: 100%;
    height: auto;
    overflow: hidden;
  }
  .item {
    height: auto;
    flex-wrap: wrap;
    justify-content: center;
  }
  .image img {
    width: 50%;
  }
  .image,
  .quantity,
  .description {
    width: 100%;
    text-align: center;
    margin: 6px 0;
  }
  .buttons {
    margin-right: 20px;
  }
}


  </style>


<div class="wrapper style1">
<div  class="container" style="margin-top: -30px">

	<div class="shopping-cart">
      <!-- Title -->
      <div class="title">
       Keranjang Pemesanan
      </div>
 		<?php
 		if ($cart = $this->cart->contents()):
		echo form_open('cart/update_cart');
		$grand_total = 0; 
		
		foreach ($cart as $item):
			echo form_hidden('cart['. $item['id'] .'][id]', $item['id']);
			echo form_hidden('cart['. $item['id'] .'][rowid]', $item['rowid']);
			echo form_hidden('cart['. $item['id'] .'][name]', $item['name']);
			echo form_hidden('cart['. $item['id'] .'][price]', $item['price']);
			echo form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);
		// Prep the price.  Remove anything that isn't a number or decimal point.
        $item['price'] = trim(preg_replace('/([^0-9\.])/i', '', $item['price']));
        // Trim any leading zeros
        $item['price'] = trim(preg_replace('/(^[0]+)/i', '', $item['price']));
		?>
      <!-- Product #1 -->
      <div class="item">
        <div class="buttons">
          <a class="delete-btn" href="<?php echo site_url('cart/remove/'.$item['rowid'])?>"></a>
        </div>

        <div class="description">
          <span><?php echo $item['name']; ?></span>
        </div>
 
        <div class="total-price">
        Rp. <?php $item['price'] = floatval($item['price']);
				echo number_format($item['price'],2); ?>
        </div>
 
        <div class="quantity">
        <?php echo form_input('cart['. $item['id'] .'][qty]', $item['qty'], 'maxlength="3"  size="1" '); ?>
        </div>

        <div class="total-price">
        <?php $grand_total = $grand_total + $item['subtotal']; ?>
        Rp. <?php echo number_format($item['subtotal'],2) ?>
        </div>

      </div>
 	<?php endforeach; ?>
 	 <div class="totalorder">   
 	Total : Rp.<?php echo number_format($grand_total,2); ?>
      </div> 
      <div class="tombol">      		
	  <a class="button-2" href="<?php echo site_url('home')?>">Cari Event Lain</a>    
      <a class="clearall" href="<?php echo site_url('cart/remove/all')?>"><h2 class="feature">Clear All</h2></a>
	  <button  type="submit" name="submit" class="button-1"><h2 class="feature">Update</h2></button>	
	  <a class="proses" href="<?php echo site_url('order/proceed')?>"><h2 class="feature">Proses</h2></a> 
		</div>
	<?php echo form_close(); ?>
	<?php else: ?>
          
                <div style="margin-top: 30px">
                    <h3>Keranjang Anda Kosong !</h3>
                </div>
		<?php endif; ?>
    </div>

	</div>
</div>



<?php } else {
    redirect('home'); }?> 
