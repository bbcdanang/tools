<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>JavaScript Linter</title>

		<!-- Bootstrap CSS -->
		<link href="<?php echo _URL; ?>templates/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<?php
		if(empty($_POST['file_js']))
		{
			?>
			<form action="" method="POST" class="form" role="form" target="output">
				<div class="form-group">
					<div class="input-group">
						<input type="text" name="file_js" class="form-control" placeholder="JavaScript Path" />
						<div class="input-group-addon"><span class="glyphicon glyphicon-saved"></span></div>
					</div>
				</div>
			</form>
			<iframe src="" name="output" width="100%" height="600px" frameborder=0></iframe>
			<?php
		}else{
			$js = @$_POST['file_js'];
			if (is_file($js)) {
				$dir = __DIR__.'/js-linter';
				pr(htmlentities(shell_exec($dir.' -conf '.$dir.'.conf -process "'.$js.'"')));
			}else{
				echo msg('File not found: '.$js, 'danger');
			}
		}
		?>

		<script src="<?php echo _URL; ?>templates/admin/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>