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
          <div class="attorny-1 first-class" style="width: 700px;margin: 50 auto;padding:0px;">
              <img src="<?= imagePath('assets/frontend/images/finance/business_plan_1.jpg','',700,0); ?>"/>
          </div>
          <div class="attorny-1 first-class" style="width: 700px;margin: 50 auto;padding:0px;">
              <img src="<?= imagePath('assets/frontend/images/finance/business_plan_2.jpg','',700,0); ?>"/>
          </div>
          <div class="attorny-1 first-class" style="width: 700px;margin: 50 auto;padding:0px;">
              <img src="<?= imagePath('assets/frontend/images/finance/business_plan_3.jpg','',700,0); ?>"/>
          </div>
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