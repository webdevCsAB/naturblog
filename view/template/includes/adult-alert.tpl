<?php 

// Adult Content Alert

?>
<?php if($adultContent): ?>

<section class="adultAlert" id="adultAlert">
  <div class="adultContent">

    <div class="adultContentIcon"><?php echo trim($adultContent); ?></div>

    <h1><?php echo txt("txt_adult_content"); ?></h1>
    <hr>
    <h2 class="txuc"><strong><?php echo txt("txt_adult_content_question"); ?></strong></h2>
    <h3><?php echo txt("txt_adult_content_on_this_page"); ?></h3>
    <p>
      <br><a href="javascript:;" id="applyAdult" class="yes btn btn-lg">&#10004;&nbsp;<?php echo txt("lbl_button_yes"); ?></a>
      <a href="/" class="declineAdult no btn btn-lg">×&nbsp;<?php echo txt("lbl_button_no"); ?></a>
    </p>
  </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    if(typeof(sessionStorage) != 'undefined') {
      if(sessionStorage.adultAlert) {
          document.getElementById("adultAlert").style.display = "none";
      }
      document.getElementById("applyAdult").addEventListener("click", function() {
          document.getElementById("adultAlert").style.display = "none";
          sessionStorage.adultAlert = 1;
      });
    }
});
</script>

<?php endif; ?>