<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$sys->stop(false);
?>
<form action="" method="POST" role="form">
	<div class="form-group">
		<label>Words and SALT (if any)</label>
		<div class="form-inline">
			<input type="text" name="words" value="<?php echo @$_POST['words'];?>" class="form-control form-inline" placeholder="Insert text">
			<input type="text" name="salt" value="<?php echo @$_POST['salt'];?>" class="form-control form-inline" placeholder="Insert _SALT if any">
		</div>
	</div>
	<button type="submit" name="Submit" value="encrypt" class="btn btn-info">Encrypt</button>
	<button type="submit" name="Submit" value="decrypt" class="btn btn-warning">Decrypt</button>
	<?php
	if(isset($_POST['Submit']))
	{
		?>
		<br />
		<br />
		<div class="form-group">
		<?php
		if($_POST['Submit']=='encrypt')
		{
			echo '<label>Encrypted :</label>';
			echo "<textarea class=\"form-control\">".encode($_POST['words'], $_POST['salt'])."</textarea>";
		}else{
			echo '<label>Decrypted :</label>';
			echo "<textarea class=\"form-control\">".decode($_POST['words'], $_POST['salt'])."</textarea>";
		}
		?>
		</div>
		<?php
	}
	?>
</form>
