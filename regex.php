<?php  if (!defined('_VALID_BBC')) exit('No direct script access allowed');

if(!isset($_POST['SUBMIT']))
{
?>
<SCRIPT LANGUAGE="JavaScript"><!--
function demoMatchClick()
{
	if(document.demoMatch.actionscript.value == '1')
	{
		return true;
	}else{
	  var re = new RegExp(document.demoMatch.regex.value);
	  if (document.demoMatch.subject.value.match(re)) {
	    alert("Successful match");
	  } else {
	    alert("No match");
	  }
	  return false;
  }
}

function demoShowMatchClick()
{
	if(document.demoMatch.actionscript.value == '1')
	{
		return true;
	}else{
	  var re = new RegExp(document.demoMatch.regex.value);
	  var m = re.exec(document.demoMatch.subject.value);
	  if (m == null) {
	    alert("No match");
	  } else {
	    var s = "Match at position " + m.index + ":\n";
	    for (i = 0; i < m.length; i++) {
	      s = s + i + ' - ' + m[i] + "\n";
	    }
	    alert(s);
	  }
	  return false;
  }
}

function demoReplaceClick()
{
	if(document.demoMatch.actionscript.value == '1')
	{
		return true;
	}else{
	  var re = new RegExp(document.demoMatch.regex.value, "g");
	  document.demoMatch.result.value =
	    document.demoMatch.subject.value.replace(re,
	      document.demoMatch.replacement.value);
	  return false;
  }
}
function demoChangeScript(obj)
{
	var f = document.demoMatch;
	if(obj.value == '1') // php
	{
		f.action = '';
		document.getElementById('match_select').style.display = 'block';
		document.getElementById('macth_all').style.display = 'block';
		document.getElementById('match_result').style.display = 'none';
	}else{ // javascript
		f.action = 'javascript:void(0)';
		document.getElementById('match_select').style.display = 'none';
		document.getElementById('macth_all').style.display = 'none';
		document.getElementById('match_result').style.display = 'block';
	}
}
// -->
</SCRIPT>
<FORM ID="demoMatch" NAME="demoMatch" METHOD=POST ACTION="javascript:void(0)" target="output">
	<table width="100%" height="100%" border=0 cellpadding="0" cellspacing="0">
		<tr>
			<td style="height:100px;">
				<P>Regexp: <INPUT TYPE=TEXT NAME="regex" VALUE="\bt[a-z]+\b" SIZE=50 style="padding: 5px;font-size: 18px;font-weight: bold;" /></P>
				<P>
					<textarea NAME="subject" style="width: 100%;height: 50px;border: 1px solid #ccc;">This is a test of the JavaScript RegExp object</textarea>
				</P>
				<P>Replacement text: <INPUT TYPE=TEXT NAME="replacement" VALUE="replaced" SIZE=50></P>
				<P id="match_result"><textarea NAME="result" style="width: 100%;height: 50px;border: 1px solid #ccc;"></textarea></P>
				<p id="match_select" style="display: none;"><label for="match">Case Sensitive : <input type="checkbox" id="match" name="match" value="1" checked></label></p>
				<P>
					<INPUT NAME=SUBMIT TYPE=SUBMIT VALUE="Test" ONCLICK="demoMatchClick()" style="float: left;">
					<INPUT NAME=SUBMIT TYPE=SUBMIT VALUE="Match" ONCLICK="demoShowMatchClick()" style="float: left;">
					<INPUT NAME=SUBMIT TYPE=SUBMIT VALUE="Match All" id="macth_all" style="display: none;float: left;">
					<INPUT NAME=SUBMIT TYPE=SUBMIT VALUE="Replace" ONCLICK="demoReplaceClick()" style="float: left;">
					<select id="actionscript" name="actionscript" onchange="demoChangeScript(this);" style="float: left;"><option value="0">js</option><option value="1">php</option></select>
					<div style="clear: both;"></div>
				</P>
			</td>
		</tr>
		<tr>
			<td>
				<iframe src="" name="output" width="100%" height="100%" frameborder=0></iframe>
			</td>
		</tr>
	</table>
</FORM>

<?php
}else{
	$r = array('~', '*', '#', '$', '@', '/','&');
	$s = '';
	$t = isset($_POST['match']) ? 's' : 'is';
	foreach($r AS $d)
	{
		if(!strstr($_POST['regex'], $d)) {
			$s = $d;
			break;
		}
	}
	$regex = $s.stripslashes($_POST['regex']).$s.$t;
	switch($_POST['SUBMIT'])
	{
		case 'Test':
			echo preg_match($regex, $_POST['subject']) ? 'Successful match' : 'No match';
		break;
		case 'Match':
			preg_match($regex, $_POST['subject'], $m);
			pr($_POST['regex'], $regex, $m);
		break;
		case 'Match All':
			preg_match_all($regex, $_POST['subject'], $m);
			pr($_POST['regex'], $regex, $m);
		break;
		case 'Replace':
			$m = preg_replace($regex, $_POST['replacement'], $_POST['subject']);
			pr($_POST['regex'], $regex, $m);
		break;
	}
}
