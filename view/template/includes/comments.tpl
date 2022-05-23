<?php 

// Commento Comment System
// https://docs.commento.io/

?>
<?php if(defined("COMMENTO_COMMENTS") && COMMENTO_COMMENTS): ?>

<div class="hidden-print" id="comments">

<hr>

<!-- <h2 class="muted"><?php echo txt('txt_comments'); ?></h2> //-->

<div id="commento"></div>
<script defer src="https://cdn.commento.io/js/commento.js"></script>

</div>

<?php endif; ?>