<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$output = array(
	'ok'   => 0,
	'data' => array(),
	'msg'  => 'silahkan postingkan "client_str" dan "client_enc" atau "client_str" dan "client_dec" ke URL ini untuk di check enkripsi anda sudah sama atau belum'
);
if (!empty($_POST['client_str']))
{
	extract($_POST);
	if (!empty($_POST['client_enc']))
	{
		$here_str = _class('crypt')->decode($client_enc);
		$here_enc = _class('crypt')->encode($client_str);
		$output   = array(
			'ok'   => ($here_str==$client_str) ? 1 : 0,
			'data' => array(
				'client' => array(
					'str' => $client_str,
					'enc' => $client_enc
				),
				'server' => array(
					'str' => $here_str,
					'enc' => $here_enc
				)
			)
		);
	}else
	if (isset($_POST['client_dec']))
	{
		$here_str = $client_str;
		$here_dec = _class('crypt')->decode($client_str);
		$output   = array(
			'ok'   => ($here_dec==$client_dec) ? 1 : 0,
			'data' => array(
				'client' => array(
					'str' => $client_str,
					'dec' => $client_dec
				),
				'server' => array(
					'str' => $here_str,
					'dec' => $here_dec
				)
			)
		);
	}
}
output_json($output);