<div class="container">

</div>
<?php
   setcookie("X-CSRF-Token", sha1(rand()));
?>
<script type="text/javascript">
	window.user_id = <?php echo $_SESSION['bandUser']['id']; ?>;
</script>
<script src="js/vendor/underscore.min.js"></script>
<script src="js/vendor/backbone.min.js"></script>
<script src="js/app.js"></script>