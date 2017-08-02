<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="wrapper">
  <?php $this->view('frontend/includes/header'); ?>
  <div class="example-animation">
    <div data-lazy-background="<?= imagePath('assets/frontend/images/inner-bnr.jpg','',1286,193); ?>">
      <h3 data-pos="['27%', '110%', '27%', '40%']" data-duration="1500" data-effect="move">BUSINESS PLAN</h3>
    </div>
  </div>
  <div class="clear"></div>
  <div class="textsec">
    <div class="container">
      <div class="attorny-sec">
        <div class="container">
          <ul class="reset">         
              <li><img src="<?= imagePath('assets/frontend/images/msi/business_plan.jpg','',624,0); ?>"/></li>         
              <li><img src="<?=base_url();?>timthumb.php?src=<?=base_url();?>assets/frontend/images/finance/1.jpg&w=600&q=99"/></li>     
              <li><img src="<?=base_url();?>timthumb.php?src=<?=base_url();?>assets/frontend/images/finance/2.jpg&w=600&q=99"/></li>       
              <li><img src="<?=base_url();?>timthumb.php?src=<?=base_url();?>assets/frontend/images/finance/3.jpg&w=600&q=99"/></li>
          </ul>
          <div class="clear"></div>
        </div>
      </div>
    </div>
  </div>
  <?php $this->view('frontend/includes/footer'); ?>
</div>
</div>
<script>
$(document).ready(function(){
  $('.bxslider').bxSlider();
});
</script>
</body></html>