<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if(!isset($_POST['Submit']))
{
?>
<form action="" name="curl_init" id="curl_init" method="POST" target="curl_init" enctype="multipart/form-data" >
	<table width="100%" border=0 cellpadding="4" cellspacing="2" class="body">
		<tr bgcolor=#f0f0f0>
			<td valign="middle" width="20%">action</td>
			<td><input type="text" name="action" value="<?=@$_SESSION['CURLOPT_ACTION'];?>" size=40></td>
		</tr>
		<tr>
			<td valign="top" align="left" colspan=2>
				<textarea name="CURLOPT_POSTFIELDS" style="width: 100%;border: 1px solid #ccc;" rows=5 placeholder="variable to post, separate by = and [enter] or & for multiple variables"><?=@htmlentities($_SESSION['CURLOPT_POSTFIELDS']);?></textarea>
			</td>
		</tr>
		<tr>
			<td>OUTPUT</td>
			<td>
				<label><input type="checkbox" name="is_plain" value="1" checked> Text Plain</label>
				<label><input type="checkbox" name="is_debug" value="1" checked> Debug</label>
			</td>
		</tr>
		<tr>
			<td>CURLOPT_REFERER</td>
			<td><input type="text" name="CURLOPT_REFERER" value="" size=40></td>
		</tr>
		<tr>
			<td>CURLOPT_USERAGENT</td>
			<td><input type="text" name="CURLOPT_USERAGENT" value="<?=@$_SERVER['HTTP_USER_AGENT'];?>" size=40></td>
		</tr>
		<tr>
			<td>CURLOPT_HTTPHEADER</td>
			<td>
				<textarea name="CURLOPT_HTTPHEADER" style="width: 100%;border: 1px solid #ccc;" rows=3>Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5
Accept-Language: en-us,en;q=0.5
Accept-Encoding: gzip,deflate
Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7
Keep-Alive: 300
Connection: keep-alive
Content-Type: application/x-www-form-urlencoded</textarea>
			</td>
		</tr>
		<tr>
			<td>CURLOPT_FOLLOWLOCATION</td>
			<td><input type="checkbox" name="CURLOPT_FOLLOWLOCATION" value="1"></td>
		</tr>
		<tr>
			<td>CURLOPT_COOKIEFILE</td>
			<td><input type="text" name="CURLOPT_COOKIEFILE" value="_COOKIEFILE" size=40></td>
		</tr>
		<tr>
			<td>CURLOPT_COOKIEJAR</td>
			<td><input type="text" name="CURLOPT_COOKIEJAR" value="_COOKIEFILE" size=40></td>
		</tr>
		<tr>
			<td colspan=2>
				<input type=submit name="Submit" value="Submit">
			</td>
		</tr>
	</table>
</form>
<?php
}else{
	if (!preg_match('~^(?:ht|f)tps?://~is', $_POST['action'])) {
		$_POST['action'] = 'http://'.$_POST['action'];
	}
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
	$_SESSION['CURLOPT_POSTFIELDS'] = $_POST['CURLOPT_POSTFIELDS'];
	$_SESSION['CURLOPT_ACTION'] = $_POST['action'];
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
  , 'CURLOPT_USERAGENT'     => 'Mozilla/5.0 (Linux; U; Android 2.1; en-us; Nexus One Build/ERD62) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17'
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