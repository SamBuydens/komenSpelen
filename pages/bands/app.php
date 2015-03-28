<div class="container">

</div>
<script type="text/javascript">
	window.user_id = <?php echo $_SESSION['bandUser']['id']; ?>;
	<?php
		if(!empty($_SESSION['inviteCode'])){
			echo "window.invite_code = \"{$_SESSION['inviteCode']}\";";
		}
		/*if(!empty($_SESSION['bandbattleId'])){
			echo "window.invite_bbid = {$_SESSION['bandbattleId']};";
		}*/
	?>
</script>
<script src="js/vendor/jquery.min.js"></script>
<script src="js/vendor/moment.min.js"></script>
<script src="js/vendor/underscore.min.js"></script>
<script src="js/vendor/backbone.min.js"></script>
<script src="js/app.js"></script>