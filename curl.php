<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$sys->stop(false);
$sys->set_layout('blank');
if(!isset($_POST['Submit']))
{
	?>
	<form action="" method="POST" id="curl_init" class="form-horizontal" role="form">
	<div class="panel panel-default">
	  <div class="panel-body">
			<div class="form-group">
				<input type="text" name="action" value="<?php echo @$_SESSION['CURLOPT_ACTION']; ?>" class="form-control" label="Insert target URL" />
			</div>
			<div class="form-group">
				<textarea name="CURLOPT_POSTFIELDS" rows="3" class="form-control" placeholder="variable to post, separate by = and [enter] or & for multiple variables"><?php echo htmlentities($_SESSION['CURLOPT_POSTFIELDS']);?></textarea>
			</div>
			<div class="form-group">
				<div class="btn-group" data-toggle="buttons">
				  <label class="btn btn-default active">
				    <input type="checkbox" name="is_plain" value="1" id="is_plain" checked /> Text Plain
				  </label>
				  <label class="btn btn-default">
				    <input type="checkbox" name="is_debug" value="1" /> Debug
				  </label>
				  <label class="btn btn-default" id="follow">
				    <input type="checkbox" name="CURLOPT_FOLLOWLOCATION" value="1" /> Follow Location
				  </label>
				</div>
			</div>
			<div class="form-group follow">
				<label>CURLOPT_REFERER</label>
				<input type="text" name="CURLOPT_REFERER" value="" class="form-control" />
			</div>
			<div class="form-group">
				<label>CURLOPT_USERAGENT</label>
				<input type="text" name="CURLOPT_USERAGENT" value="<?php echo @$_SESSION['CURLOPT_USERAGENT']; ?>" class="form-control" />
			</div>
			<div class="form-group">
				<label>CURLOPT_HTTPHEADER</label>
				<textarea name="CURLOPT_HTTPHEADER" rows="2" class="form-control"><?php echo htmlentities(implode("\n", (array)@$_SESSION['CURLOPT_HTTPHEADER']));?></textarea>
			</div>
			<div class="form-group follow">
				<label>CURLOPT_COOKIEFILE</label>
				<input type="text" name="CURLOPT_COOKIEFILE" value="_COOKIEFILE" class="form-control" />
			</div>
			<div class="form-group follow">
				<label>CURLOPT_COOKIEJAR</label>
				<input type="text" name="CURLOPT_COOKIEJAR" value="_COOKIEFILE" class="form-control" />
			</div>
			<button type="submit" class="btn btn-lg btn-default">Submit</button>
	  </div>
	</div>
	</form>
	<div id="curl_output"></div>
	<div id="loading">Loading...</div>
	<script type="text/javascript">
	_Bbc(function($){
		$(".follow").hide();
		$("#follow").on("click", function(){
			if($("input", $(this)).is(":checked")) {
				$(".follow").hide("slow");
			}else{
				$(".follow").show("slow");
			}
		});
			$(document).ajaxStart(function(){
				$("#loading").show();
			}).ajaxStop(function(){
				$("#loading").hide();
			});
		$('#curl_init').on("submit", function(e){
			e.preventDefault();
			var a = $(this).serialize()+"&Submit=1";
			$.ajax({
			  url: document.location.href,
			  method: "post",
			  data: a
			}).done(function(data) {
				if ($("#is_plain").is(":checked")) {
					data = "<pre>"+data+"</pre>";
				};
				$("#curl_output").html(data);
			});
		});
	});
	</script>
	<?php
}else{
	if (!preg_match('~^(?:ht|f)tps?://~is', $_POST['action'])) {
		$_POST['action'] = 'http://'.$_POST['action'];
	}
	$_SESSION['CURLOPT_HTTPHEADER'] = $_POST['CURLOPT_HTTPHEADER'];
	$_SESSION['CURLOPT_POSTFIELDS'] = $_POST['CURLOPT_POSTFIELDS'];
	$_SESSION['CURLOPT_ACTION'] = $_POST['action'];
	if(!empty($_POST['CURLOPT_POSTFIELDS']))
	{
    $r = explode("\n", preg_replace("~\n{2,}~is", "\n", str_replace("\r", "\n",$_POST['CURLOPT_POSTFIELDS'])));
    $ar= array();
    foreach((array)$r AS $d)
    {
    	if (!empty($d)) {
    		$r1 = explode('&', $d);
    		foreach ($r1 as $d1) {
    			if (!empty($d1)) {
			      if(preg_match('~^([^=]+)=(.*?)$~is', $d1, $m))
			      {
			        $ar[$m[1]] = $m[2];
			      }
    			}
    		}
    	}
    }
		$_POST['CURLOPT_POSTFIELDS'] = $ar;
	}else{
		$_POST['CURLOPT_POSTFIELDS'] = array();
	}
	if(!empty($_POST['CURLOPT_HTTPHEADER']))
	{
		$_POST['CURLOPT_HTTPHEADER'] = explode("\n", $_POST['CURLOPT_HTTPHEADER']);
	}else{
		$_POST['CURLOPT_HTTPHEADER'] = array();
	}
	$url = $_POST['action'];
	if (!empty($_POST['is_plain']))
	{
		header("Content-Type: text/plain");
	}
	$debug = !empty($_POST['is_debug']) ? true : false;
	$option = $_POST;
	unset($option['action'], $option['Submit'], $option['is_plain'], $option['is_debug']);
	$out = curl($url, $_POST['CURLOPT_POSTFIELDS'], $option, $debug);
	if (!$debug) {
		echo $out;
	}
	die();
}
/* $param == (int)cache in second | (array)POST Fields*/
function curl($url, $param=array(), $option=array(), $is_debug = true)
{
	if(!preg_match('~^(?:ht|f)tps?://~', $url) && file_exists($url))
	{
		return file_get_contents($url);
	}else{
		if(!preg_match('~^(?:ht|f)tps?://~', $url)) {
			$url = 'http://'.$url;
		}
	}
	$temp = '/tmp/curl';
	if(is_numeric($param))
	{
		$text			= unserialize(curl($temp.'_'.md5($url)));
		if(!empty($text[0]) && $text[0] > time())
		{
			return @$text[1];
		}
		$presists	= intval($param);
		$param		= array();
	}else $presists	= 0;
  $default = array(
    'CURLOPT_REFERER'       => !empty($_SESSION['CURLOPT_REFERER']) ? $_SESSION['CURLOPT_REFERER'] : $url
  , 'CURLOPT_POST'          => empty($param) ? 0 : 1
  , 'CURLOPT_POSTFIELDS'    => $param
  , 'CURLOPT_USERAGENT'     => @$_SERVER['HTTP_USER_AGENT']
  , 'CURLOPT_HEADER'        => 1
  , 'CURLOPT_HTTPHEADER'    => array(
		  'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8'
		, 'Accept-Language: en-US,en;q=0.5'
		, 'Accept-Encoding: gzip, deflate'
		, 'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7'
		, 'Keep-Alive: 300'
		, 'Connection: keep-alive'
		, 'Content-Type: application/x-www-form-urlencoded')
  , 'CURLOPT_FOLLOWLOCATION'=> 0
  , 'CURLOPT_RETURNTRANSFER'=> 1
  , 'CURLOPT_COOKIEFILE'    => $temp
  , 'CURLOPT_COOKIEJAR'     => $temp
  );
  foreach ($option as $key => $value) {
  	if (empty($value) && $value!='0') {
  		unset($option[$key]);
  	}
  }
  $data = array_merge($default, $option);
  $data['CURLOPT_POST'] = empty($data['CURLOPT_POSTFIELDS']) ? 0 : 1;

  if($data['CURLOPT_POST']) {
  	$data['CURLOPT_POSTFIELDS'] = http_build_query($data['CURLOPT_POSTFIELDS']);
  }else unset($data['CURLOPT_POSTFIELDS']);

  // $data['CURLOPT_HTTPHEADER'] = array_map('urlencode', $data['CURLOPT_HTTPHEADER']);
  $data['CURLOPT_HTTPHEADER'] = $data['CURLOPT_HTTPHEADER'];

  if (ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off')) {
  }else unset($data['CURLOPT_FOLLOWLOCATION']);

  if(strtolower(substr($url, 0, 5)) == 'https') {
  	$data['CURLOPT_FOLLOWLOCATION'] = 0;
  	$data['CURLOPT_SSL_VERIFYHOST'] = 0;
  }

  $init = curl_init( $url );
  foreach ($data as $key => $value) {
  	curl_setopt($init, constant($key), $value);
  }
	$out  = curl_exec($init);
	$info = curl_getinfo($init);
	if (!empty($info['header_size'])) {
		$header = substr($out, 0, $info['header_size']);
		$output = substr($out, $info['header_size']);
	}else{
		$header = '';
		$output = $out;
	}
  if (!empty($info['redirect_url'])) {
  	$_SESSION['CURLOPT_REFERER'] = $info['redirect_url'];
  }else{
	  $_SESSION['CURLOPT_REFERER'] = $url;
  }
  if ( $is_debug )
  {
  	$debug = array('url' => $url);
  	if(!empty($data['CURLOPT_POSTFIELDS']))
  	{
  		$debug['params'] = htmlentities($data['CURLOPT_POSTFIELDS']);
  	}
    $a = curl_errno( $init );
    if(!empty($a))
    {
    	$debug['ErrNum'] = $a;
    }
    $a = curl_error( $init );
    if(!empty($a))
    {
    	$debug['ErrMsg'] = $a;
    }
    if(empty($debug))
    {
    	echo $output;
    }else{
	    $debug['info']   = $info;
	    $debug['header'] = $header;
	    $debug['output'] = $output;
	    if (!empty($_POST['is_plain'])) {
		    print_r($debug);
	    }else{
	    	echo '<pre>'.print_r($debug, 1).'</pre>';
	    }
    }
  }
  curl_close($init);
  if($presists > 0 && !empty($output))
  {
		if ( $fp = @fopen($temp.'_'.md5($url), 'w+'))
		{
			flock($fp, LOCK_EX);
			fwrite($fp, serialize(array(strtotime('+'.$presists.' SECOND'), $output)));
			flock($fp, LOCK_UN);
			fclose($fp);
		}
  }
  return $output;
}