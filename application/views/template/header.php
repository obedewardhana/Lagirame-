<?php 
$is_logged_in=$this->session->userdata('is_logged_in');
$level=$this->session->userdata('level');
if($is_logged_in == true && $level == 'user_umum' ) { 
$cart =$this->cart->total_items(); 
?>
					


<li class="<?php if($this->uri->uri_string() == 'home') { echo 'active'; } ?>">
<a href="<?php echo site_url('home'); ?>" >Home</a>
 </li>
<li class="<?php if($this->uri->uri_string() == 'user_umum/my_account') { echo 'active'; } ?>">
<a href="<?php echo site_url('user_umum/my_account/'); ?>" >My Account</a>
 </li>
 <li class="<?php if($this->uri->uri_string() == 'cart') { echo 'active'; } ?>">
<a href="<?php echo site_url('cart'); ?>" >Cart <?php echo "(".$cart.")";?></a>
 </li>
<li class="<?php if($this->uri->uri_string() == 'user/logout/') { echo 'active'; } ?>">
<a href="<?php echo site_url('user/logout/'); ?>" >Logout</a>
 </li>

<?php } elseif($is_logged_in == true && $level == 'event_creator' ) {
	$cart =$this->cart->total_items(); ?>

<li class="<?php if($this->uri->uri_string() == 'home') { echo 'active'; } ?>">
<a href="<?php echo site_url('home'); ?>" >Home</a>
 </li>
<li class="<?php if($this->uri->uri_string() == 'event_creator/add_event') { echo 'active'; } ?>">
<a href="<?php echo site_url('event_creator/add_event/'); ?>" >Create Event</a>
 </li>
<li class="<?php if($this->uri->uri_string() == 'event_creator/my_account') { echo 'active'; } ?>">
<a href="<?php echo site_url('event_creator/my_account/'); ?>" >My Account</a>
 </li> 
 <li class="<?php if($this->uri->uri_string() == 'cart') { echo 'active'; } ?>">
<a href="<?php echo site_url('cart'); ?>" >Cart <?php echo "(".$cart.")";?></a>
 </li>
<li class="<?php if($this->uri->uri_string() == 'user/logout') { echo 'active'; } ?>">
<a href="<?php echo site_url('user/logout/'); ?>" >Logout</a>
 </li>

 <?php } elseif($is_logged_in == true && $level == 'admin' ) {?>

<li class="<?php if($this->uri->uri_string() == 'home') { echo 'active'; } ?>">
<a href="<?php echo site_url('home'); ?>" >Home</a>
 </li>
<li class="<?php if($this->uri->uri_string() == 'how_to') { echo 'active'; } ?>">
<a href="<?php echo site_url('how_to/'); ?>">How To Use?</a>
 </li>

 <?php }  else {?> 

<li class="<?php if($this->uri->uri_string() == 'home') { echo 'active'; } ?>">
<a href="<?php echo site_url('home'); ?>" >Home</a>
 </li>
<li class="<?php if($this->uri->uri_string() == 'createevent') { echo 'active'; } ?>">
<a href="<?php echo site_url('user/register/'); ?>" >Create Event</a>
 </li>
<li class="<?php if($this->uri->uri_string() == 'how_to') { echo 'active'; } ?>">
<a href="<?php echo site_url('how_to/'); ?>">How To Use?</a>
 </li>
<li class="<?php if($this->uri->uri_string() == 'user/register') { echo 'active'; } ?>">
<a href="<?php echo site_url('user/register/'); ?>" >Register</a>
 </li>
<li class="<?php if($this->uri->uri_string() == 'user/login') { echo 'active'; } ?>">
<a href="<?php echo site_url('user/login/'); ?>" >Login</a>
 </li>
 
 <?php }?>
<!--<div style="padding:5px; margin-top:10px; margin-left:15px">
<?php $logo = img('images/logo.png'); ?>
<?php echo anchor('home',$logo);?>
</div>-->
