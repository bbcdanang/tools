<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$sys->stop(false);
?>
<form action="https://api.whatsapp.com/send" method="GET" class="form-inline" role="form" id="whatsapp-form" enctype="multipart/form-data">
	<div class="form-group">
		<label class="sr-only" for="">Phone</label>
		<input type="text" name="phone" class="form-control" value="62818550122" id="phone" placeholder="Masukkan nomot whatsapp">
	</div>
	<button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
<script type="text/javascript">
	_Bbc(function($){
		$("#phone").get(0).focus();
		$("#whatsapp-form").on("submit", function(e){
			e.preventDefault();
			var wa = window.open($(this).attr("action")+"?phone="+$("#phone").val(), "_blank", "menubar=no,location=no,resizable=no,scrollbars=no,status=no");
			$(wa.document).ready(function(){
				wa.setTimeout(function(wa){
					alert("danang");
					// wa.close();
				}, 500, wa);
			})
			// wa.close();
		});
	});
</script>