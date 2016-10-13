<?php $sys->stop(false); ?>
<link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">_Bbc(function($){$("#my_class").select();$("#my_class").on("keyup",function(){var a=$(this).val();if(a!=""){$("li.text-center").hide();if($("li[rel*='"+a+"']").length>0){$("li[rel*='"+a+"']").show()}else{$("li").hide();var b=a.replace(/[^a-z0-9]+/ig," ").split(" ");var c;var d=[];for(var i=0;i<b.length;i++){if(b[i]!=""){c=$("li[tags*='"+b[i]+"']");if(c.length>0){if(d.length==0){d=c}else{var e=d;d=[];for(var j=0;j<c.length;j++){if($.inArray(c[j],e)>-1){d.push(c[j])}}}}}}for(var i=0;i<d.length;i++){$(d[i]).show()}}}else{$("li.text-center").show()}}).on("keydown",function(e){var a=$(this).val();if(a!=""){if(e.charCode==0){var b=e.which||e.keyCode||0;if(b==27){$("li.text-center").show();$(this).val("");e.preventDefault();e.stopImmediatePropagation()}}}});$("h1.icon").each(function(){var a=this.className.replace("icon ","");var b=a.replace(/\-/g,"_");$(this).attr("rel1",a);$(this).attr("rel2",b)}).tooltip().on("click",function(){var a=$("#copies");var b=$(this);var c;switch($("#btn_class").attr("rel")){case'html':a.val('<i class="icon '+b.attr("rel1")+'"></i>');break;case'andro':a.val('IoniconsIcons.'+b.attr("rel2"));break;case'-':a.val(b.attr("rel1"));break;default:a.val(b.attr("rel2"));break}a.select();try{c=document.execCommand("copy")}catch(e){c=false}a.blur();if(c){b.css("color","green")}else{b.css("color","red")}window.setTimeout(function(a){a.css("color","black")},500,b)});$(".dropdown-menu a").on("click",function(){var a=$(this);$("#btn_class").attr("rel",a.attr("rel")).html(a.text()+' <span class="caret"></span>')})});</script>
<div class="form-group" style="top:0px;position:fixed;background: #ffffff;padding: 10px 10px 0 10px;">
	<div class="input-group">
    <input type="text" class="form-control" placeholder="ClassName..." id="my_class" />
    <div class="input-group-btn">
      <button type="button" class="btn btn-default dropdown-toggle" id="btn_class" rel="_" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">"_" Underscore <span class="caret"></span></button>
      <ul class="dropdown-menu dropdown-menu-right">
        <li><a href="#" rel="_">"_" Underscore</a></li>
        <li><a href="#" rel="-">"-" Dash</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="#" rel="html">HTML Tags</a></li>
        <li><a href="#" rel="andro">Android-Iconify</a></li>
      </ul>
    </div>
  </div>
  <p class="help-block text-center">click the Icons below to copy into your clipboard, and paste it to anywhere!</p>
</div>
<div class="container-fluid" style="padding-top: 40px;">
	<input type="text" id="copies" style="height: 2px; width: 100%; padding: 0px; border: none;" />
	<ul class="list-inline">
		<li class="text-center box" rel="ion-ionic" tags="ion-ionic badass, framework, sexy, hawt"> <h1 class="icon ion-ionic" title="ion-ionic"></h1></li>
		<li class="text-center box" rel="ion-arrow-up-a" tags="ion-arrow-up-a switch, flip"> <h1 class="icon ion-arrow-up-a" title="ion-arrow-up-a"></h1></li>
		<li class="text-center box" rel="ion-arrow-shrink" tags="ion-arrow-shrink pinch"> <h1 class="icon ion-arrow-shrink" title="ion-arrow-shrink"></h1></li>
		<li class="text-center box" rel="ion-arrow-expand" tags="ion-arrow-expand fullscreen"> <h1 class="icon ion-arrow-expand" title="ion-arrow-expand"></h1></li>
		<li class="text-center box" rel="ion-arrow-move" tags="ion-arrow-move drag"> <h1 class="icon ion-arrow-move" title="ion-arrow-move"></h1></li>
		<li class="text-center box" rel="ion-arrow-resize" tags="ion-arrow-resize drag"> <h1 class="icon ion-arrow-resize" title="ion-arrow-resize"></h1></li>
		<li class="text-center box" rel="ion-chevron-up" tags="ion-chevron-up arrow, up"> <h1 class="icon ion-chevron-up" title="ion-chevron-up"></h1></li>
		<li class="text-center box" rel="ion-chevron-right" tags="ion-chevron-right arrow, right"> <h1 class="icon ion-chevron-right" title="ion-chevron-right"></h1></li>
		<li class="text-center box" rel="ion-chevron-down" tags="ion-chevron-down arrow, down"> <h1 class="icon ion-chevron-down" title="ion-chevron-down"></h1></li>
		<li class="text-center box" rel="ion-chevron-left" tags="ion-chevron-left arrow, left"> <h1 class="icon ion-chevron-left" title="ion-chevron-left"></h1></li>
		<li class="text-center box" rel="ion-navicon-round" tags="ion-navicon-round menu, hamburger, slide menu"> <h1 class="icon ion-navicon-round" title="ion-navicon-round"></h1></li>
		<li class="text-center box" rel="ion-navicon" tags="ion-navicon menu, hamburger, slide menu"> <h1 class="icon ion-navicon" title="ion-navicon"></h1></li>
		<li class="text-center box" rel="ion-drag" tags="ion-drag reorder, move, drag"> <h1 class="icon ion-drag" title="ion-drag"></h1></li>
		<li class="text-center box" rel="ion-log-in" tags="ion-log-in sign in, "> <h1 class="icon ion-log-in" title="ion-log-in"></h1></li>
		<li class="text-center box" rel="ion-log-out" tags="ion-log-out sign out"> <h1 class="icon ion-log-out" title="ion-log-out"></h1></li>
		<li class="text-center box" rel="ion-checkmark-round" tags="ion-checkmark-round complete, finished, success, on"> <h1 class="icon ion-checkmark-round" title="ion-checkmark-round"></h1></li>
		<li class="text-center box" rel="ion-checkmark" tags="ion-checkmark complete, finished, success, on"> <h1 class="icon ion-checkmark" title="ion-checkmark"></h1></li>
		<li class="text-center box" rel="ion-checkmark-circled" tags="ion-checkmark-circled complete, finished, success, on"> <h1 class="icon ion-checkmark-circled" title="ion-checkmark-circled"></h1></li>
		<li class="text-center box" rel="ion-close-round" tags="ion-close-round delete, trash, kill, x"> <h1 class="icon ion-close-round" title="ion-close-round"></h1></li>
		<li class="text-center box" rel="ion-close" tags="ion-close delete, trash, kill, x"> <h1 class="icon ion-close" title="ion-close"></h1></li>
		<li class="text-center box" rel="ion-close-circled" tags="ion-close-circled delete, trash, kill, x"> <h1 class="icon ion-close-circled" title="ion-close-circled"></h1></li>
		<li class="text-center box" rel="ion-plus-round" tags="ion-plus-round add, include, new, invite, +"> <h1 class="icon ion-plus-round" title="ion-plus-round"></h1></li>
		<li class="text-center box" rel="ion-plus" tags="ion-plus add, include, new, invite, +"> <h1 class="icon ion-plus" title="ion-plus"></h1></li>
		<li class="text-center box" rel="ion-plus-circled" tags="ion-plus-circled add, include, new, invite, +"> <h1 class="icon ion-plus-circled" title="ion-plus-circled"></h1></li>
		<li class="text-center box" rel="ion-minus-round" tags="ion-minus-round hide, remove, minimize, -"> <h1 class="icon ion-minus-round" title="ion-minus-round"></h1></li>
		<li class="text-center box" rel="ion-minus" tags="ion-minus hide, remove, minimize, -"> <h1 class="icon ion-minus" title="ion-minus"></h1></li>
		<li class="text-center box" rel="ion-minus-circled" tags="ion-minus-circled hide, remove, minimize, -"> <h1 class="icon ion-minus-circled" title="ion-minus-circled"></h1></li>
		<li class="text-center box" rel="ion-information" tags="ion-information help, more, tooltip"> <h1 class="icon ion-information" title="ion-information"></h1></li>
		<li class="text-center box" rel="ion-information-circled" tags="ion-information-circled help, more, tooltip"> <h1 class="icon ion-information-circled" title="ion-information-circled"></h1></li>
		<li class="text-center box" rel="ion-help" tags="ion-help question, ?"> <h1 class="icon ion-help" title="ion-help"></h1></li>
		<li class="text-center box" rel="ion-help-circled" tags="ion-help-circled question, ?"> <h1 class="icon ion-help-circled" title="ion-help-circled"></h1></li>
		<li class="text-center box" rel="ion-backspace-outline" tags="ion-backspace-outline delete, remove, back"> <h1 class="icon ion-backspace-outline" title="ion-backspace-outline"></h1></li>
		<li class="text-center box" rel="ion-backspace" tags="ion-backspace delete, remove, back"> <h1 class="icon ion-backspace" title="ion-backspace"></h1></li>
		<li class="text-center box" rel="ion-help-buoy" tags="ion-help-buoy question, ?"> <h1 class="icon ion-help-buoy" title="ion-help-buoy"></h1></li>
		<li class="text-center box" rel="ion-asterisk" tags="ion-asterisk favorite, mark, star"> <h1 class="icon ion-asterisk" title="ion-asterisk"></h1></li>
		<li class="text-center box" rel="ion-alert" tags="ion-alert attention, warning, notice, !, exclamation"> <h1 class="icon ion-alert" title="ion-alert"></h1></li>
		<li class="text-center box" rel="ion-alert-circled" tags="ion-alert-circled attention, warning, notice, !, exclamation"> <h1 class="icon ion-alert-circled" title="ion-alert-circled"></h1></li>
		<li class="text-center box" rel="ion-refresh" tags="ion-refresh reload, renew"> <h1 class="icon ion-refresh" title="ion-refresh"></h1></li>
		<li class="text-center box" rel="ion-loop" tags="ion-loop refresh"> <h1 class="icon ion-loop" title="ion-loop"></h1></li>
		<li class="text-center box" rel="ion-shuffle" tags="ion-shuffle random"> <h1 class="icon ion-shuffle" title="ion-shuffle"></h1></li>
		<li class="text-center box" rel="ion-home" tags="ion-home house"> <h1 class="icon ion-home" title="ion-home"></h1></li>
		<li class="text-center box" rel="ion-search" tags="ion-search magnifying glass"> <h1 class="icon ion-search" title="ion-search"></h1></li>
		<li class="text-center box" rel="ion-flag" tags="ion-flag favorite, mark, star"> <h1 class="icon ion-flag" title="ion-flag"></h1></li>
		<li class="text-center box" rel="ion-star" tags="ion-star favorite"> <h1 class="icon ion-star" title="ion-star"></h1></li>
		<li class="text-center box" rel="ion-heart" tags="ion-heart love"> <h1 class="icon ion-heart" title="ion-heart"></h1></li>
		<li class="text-center box" rel="ion-heart-broken" tags="ion-heart-broken love"> <h1 class="icon ion-heart-broken" title="ion-heart-broken"></h1></li>
		<li class="text-center box" rel="ion-gear-a" tags="ion-gear-a settings, options, cog"> <h1 class="icon ion-gear-a" title="ion-gear-a"></h1></li>
		<li class="text-center box" rel="ion-gear-b" tags="ion-gear-b settings, options, cog"> <h1 class="icon ion-gear-b" title="ion-gear-b"></h1></li>
		<li class="text-center box" rel="ion-toggle-filled" tags="ion-toggle-filled settings, options, switch"> <h1 class="icon ion-toggle-filled" title="ion-toggle-filled"></h1></li>
		<li class="text-center box" rel="ion-toggle" tags="ion-toggle settings, options, switch"> <h1 class="icon ion-toggle" title="ion-toggle"></h1></li>
		<li class="text-center box" rel="ion-settings" tags="ion-settings options, tools"> <h1 class="icon ion-settings" title="ion-settings"></h1></li>
		<li class="text-center box" rel="ion-wrench" tags="ion-wrench settings, options, tools"> <h1 class="icon ion-wrench" title="ion-wrench"></h1></li>
		<li class="text-center box" rel="ion-hammer" tags="ion-hammer settings, options, tools"> <h1 class="icon ion-hammer" title="ion-hammer"></h1></li>
		<li class="text-center box" rel="ion-edit" tags="ion-edit change, update, write, type, pencil"> <h1 class="icon ion-edit" title="ion-edit"></h1></li>
		<li class="text-center box" rel="ion-trash-a" tags="ion-trash-a delete, remove, dump"> <h1 class="icon ion-trash-a" title="ion-trash-a"></h1></li>
		<li class="text-center box" rel="ion-trash-b" tags="ion-trash-b delete, remove, dump"> <h1 class="icon ion-trash-b" title="ion-trash-b"></h1></li>
		<li class="text-center box" rel="ion-document" tags="ion-document paper, file"> <h1 class="icon ion-document" title="ion-document"></h1></li>
		<li class="text-center box" rel="ion-document-text" tags="ion-document-text paper, file"> <h1 class="icon ion-document-text" title="ion-document-text"></h1></li>
		<li class="text-center box" rel="ion-clipboard" tags="ion-clipboard write"> <h1 class="icon ion-clipboard" title="ion-clipboard"></h1></li>
		<li class="text-center box" rel="ion-scissors" tags="ion-scissors cut"> <h1 class="icon ion-scissors" title="ion-scissors"></h1></li>
		<li class="text-center box" rel="ion-funnel" tags="ion-funnel sort"> <h1 class="icon ion-funnel" title="ion-funnel"></h1></li>
		<li class="text-center box" rel="ion-bookmark" tags="ion-bookmark favorite, tag, save"> <h1 class="icon ion-bookmark" title="ion-bookmark"></h1></li>
		<li class="text-center box" rel="ion-email" tags="ion-email snail, mail, inbox"> <h1 class="icon ion-email" title="ion-email"></h1></li>
		<li class="text-center box" rel="ion-email-unread" tags="ion-email-unread snail, mail, inbox"> <h1 class="icon ion-email-unread" title="ion-email-unread"></h1></li>
		<li class="text-center box" rel="ion-folder" tags="ion-folder snail, mail"> <h1 class="icon ion-folder" title="ion-folder"></h1></li>
		<li class="text-center box" rel="ion-filing" tags="ion-filing mail"> <h1 class="icon ion-filing" title="ion-filing"></h1></li>
		<li class="text-center box" rel="ion-archive" tags="ion-archive mail"> <h1 class="icon ion-archive" title="ion-archive"></h1></li>
		<li class="text-center box" rel="ion-reply" tags="ion-reply mail, undo"> <h1 class="icon ion-reply" title="ion-reply"></h1></li>
		<li class="text-center box" rel="ion-reply-all" tags="ion-reply-all mail"> <h1 class="icon ion-reply-all" title="ion-reply-all"></h1></li>
		<li class="text-center box" rel="ion-forward" tags="ion-forward mail, redo"> <h1 class="icon ion-forward" title="ion-forward"></h1></li>
		<li class="text-center box" rel="ion-share" tags="ion-share outbound"> <h1 class="icon ion-share" title="ion-share"></h1></li>
		<li class="text-center box" rel="ion-paper-airplane" tags="ion-paper-airplane outbound, mail, letter, send"> <h1 class="icon ion-paper-airplane" title="ion-paper-airplane"></h1></li>
		<li class="text-center box" rel="ion-link" tags="ion-link chain, anchor, href, attach"> <h1 class="icon ion-link" title="ion-link"></h1></li>
		<li class="text-center box" rel="ion-paperclip" tags="ion-paperclip attach"> <h1 class="icon ion-paperclip" title="ion-paperclip"></h1></li>
		<li class="text-center box" rel="ion-compose" tags="ion-compose write, compose, type"> <h1 class="icon ion-compose" title="ion-compose"></h1></li>
		<li class="text-center box" rel="ion-briefcase" tags="ion-briefcase store, organize"> <h1 class="icon ion-briefcase" title="ion-briefcase"></h1></li>
		<li class="text-center box" rel="ion-medkit" tags="ion-medkit health"> <h1 class="icon ion-medkit" title="ion-medkit"></h1></li>
		<li class="text-center box" rel="ion-at" tags="ion-at @"> <h1 class="icon ion-at" title="ion-at"></h1></li>
		<li class="text-center box" rel="ion-pound" tags="ion-pound hashtag, #"> <h1 class="icon ion-pound" title="ion-pound"></h1></li>
		<li class="text-center box" rel="ion-quote" tags="ion-quote chat, quotation"> <h1 class="icon ion-quote" title="ion-quote"></h1></li>
		<li class="text-center box" rel="ion-cloud" tags="ion-cloud storage"> <h1 class="icon ion-cloud" title="ion-cloud"></h1></li>
		<li class="text-center box" rel="ion-upload" tags="ion-upload storage, cloud"> <h1 class="icon ion-upload" title="ion-upload"></h1></li>
		<li class="text-center box" rel="ion-more" tags="ion-more circles"> <h1 class="icon ion-more" title="ion-more"></h1></li>
		<li class="text-center box" rel="ion-grid" tags="ion-grid menu"> <h1 class="icon ion-grid" title="ion-grid"></h1></li>
		<li class="text-center box" rel="ion-calendar" tags="ion-calendar date, time, month, year"> <h1 class="icon ion-calendar" title="ion-calendar"></h1></li>
		<li class="text-center box" rel="ion-clock" tags="ion-clock time, watch, hours, minutes, seconds"> <h1 class="icon ion-clock" title="ion-clock"></h1></li>
		<li class="text-center box" rel="ion-compass" tags="ion-compass location, directions, navigation"> <h1 class="icon ion-compass" title="ion-compass"></h1></li>
		<li class="text-center box" rel="ion-pinpoint" tags="ion-pinpoint gps, navigation"> <h1 class="icon ion-pinpoint" title="ion-pinpoint"></h1></li>
		<li class="text-center box" rel="ion-pin" tags="ion-pin gps, navigation"> <h1 class="icon ion-pin" title="ion-pin"></h1></li>
		<li class="text-center box" rel="ion-navigate" tags="ion-navigate gps, location pin"> <h1 class="icon ion-navigate" title="ion-navigate"></h1></li>
		<li class="text-center box" rel="ion-location" tags="ion-location gps, navigation, pin"> <h1 class="icon ion-location" title="ion-location"></h1></li>
		<li class="text-center box" rel="ion-map" tags="ion-map gps, navigation, pin"> <h1 class="icon ion-map" title="ion-map"></h1></li>
		<li class="text-center box" rel="ion-lock-combination" tags="ion-lock-combination padlock, security"> <h1 class="icon ion-lock-combination" title="ion-lock-combination"></h1></li>
		<li class="text-center box" rel="ion-locked" tags="ion-locked padlock, security"> <h1 class="icon ion-locked" title="ion-locked"></h1></li>
		<li class="text-center box" rel="ion-unlocked" tags="ion-unlocked padlock, security"> <h1 class="icon ion-unlocked" title="ion-unlocked"></h1></li>
		<li class="text-center box" rel="ion-key" tags="ion-key access"> <h1 class="icon ion-key" title="ion-key"></h1></li>
		<li class="text-center box" rel="ion-arrow-graph-up-right" tags="ion-arrow-graph-up-right stats"> <h1 class="icon ion-arrow-graph-up-right" title="ion-arrow-graph-up-right"></h1></li>
		<li class="text-center box" rel="ion-arrow-graph-down-right" tags="ion-arrow-graph-down-right stats"> <h1 class="icon ion-arrow-graph-down-right" title="ion-arrow-graph-down-right"></h1></li>
		<li class="text-center box" rel="ion-arrow-graph-up-left" tags="ion-arrow-graph-up-left stats"> <h1 class="icon ion-arrow-graph-up-left" title="ion-arrow-graph-up-left"></h1></li>
		<li class="text-center box" rel="ion-arrow-graph-down-left" tags="ion-arrow-graph-down-left stats"> <h1 class="icon ion-arrow-graph-down-left" title="ion-arrow-graph-down-left"></h1></li>
		<li class="text-center box" rel="ion-stats-bars" tags="ion-stats-bars data"> <h1 class="icon ion-stats-bars" title="ion-stats-bars"></h1></li>
		<li class="text-center box" rel="ion-connection-bars" tags="ion-connection-bars data, stats"> <h1 class="icon ion-connection-bars" title="ion-connection-bars"></h1></li>
		<li class="text-center box" rel="ion-pie-graph" tags="ion-pie-graph stats"> <h1 class="icon ion-pie-graph" title="ion-pie-graph"></h1></li>
		<li class="text-center box" rel="ion-chatbubble" tags="ion-chatbubble talk"> <h1 class="icon ion-chatbubble" title="ion-chatbubble"></h1></li>
		<li class="text-center box" rel="ion-chatbubble-working" tags="ion-chatbubble-working talk"> <h1 class="icon ion-chatbubble-working" title="ion-chatbubble-working"></h1></li>
		<li class="text-center box" rel="ion-chatbubbles" tags="ion-chatbubbles talk"> <h1 class="icon ion-chatbubbles" title="ion-chatbubbles"></h1></li>
		<li class="text-center box" rel="ion-chatbox" tags="ion-chatbox talk"> <h1 class="icon ion-chatbox" title="ion-chatbox"></h1></li>
		<li class="text-center box" rel="ion-chatbox-working" tags="ion-chatbox-working talk"> <h1 class="icon ion-chatbox-working" title="ion-chatbox-working"></h1></li>
		<li class="text-center box" rel="ion-chatboxes" tags="ion-chatboxes talk"> <h1 class="icon ion-chatboxes" title="ion-chatboxes"></h1></li>
		<li class="text-center box" rel="ion-person" tags="ion-person users, staff, head, human"> <h1 class="icon ion-person" title="ion-person"></h1></li>
		<li class="text-center box" rel="ion-person-add" tags="ion-person-add users, staff, head, human, member, new"> <h1 class="icon ion-person-add" title="ion-person-add"></h1></li>
		<li class="text-center box" rel="ion-person-stalker" tags="ion-person-stalker people, human, users, staff"> <h1 class="icon ion-person-stalker" title="ion-person-stalker"></h1></li>
		<li class="text-center box" rel="ion-woman" tags="ion-woman female, lady, girl, dudette"> <h1 class="icon ion-woman" title="ion-woman"></h1></li>
		<li class="text-center box" rel="ion-man" tags="ion-man male, guy, boy, dude"> <h1 class="icon ion-man" title="ion-man"></h1></li>
		<li class="text-center box" rel="ion-female" tags="ion-female lady, girl, dudette"> <h1 class="icon ion-female" title="ion-female"></h1></li>
		<li class="text-center box" rel="ion-male" tags="ion-male male, guy, boy, dude"> <h1 class="icon ion-male" title="ion-male"></h1></li>
		<li class="text-center box" rel="ion-transgender" tags="ion-transgender food, drink, eat"> <h1 class="icon ion-transgender" title="ion-transgender"></h1></li>
		<li class="text-center box" rel="ion-knife" tags="ion-knife food, drink, eat"> <h1 class="icon ion-knife" title="ion-knife"></h1></li>
		<li class="text-center box" rel="ion-spoon" tags="ion-spoon food, drink, eat"> <h1 class="icon ion-spoon" title="ion-spoon"></h1></li>
		<li class="text-center box" rel="ion-soup-can-outline" tags="ion-soup-can-outline food, drink, eat"> <h1 class="icon ion-soup-can-outline" title="ion-soup-can-outline"></h1></li>
		<li class="text-center box" rel="ion-soup-can" tags="ion-soup-can food, drink, eat"> <h1 class="icon ion-soup-can" title="ion-soup-can"></h1></li>
		<li class="text-center box" rel="ion-beer" tags="ion-beer food, drink, eat"> <h1 class="icon ion-beer" title="ion-beer"></h1></li>
		<li class="text-center box" rel="ion-wineglass" tags="ion-wineglass food, drink, eat"> <h1 class="icon ion-wineglass" title="ion-wineglass"></h1></li>
		<li class="text-center box" rel="ion-coffee" tags="ion-coffee food, drink, eat, caffeine"> <h1 class="icon ion-coffee" title="ion-coffee"></h1></li>
		<li class="text-center box" rel="ion-icecream" tags="ion-icecream food, drink, eat"> <h1 class="icon ion-icecream" title="ion-icecream"></h1></li>
		<li class="text-center box" rel="ion-pizza" tags="ion-pizza food, drink, eat"> <h1 class="icon ion-pizza" title="ion-pizza"></h1></li>
		<li class="text-center box" rel="ion-power" tags="ion-power on, off"> <h1 class="icon ion-power" title="ion-power"></h1></li>
		<li class="text-center box" rel="ion-mouse" tags="ion-mouse computer"> <h1 class="icon ion-mouse" title="ion-mouse"></h1></li>
		<li class="text-center box" rel="ion-battery-full" tags="ion-battery-full internet, connection"> <h1 class="icon ion-battery-full" title="ion-battery-full"></h1></li>
		<li class="text-center box" rel="ion-bluetooth" tags="ion-bluetooth connection, cloud"> <h1 class="icon ion-bluetooth" title="ion-bluetooth"></h1></li>
		<li class="text-center box" rel="ion-calculator" tags="ion-calculator math, arithmatic, numbers, addition, subtraction"> <h1 class="icon ion-calculator" title="ion-calculator"></h1></li>
		<li class="text-center box" rel="ion-camera" tags="ion-camera photo"> <h1 class="icon ion-camera" title="ion-camera"></h1></li>
		<li class="text-center box" rel="ion-eye" tags="ion-eye view, see, creeper"> <h1 class="icon ion-eye" title="ion-eye"></h1></li>
		<li class="text-center box" rel="ion-eye-disabled" tags="ion-eye-disabled view, see, creeper"> <h1 class="icon ion-eye-disabled" title="ion-eye-disabled"></h1></li>
		<li class="text-center box" rel="ion-flash" tags="ion-flash lightning, weather, whether"> <h1 class="icon ion-flash" title="ion-flash"></h1></li>
		<li class="text-center box" rel="ion-flash-off" tags="ion-flash-off reader"> <h1 class="icon ion-flash-off" title="ion-flash-off"></h1></li>
		<li class="text-center box" rel="ion-image" tags="ion-image photo"> <h1 class="icon ion-image" title="ion-image"></h1></li>
		<li class="text-center box" rel="ion-images" tags="ion-images photo"> <h1 class="icon ion-images" title="ion-images"></h1></li>
		<li class="text-center box" rel="ion-wand" tags="ion-wand images, levels, light, dark, settings"> <h1 class="icon ion-wand" title="ion-wand"></h1></li>
		<li class="text-center box" rel="ion-contrast" tags="ion-contrast images, levels, light, dark, settings"> <h1 class="icon ion-contrast" title="ion-contrast"></h1></li>
		<li class="text-center box" rel="ion-aperture" tags="ion-aperture images, levels, light, dark, settings"> <h1 class="icon ion-aperture" title="ion-aperture"></h1></li>
		<li class="text-center box" rel="ion-crop" tags="ion-crop images, levels, light, dark, settings"> <h1 class="icon ion-crop" title="ion-crop"></h1></li>
		<li class="text-center box" rel="ion-easel" tags="ion-easel images, art, create, color"> <h1 class="icon ion-easel" title="ion-easel"></h1></li>
		<li class="text-center box" rel="ion-paintbrush" tags="ion-paintbrush images, art, create, color"> <h1 class="icon ion-paintbrush" title="ion-paintbrush"></h1></li>
		<li class="text-center box" rel="ion-paintbucket" tags="ion-paintbucket images, art, create, color"> <h1 class="icon ion-paintbucket" title="ion-paintbucket"></h1></li>
		<li class="text-center box" rel="ion-monitor" tags="ion-monitor thunderbolt, screen"> <h1 class="icon ion-monitor" title="ion-monitor"></h1></li>
		<li class="text-center box" rel="ion-laptop" tags="ion-laptop macbook, apple, osx"> <h1 class="icon ion-laptop" title="ion-laptop"></h1></li>
		<li class="text-center box" rel="ion-ipad" tags="ion-ipad tablet, mobile, apple, retina, device"> <h1 class="icon ion-ipad" title="ion-ipad"></h1></li>
		<li class="text-center box" rel="ion-iphone" tags="ion-iphone smartphone, mobile, apple, retina, device"> <h1 class="icon ion-iphone" title="ion-iphone"></h1></li>
		<li class="text-center box" rel="ion-ipod" tags="ion-ipod music, player, apple, retina, device"> <h1 class="icon ion-ipod" title="ion-ipod"></h1></li>
		<li class="text-center box" rel="ion-printer" tags="ion-printer paper"> <h1 class="icon ion-printer" title="ion-printer"></h1></li>
		<li class="text-center box" rel="ion-usb" tags="ion-usb digital, computer"> <h1 class="icon ion-usb" title="ion-usb"></h1></li>
		<li class="text-center box" rel="ion-outlet" tags="ion-outlet digital, computer, electricity"> <h1 class="icon ion-outlet" title="ion-outlet"></h1></li>
		<li class="text-center box" rel="ion-bug" tags="ion-bug develop, program, hacker, error"> <h1 class="icon ion-bug" title="ion-bug"></h1></li>
		<li class="text-center box" rel="ion-code" tags="ion-code develop, program, hacker"> <h1 class="icon ion-code" title="ion-code"></h1></li>
		<li class="text-center box" rel="ion-code-working" tags="ion-code-working develop, program, hacker"> <h1 class="icon ion-code-working" title="ion-code-working"></h1></li>
		<li class="text-center box" rel="ion-code-download" tags="ion-code-download develop, program, hacker"> <h1 class="icon ion-code-download" title="ion-code-download"></h1></li>
		<li class="text-center box" rel="ion-fork-repo" tags="ion-fork-repo develop, program, hacker, github"> <h1 class="icon ion-fork-repo" title="ion-fork-repo"></h1></li>
		<li class="text-center box" rel="ion-network" tags="ion-network develop, program, hacker, github"> <h1 class="icon ion-network" title="ion-network"></h1></li>
		<li class="text-center box" rel="ion-pull-request" tags="ion-pull-request develop, program, hacker, github"> <h1 class="icon ion-pull-request" title="ion-pull-request"></h1></li>
		<li class="text-center box" rel="ion-merge" tags="ion-merge develop, program, hacker, github"> <h1 class="icon ion-merge" title="ion-merge"></h1></li>
		<li class="text-center box" rel="ion-xbox" tags="ion-xbox fun, games"> <h1 class="icon ion-xbox" title="ion-xbox"></h1></li>
		<li class="text-center box" rel="ion-playstation" tags="ion-playstation fun, games"> <h1 class="icon ion-playstation" title="ion-playstation"></h1></li>
		<li class="text-center box" rel="ion-steam" tags="ion-steam fun, games"> <h1 class="icon ion-steam" title="ion-steam"></h1></li>
		<li class="text-center box" rel="ion-closed-captioning" tags="ion-closed-captioning movie, film, television"> <h1 class="icon ion-closed-captioning" title="ion-closed-captioning"></h1></li>
		<li class="text-center box" rel="ion-videocamera" tags="ion-videocamera movie, film, television"> <h1 class="icon ion-videocamera" title="ion-videocamera"></h1></li>
		<li class="text-center box" rel="ion-film-marker" tags="ion-film-marker film, cut, action"> <h1 class="icon ion-film-marker" title="ion-film-marker"></h1></li>
		<li class="text-center box" rel="ion-disc" tags="ion-disc cd, vinyl"> <h1 class="icon ion-disc" title="ion-disc"></h1></li>
		<li class="text-center box" rel="ion-headphone" tags="ion-headphone music, earbuds, beats"> <h1 class="icon ion-headphone" title="ion-headphone"></h1></li>
		<li class="text-center box" rel="ion-music-note" tags="ion-music-note songs"> <h1 class="icon ion-music-note" title="ion-music-note"></h1></li>
		<li class="text-center box" rel="ion-radio-waves" tags="ion-radio-waves music, sound, speaker"> <h1 class="icon ion-radio-waves" title="ion-radio-waves"></h1></li>
		<li class="text-center box" rel="ion-speakerphone" tags="ion-speakerphone sound, speaker, loud, amplify"> <h1 class="icon ion-speakerphone" title="ion-speakerphone"></h1></li>
		<li class="text-center box" rel="ion-mic-a" tags="ion-mic-a sound, talk, speaker"> <h1 class="icon ion-mic-a" title="ion-mic-a"></h1></li>
		<li class="text-center box" rel="ion-mic-b" tags="ion-mic-b sound, talk, speaker"> <h1 class="icon ion-mic-b" title="ion-mic-b"></h1></li>
		<li class="text-center box" rel="ion-mic-c" tags="ion-mic-c sound, talk, speaker"> <h1 class="icon ion-mic-c" title="ion-mic-c"></h1></li>
		<li class="text-center box" rel="ion-volume-high" tags="ion-volume-high sound, noise"> <h1 class="icon ion-volume-high" title="ion-volume-high"></h1></li>
		<li class="text-center box" rel="ion-volume-medium" tags="ion-volume-medium sound"> <h1 class="icon ion-volume-medium" title="ion-volume-medium"></h1></li>
		<li class="text-center box" rel="ion-volume-low" tags="ion-volume-low sound"> <h1 class="icon ion-volume-low" title="ion-volume-low"></h1></li>
		<li class="text-center box" rel="ion-volume-mute" tags="ion-volume-mute sound"> <h1 class="icon ion-volume-mute" title="ion-volume-mute"></h1></li>
		<li class="text-center box" rel="ion-levels" tags="ion-levels options, toggles, sound, mixer"> <h1 class="icon ion-levels" title="ion-levels"></h1></li>
		<li class="text-center box" rel="ion-play" tags="ion-play music, watch, arrow, right"> <h1 class="icon ion-play" title="ion-play"></h1></li>
		<li class="text-center box" rel="ion-pause" tags="ion-pause music, break, hold, freeze"> <h1 class="icon ion-pause" title="ion-pause"></h1></li>
		<li class="text-center box" rel="ion-stop" tags="ion-stop music, square, hold, freeze"> <h1 class="icon ion-stop" title="ion-stop"></h1></li>
		<li class="text-center box" rel="ion-record" tags="ion-record music, circle"> <h1 class="icon ion-record" title="ion-record"></h1></li>
		<li class="text-center box" rel="ion-skip-forward" tags="ion-skip-forward music, next"> <h1 class="icon ion-skip-forward" title="ion-skip-forward"></h1></li>
		<li class="text-center box" rel="ion-skip-backward" tags="ion-skip-backward music, previous"> <h1 class="icon ion-skip-backward" title="ion-skip-backward"></h1></li>
		<li class="text-center box" rel="ion-eject" tags="ion-eject music, dvd, remove"> <h1 class="icon ion-eject" title="ion-eject"></h1></li>
		<li class="text-center box" rel="ion-bag" tags="ion-bag shopping, price, cart, money, container, $"> <h1 class="icon ion-bag" title="ion-bag"></h1></li>
		<li class="text-center box" rel="ion-card" tags="ion-card credit, price, debit, money, shopping, cash, dollars, $"> <h1 class="icon ion-card" title="ion-card"></h1></li>
		<li class="text-center box" rel="ion-cash" tags="ion-cash credit, price, debit, money, shopping, dollars, $"> <h1 class="icon ion-cash" title="ion-cash"></h1></li>
		<li class="text-center box" rel="ion-pricetag" tags="ion-pricetag credit, debit, money, shopping, cash, dollars, $"> <h1 class="icon ion-pricetag" title="ion-pricetag"></h1></li>
		<li class="text-center box" rel="ion-pricetags" tags="ion-pricetags credit, debit, money, shopping, cash, dollars, $"> <h1 class="icon ion-pricetags" title="ion-pricetags"></h1></li>
		<li class="text-center box" rel="ion-thumbsup" tags="ion-thumbsup like, fun, yes"> <h1 class="icon ion-thumbsup" title="ion-thumbsup"></h1></li>
		<li class="text-center box" rel="ion-thumbsdown" tags="ion-thumbsdown dislike, boring, no"> <h1 class="icon ion-thumbsdown" title="ion-thumbsdown"></h1></li>
		<li class="text-center box" rel="ion-happy-outline" tags="ion-happy-outline good, like, fun, yes"> <h1 class="icon ion-happy-outline" title="ion-happy-outline"></h1></li>
		<li class="text-center box" rel="ion-happy" tags="ion-happy good, like, fun, yes"> <h1 class="icon ion-happy" title="ion-happy"></h1></li>
		<li class="text-center box" rel="ion-sad-outline" tags="ion-sad-outline cry, bad, no"> <h1 class="icon ion-sad-outline" title="ion-sad-outline"></h1></li>
		<li class="text-center box" rel="ion-sad" tags="ion-sad cry, bad, no"> <h1 class="icon ion-sad" title="ion-sad"></h1></li>
		<li class="text-center box" rel="ion-bowtie" tags="ion-bowtie tie, shirt, dress, clothing"> <h1 class="icon ion-bowtie" title="ion-bowtie"></h1></li>
		<li class="text-center box" rel="ion-tshirt-outline" tags="ion-tshirt-outline tie, shirt, dress, clothing"> <h1 class="icon ion-tshirt-outline" title="ion-tshirt-outline"></h1></li>
		<li class="text-center box" rel="ion-tshirt" tags="ion-tshirt tie, shirt, dress, clothing"> <h1 class="icon ion-tshirt" title="ion-tshirt"></h1></li>
		<li class="text-center box" rel="ion-trophy" tags="ion-trophy competition, compete, win, lose, award"> <h1 class="icon ion-trophy" title="ion-trophy"></h1></li>
		<li class="text-center box" rel="ion-podium" tags="ion-podium competition, compete, win, lose, award"> <h1 class="icon ion-podium" title="ion-podium"></h1></li>
		<li class="text-center box" rel="ion-ribbon-a" tags="ion-ribbon-a competition, compete, win, lose, award, trophy"> <h1 class="icon ion-ribbon-a" title="ion-ribbon-a"></h1></li>
		<li class="text-center box" rel="ion-ribbon-b" tags="ion-ribbon-b competition, compete, win, lose, award, trophy"> <h1 class="icon ion-ribbon-b" title="ion-ribbon-b"></h1></li>
		<li class="text-center box" rel="ion-university" tags="ion-university graduate, education, school, tassle"> <h1 class="icon ion-university" title="ion-university"></h1></li>
		<li class="text-center box" rel="ion-magnet" tags="ion-magnet sticky, attraction"> <h1 class="icon ion-magnet" title="ion-magnet"></h1></li>
		<li class="text-center box" rel="ion-beaker" tags="ion-beaker mixture, potion, flask"> <h1 class="icon ion-beaker" title="ion-beaker"></h1></li>
		<li class="text-center box" rel="ion-erlenmeyer-flask" tags="ion-erlenmeyer-flask mixture, potion, beaker, potion"> <h1 class="icon ion-erlenmeyer-flask" title="ion-erlenmeyer-flask"></h1></li>
		<li class="text-center box" rel="ion-egg" tags="ion-egg birth, twitter, bird, baby"> <h1 class="icon ion-egg" title="ion-egg"></h1></li>
		<li class="text-center box" rel="ion-earth" tags="ion-earth nature, globe, home, planet"> <h1 class="icon ion-earth" title="ion-earth"></h1></li>
		<li class="text-center box" rel="ion-planet" tags="ion-planet nature, globe, home, planet, space"> <h1 class="icon ion-planet" title="ion-planet"></h1></li>
		<li class="text-center box" rel="ion-lightbulb" tags="ion-lightbulb idea, new, aha!"> <h1 class="icon ion-lightbulb" title="ion-lightbulb"></h1></li>
		<li class="text-center box" rel="ion-cube" tags="ion-cube box, square, container"> <h1 class="icon ion-cube" title="ion-cube"></h1></li>
		<li class="text-center box" rel="ion-leaf" tags="ion-leaf green, recycle, plant, nature"> <h1 class="icon ion-leaf" title="ion-leaf"></h1></li>
		<li class="text-center box" rel="ion-waterdrop" tags="ion-waterdrop nature, clean, recycle, fresh, wet, rain"> <h1 class="icon ion-waterdrop" title="ion-waterdrop"></h1></li>
		<li class="text-center box" rel="ion-flame" tags="ion-flame fire, hot, heat"> <h1 class="icon ion-flame" title="ion-flame"></h1></li>
		<li class="text-center box" rel="ion-fireball" tags="ion-fireball hot, heat"> <h1 class="icon ion-fireball" title="ion-fireball"></h1></li>
		<li class="text-center box" rel="ion-bonfire" tags="ion-bonfire hot, heat"> <h1 class="icon ion-bonfire" title="ion-bonfire"></h1></li>
		<li class="text-center box" rel="ion-umbrella" tags="ion-umbrella wet, rain, dry, shelter"> <h1 class="icon ion-umbrella" title="ion-umbrella"></h1></li>
		<li class="text-center box" rel="ion-nuclear" tags="ion-nuclear danger, warning, hazard"> <h1 class="icon ion-nuclear" title="ion-nuclear"></h1></li>
		<li class="text-center box" rel="ion-no-smoking" tags="ion-no-smoking danger, warning, cigarette, cancer"> <h1 class="icon ion-no-smoking" title="ion-no-smoking"></h1></li>
		<li class="text-center box" rel="ion-thermometer" tags="ion-thermometer hot, cold, heat, temperature, mercury"> <h1 class="icon ion-thermometer" title="ion-thermometer"></h1></li>
		<li class="text-center box" rel="ion-speedometer" tags="ion-speedometer travel, accelerate"> <h1 class="icon ion-speedometer" title="ion-speedometer"></h1></li>
		<li class="text-center box" rel="ion-model-s" tags="ion-model-s navigation, car, drive, transportation, tesla, sexy"> <h1 class="icon ion-model-s" title="ion-model-s"></h1></li>
		<li class="text-center box" rel="ion-plane" tags="ion-plane fly, jet"> <h1 class="icon ion-plane" title="ion-plane"></h1></li>
		<li class="text-center box" rel="ion-jet" tags="ion-jet fly, plane"> <h1 class="icon ion-jet" title="ion-jet"></h1></li>
		<li class="text-center box" rel="ion-load-a" tags="ion-load-a spinner, waiting, refresh"> <h1 class="icon ion-load-a" title="ion-load-a"></h1></li>
		<li class="text-center box" rel="ion-load-b" tags="ion-load-b spinner, waiting, refresh"> <h1 class="icon ion-load-b" title="ion-load-b"></h1></li>
		<li class="text-center box" rel="ion-load-c" tags="ion-load-c spinner, waiting, refresh"> <h1 class="icon ion-load-c" title="ion-load-c"></h1></li>
		<li class="text-center box" rel="ion-load-d" tags="ion-load-d spinner, waiting, refresh"> <h1 class="icon ion-load-d" title="ion-load-d"></h1></li>
		<li class="text-center box" rel="ion-ios-ionic-outline" tags="ion-ios-ionic-outline badass, framework, sexy"> <h1 class="icon ion-ios-ionic-outline" title="ion-ios-ionic-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-arrow-back" tags="ion-ios-arrow-back chevron, left"> <h1 class="icon ion-ios-arrow-back" title="ion-ios-arrow-back"></h1></li>
		<li class="text-center box" rel="ion-ios-arrow-forward" tags="ion-ios-arrow-forward chevron, right"> <h1 class="icon ion-ios-arrow-forward" title="ion-ios-arrow-forward"></h1></li>
		<li class="text-center box" rel="ion-ios-arrow-up" tags="ion-ios-arrow-up chevron"> <h1 class="icon ion-ios-arrow-up" title="ion-ios-arrow-up"></h1></li>
		<li class="text-center box" rel="ion-ios-arrow-right" tags="ion-ios-arrow-right chevron"> <h1 class="icon ion-ios-arrow-right" title="ion-ios-arrow-right"></h1></li>
		<li class="text-center box" rel="ion-ios-arrow-down" tags="ion-ios-arrow-down chevron"> <h1 class="icon ion-ios-arrow-down" title="ion-ios-arrow-down"></h1></li>
		<li class="text-center box" rel="ion-ios-arrow-left" tags="ion-ios-arrow-left chevron"> <h1 class="icon ion-ios-arrow-left" title="ion-ios-arrow-left"></h1></li>
		<li class="text-center box" rel="ion-ios-arrow-thin-up" tags="ion-ios-arrow-thin-up chevron"> <h1 class="icon ion-ios-arrow-thin-up" title="ion-ios-arrow-thin-up"></h1></li>
		<li class="text-center box" rel="ion-ios-arrow-thin-right" tags="ion-ios-arrow-thin-right chevron"> <h1 class="icon ion-ios-arrow-thin-right" title="ion-ios-arrow-thin-right"></h1></li>
		<li class="text-center box" rel="ion-ios-arrow-thin-down" tags="ion-ios-arrow-thin-down chevron"> <h1 class="icon ion-ios-arrow-thin-down" title="ion-ios-arrow-thin-down"></h1></li>
		<li class="text-center box" rel="ion-ios-arrow-thin-left" tags="ion-ios-arrow-thin-left chevron"> <h1 class="icon ion-ios-arrow-thin-left" title="ion-ios-arrow-thin-left"></h1></li>
		<li class="text-center box" rel="ion-ios-circle-filled" tags="ion-ios-circle-filled checkmark, radio, dot, on, selected, button"> <h1 class="icon ion-ios-circle-filled" title="ion-ios-circle-filled"></h1></li>
		<li class="text-center box" rel="ion-ios-circle-outline" tags="ion-ios-circle-outline checkmark, radio, dot, off, button"> <h1 class="icon ion-ios-circle-outline" title="ion-ios-circle-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-checkmark-empty" tags="ion-ios-checkmark-empty success, confirmed, on, finished, complete"> <h1 class="icon ion-ios-checkmark-empty" title="ion-ios-checkmark-empty"></h1></li>
		<li class="text-center box" rel="ion-ios-checkmark-outline" tags="ion-ios-checkmark-outline success, confirmed, on, finished, complete"> <h1 class="icon ion-ios-checkmark-outline" title="ion-ios-checkmark-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-checkmark" tags="ion-ios-checkmark success, confirmed, on, finished, complete"> <h1 class="icon ion-ios-checkmark" title="ion-ios-checkmark"></h1></li>
		<li class="text-center box" rel="ion-ios-plus-empty" tags="ion-ios-plus-empty add, include, new, invite, +"> <h1 class="icon ion-ios-plus-empty" title="ion-ios-plus-empty"></h1></li>
		<li class="text-center box" rel="ion-ios-plus-outline" tags="ion-ios-plus-outline add, include, new, invite, +"> <h1 class="icon ion-ios-plus-outline" title="ion-ios-plus-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-plus" tags="ion-ios-plus add, include, new, invite, +"> <h1 class="icon ion-ios-plus" title="ion-ios-plus"></h1></li>
		<li class="text-center box" rel="ion-ios-close-empty" tags="ion-ios-close-empty delete, remove, trash, end, stop, x"> <h1 class="icon ion-ios-close-empty" title="ion-ios-close-empty"></h1></li>
		<li class="text-center box" rel="ion-ios-close-outline" tags="ion-ios-close-outline delete, remove, trash, end, stop, x"> <h1 class="icon ion-ios-close-outline" title="ion-ios-close-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-close" tags="ion-ios-close delete, remove, trash, end, stop, x"> <h1 class="icon ion-ios-close" title="ion-ios-close"></h1></li>
		<li class="text-center box" rel="ion-ios-minus-empty" tags="ion-ios-minus-empty hide, remove, minimize, -"> <h1 class="icon ion-ios-minus-empty" title="ion-ios-minus-empty"></h1></li>
		<li class="text-center box" rel="ion-ios-minus-outline" tags="ion-ios-minus-outline hide, remove, minimize, -"> <h1 class="icon ion-ios-minus-outline" title="ion-ios-minus-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-minus" tags="ion-ios-minus hide, remove, minimize, -"> <h1 class="icon ion-ios-minus" title="ion-ios-minus"></h1></li>
		<li class="text-center box" rel="ion-ios-information-empty" tags="ion-ios-information-empty help, question"> <h1 class="icon ion-ios-information-empty" title="ion-ios-information-empty"></h1></li>
		<li class="text-center box" rel="ion-ios-information-outline" tags="ion-ios-information-outline help, question"> <h1 class="icon ion-ios-information-outline" title="ion-ios-information-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-information" tags="ion-ios-information help, question"> <h1 class="icon ion-ios-information" title="ion-ios-information"></h1></li>
		<li class="text-center box" rel="ion-ios-help-empty" tags="ion-ios-help-empty question, information, ?"> <h1 class="icon ion-ios-help-empty" title="ion-ios-help-empty"></h1></li>
		<li class="text-center box" rel="ion-ios-help-outline" tags="ion-ios-help-outline question, information, ?"> <h1 class="icon ion-ios-help-outline" title="ion-ios-help-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-help" tags="ion-ios-help question, information, ?"> <h1 class="icon ion-ios-help" title="ion-ios-help"></h1></li>
		<li class="text-center box" rel="ion-ios-search" tags="ion-ios-search find, seek, look, magnifying glass"> <h1 class="icon ion-ios-search" title="ion-ios-search"></h1></li>
		<li class="text-center box" rel="ion-ios-search-strong" tags="ion-ios-search-strong find, seek, look, magnifying glass"> <h1 class="icon ion-ios-search-strong" title="ion-ios-search-strong"></h1></li>
		<li class="text-center box" rel="ion-ios-star" tags="ion-ios-star favorite, rate"> <h1 class="icon ion-ios-star" title="ion-ios-star"></h1></li>
		<li class="text-center box" rel="ion-ios-star-half" tags="ion-ios-star-half favorite, rate"> <h1 class="icon ion-ios-star-half" title="ion-ios-star-half"></h1></li>
		<li class="text-center box" rel="ion-ios-star-outline" tags="ion-ios-star-outline favorite, rate"> <h1 class="icon ion-ios-star-outline" title="ion-ios-star-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-heart" tags="ion-ios-heart love"> <h1 class="icon ion-ios-heart" title="ion-ios-heart"></h1></li>
		<li class="text-center box" rel="ion-ios-heart-outline" tags="ion-ios-heart-outline love"> <h1 class="icon ion-ios-heart-outline" title="ion-ios-heart-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-more" tags="ion-ios-more menu"> <h1 class="icon ion-ios-more" title="ion-ios-more"></h1></li>
		<li class="text-center box" rel="ion-ios-more-outline" tags="ion-ios-more-outline menu"> <h1 class="icon ion-ios-more-outline" title="ion-ios-more-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-home" tags="ion-ios-home house"> <h1 class="icon ion-ios-home" title="ion-ios-home"></h1></li>
		<li class="text-center box" rel="ion-ios-home-outline" tags="ion-ios-home-outline house"> <h1 class="icon ion-ios-home-outline" title="ion-ios-home-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-cloud" tags="ion-ios-cloud storage, weather, whether"> <h1 class="icon ion-ios-cloud" title="ion-ios-cloud"></h1></li>
		<li class="text-center box" rel="ion-ios-cloud-outline" tags="ion-ios-cloud-outline storage, weather, whether"> <h1 class="icon ion-ios-cloud-outline" title="ion-ios-cloud-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-cloud-upload" tags="ion-ios-cloud-upload storage"> <h1 class="icon ion-ios-cloud-upload" title="ion-ios-cloud-upload"></h1></li>
		<li class="text-center box" rel="ion-ios-cloud-upload-outline" tags="ion-ios-cloud-upload-outline storage"> <h1 class="icon ion-ios-cloud-upload-outline" title="ion-ios-cloud-upload-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-cloud-download" tags="ion-ios-cloud-download storage"> <h1 class="icon ion-ios-cloud-download" title="ion-ios-cloud-download"></h1></li>
		<li class="text-center box" rel="ion-ios-cloud-download-outline" tags="ion-ios-cloud-download-outline storage"> <h1 class="icon ion-ios-cloud-download-outline" title="ion-ios-cloud-download-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-upload" tags="ion-ios-upload share, import"> <h1 class="icon ion-ios-upload" title="ion-ios-upload"></h1></li>
		<li class="text-center box" rel="ion-ios-upload-outline" tags="ion-ios-upload-outline share, import"> <h1 class="icon ion-ios-upload-outline" title="ion-ios-upload-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-download" tags="ion-ios-download save, export"> <h1 class="icon ion-ios-download" title="ion-ios-download"></h1></li>
		<li class="text-center box" rel="ion-ios-download-outline" tags="ion-ios-download-outline save, export"> <h1 class="icon ion-ios-download-outline" title="ion-ios-download-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-refresh" tags="ion-ios-refresh reload, renew, reset"> <h1 class="icon ion-ios-refresh" title="ion-ios-refresh"></h1></li>
		<li class="text-center box" rel="ion-ios-refresh-outline" tags="ion-ios-refresh-outline reload, renew, reset"> <h1 class="icon ion-ios-refresh-outline" title="ion-ios-refresh-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-refresh-empty" tags="ion-ios-refresh-empty reload, renew"> <h1 class="icon ion-ios-refresh-empty" title="ion-ios-refresh-empty"></h1></li>
		<li class="text-center box" rel="ion-ios-reload" tags="ion-ios-reload renew, reset"> <h1 class="icon ion-ios-reload" title="ion-ios-reload"></h1></li>
		<li class="text-center box" rel="ion-ios-loop-strong" tags="ion-ios-loop-strong reload, renew, reset"> <h1 class="icon ion-ios-loop-strong" title="ion-ios-loop-strong"></h1></li>
		<li class="text-center box" rel="ion-ios-loop" tags="ion-ios-loop reload, renew, reset"> <h1 class="icon ion-ios-loop" title="ion-ios-loop"></h1></li>
		<li class="text-center box" rel="ion-ios-bookmarks" tags="ion-ios-bookmarks favorite"> <h1 class="icon ion-ios-bookmarks" title="ion-ios-bookmarks"></h1></li>
		<li class="text-center box" rel="ion-ios-bookmarks-outline" tags="ion-ios-bookmarks-outline favorite"> <h1 class="icon ion-ios-bookmarks-outline" title="ion-ios-bookmarks-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-book" tags="ion-ios-book favorite, read, literature"> <h1 class="icon ion-ios-book" title="ion-ios-book"></h1></li>
		<li class="text-center box" rel="ion-ios-book-outline" tags="ion-ios-book-outline favorite, read, literature"> <h1 class="icon ion-ios-book-outline" title="ion-ios-book-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-flag" tags="ion-ios-flag marker, favorite"> <h1 class="icon ion-ios-flag" title="ion-ios-flag"></h1></li>
		<li class="text-center box" rel="ion-ios-flag-outline" tags="ion-ios-flag-outline marker, favorite"> <h1 class="icon ion-ios-flag-outline" title="ion-ios-flag-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-glasses" tags="ion-ios-glasses steve, reading, look, see"> <h1 class="icon ion-ios-glasses" title="ion-ios-glasses"></h1></li>
		<li class="text-center box" rel="ion-ios-glasses-outline" tags="ion-ios-glasses-outline steve, reading, look, see"> <h1 class="icon ion-ios-glasses-outline" title="ion-ios-glasses-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-browsers" tags="ion-ios-browsers square"> <h1 class="icon ion-ios-browsers" title="ion-ios-browsers"></h1></li>
		<li class="text-center box" rel="ion-ios-browsers-outline" tags="ion-ios-browsers-outline square"> <h1 class="icon ion-ios-browsers-outline" title="ion-ios-browsers-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-at" tags="ion-ios-at @"> <h1 class="icon ion-ios-at" title="ion-ios-at"></h1></li>
		<li class="text-center box" rel="ion-ios-at-outline" tags="ion-ios-at-outline @"> <h1 class="icon ion-ios-at-outline" title="ion-ios-at-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-pricetag" tags="ion-ios-pricetag shopping, money, items, commerce, $"> <h1 class="icon ion-ios-pricetag" title="ion-ios-pricetag"></h1></li>
		<li class="text-center box" rel="ion-ios-pricetag-outline" tags="ion-ios-pricetag-outline shopping, money, items, commerce, $"> <h1 class="icon ion-ios-pricetag-outline" title="ion-ios-pricetag-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-pricetags" tags="ion-ios-pricetags shopping, money, items, commerce, $"> <h1 class="icon ion-ios-pricetags" title="ion-ios-pricetags"></h1></li>
		<li class="text-center box" rel="ion-ios-pricetags-outline" tags="ion-ios-pricetags-outline shopping, money, items, commerce, $"> <h1 class="icon ion-ios-pricetags-outline" title="ion-ios-pricetags-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-cart" tags="ion-ios-cart shopping, money, items, commerce, $"> <h1 class="icon ion-ios-cart" title="ion-ios-cart"></h1></li>
		<li class="text-center box" rel="ion-ios-cart-outline" tags="ion-ios-cart-outline shopping, money, items, commerce, $"> <h1 class="icon ion-ios-cart-outline" title="ion-ios-cart-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-chatboxes" tags="ion-ios-chatboxes talk"> <h1 class="icon ion-ios-chatboxes" title="ion-ios-chatboxes"></h1></li>
		<li class="text-center box" rel="ion-ios-chatboxes-outline" tags="ion-ios-chatboxes-outline talk"> <h1 class="icon ion-ios-chatboxes-outline" title="ion-ios-chatboxes-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-chatbubble" tags="ion-ios-chatbubble talk"> <h1 class="icon ion-ios-chatbubble" title="ion-ios-chatbubble"></h1></li>
		<li class="text-center box" rel="ion-ios-chatbubble-outline" tags="ion-ios-chatbubble-outline talk"> <h1 class="icon ion-ios-chatbubble-outline" title="ion-ios-chatbubble-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-cog" tags="ion-ios-cog settings, gear, options"> <h1 class="icon ion-ios-cog" title="ion-ios-cog"></h1></li>
		<li class="text-center box" rel="ion-ios-cog-outline" tags="ion-ios-cog-outline settings, gear, options"> <h1 class="icon ion-ios-cog-outline" title="ion-ios-cog-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-gear" tags="ion-ios-gear cog, settings, options"> <h1 class="icon ion-ios-gear" title="ion-ios-gear"></h1></li>
		<li class="text-center box" rel="ion-ios-gear-outline" tags="ion-ios-gear-outline cog, settings, options"> <h1 class="icon ion-ios-gear-outline" title="ion-ios-gear-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-settings" tags="ion-ios-settings cog, settings, options"> <h1 class="icon ion-ios-settings" title="ion-ios-settings"></h1></li>
		<li class="text-center box" rel="ion-ios-settings-strong" tags="ion-ios-settings-strong cog, settings, options"> <h1 class="icon ion-ios-settings-strong" title="ion-ios-settings-strong"></h1></li>
		<li class="text-center box" rel="ion-ios-toggle" tags="ion-ios-toggle settings, options, switch"> <h1 class="icon ion-ios-toggle" title="ion-ios-toggle"></h1></li>
		<li class="text-center box" rel="ion-ios-toggle-outline" tags="ion-ios-toggle-outline settings, options, switch"> <h1 class="icon ion-ios-toggle-outline" title="ion-ios-toggle-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-analytics" tags="ion-ios-analytics metrics, track, data"> <h1 class="icon ion-ios-analytics" title="ion-ios-analytics"></h1></li>
		<li class="text-center box" rel="ion-ios-analytics-outline" tags="ion-ios-analytics-outline metrics, track, data"> <h1 class="icon ion-ios-analytics-outline" title="ion-ios-analytics-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-pie" tags="ion-ios-pie cog, settings, options"> <h1 class="icon ion-ios-pie" title="ion-ios-pie"></h1></li>
		<li class="text-center box" rel="ion-ios-pie-outline" tags="ion-ios-pie-outline cog, settings, options"> <h1 class="icon ion-ios-pie-outline" title="ion-ios-pie-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-pulse" tags="ion-ios-pulse live, hot, rate"> <h1 class="icon ion-ios-pulse" title="ion-ios-pulse"></h1></li>
		<li class="text-center box" rel="ion-ios-pulse-strong" tags="ion-ios-pulse-strong live, hot, rate"> <h1 class="icon ion-ios-pulse-strong" title="ion-ios-pulse-strong"></h1></li>
		<li class="text-center box" rel="ion-ios-filing" tags="ion-ios-filing archive"> <h1 class="icon ion-ios-filing" title="ion-ios-filing"></h1></li>
		<li class="text-center box" rel="ion-ios-filing-outline" tags="ion-ios-filing-outline archive"> <h1 class="icon ion-ios-filing-outline" title="ion-ios-filing-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-box" tags="ion-ios-box archive"> <h1 class="icon ion-ios-box" title="ion-ios-box"></h1></li>
		<li class="text-center box" rel="ion-ios-box-outline" tags="ion-ios-box-outline archive"> <h1 class="icon ion-ios-box-outline" title="ion-ios-box-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-compose" tags="ion-ios-compose write, type, create"> <h1 class="icon ion-ios-compose" title="ion-ios-compose"></h1></li>
		<li class="text-center box" rel="ion-ios-compose-outline" tags="ion-ios-compose-outline write, type, create"> <h1 class="icon ion-ios-compose-outline" title="ion-ios-compose-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-trash" tags="ion-ios-trash delete, remove, dispose, waste, basket, dump, kill"> <h1 class="icon ion-ios-trash" title="ion-ios-trash"></h1></li>
		<li class="text-center box" rel="ion-ios-trash-outline" tags="ion-ios-trash-outline delete, remove, dispose, waste, basket, dump, kill"> <h1 class="icon ion-ios-trash-outline" title="ion-ios-trash-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-copy" tags="ion-ios-copy duplicate, paper"> <h1 class="icon ion-ios-copy" title="ion-ios-copy"></h1></li>
		<li class="text-center box" rel="ion-ios-copy-outline" tags="ion-ios-copy-outline duplicate, paper"> <h1 class="icon ion-ios-copy-outline" title="ion-ios-copy-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-email" tags="ion-ios-email snail, mail"> <h1 class="icon ion-ios-email" title="ion-ios-email"></h1></li>
		<li class="text-center box" rel="ion-ios-email-outline" tags="ion-ios-email-outline snail, mail"> <h1 class="icon ion-ios-email-outline" title="ion-ios-email-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-undo" tags="ion-ios-undo reply"> <h1 class="icon ion-ios-undo" title="ion-ios-undo"></h1></li>
		<li class="text-center box" rel="ion-ios-undo-outline" tags="ion-ios-undo-outline reply"> <h1 class="icon ion-ios-undo-outline" title="ion-ios-undo-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-redo" tags="ion-ios-redo forward"> <h1 class="icon ion-ios-redo" title="ion-ios-redo"></h1></li>
		<li class="text-center box" rel="ion-ios-redo-outline" tags="ion-ios-redo-outline forward"> <h1 class="icon ion-ios-redo-outline" title="ion-ios-redo-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-paperplane" tags="ion-ios-paperplane send"> <h1 class="icon ion-ios-paperplane" title="ion-ios-paperplane"></h1></li>
		<li class="text-center box" rel="ion-ios-paperplane-outline" tags="ion-ios-paperplane-outline send"> <h1 class="icon ion-ios-paperplane-outline" title="ion-ios-paperplane-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-folder" tags="ion-ios-folder file"> <h1 class="icon ion-ios-folder" title="ion-ios-folder"></h1></li>
		<li class="text-center box" rel="ion-ios-folder-outline" tags="ion-ios-folder-outline file"> <h1 class="icon ion-ios-folder-outline" title="ion-ios-folder-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-paper" tags="ion-ios-paper feed, paper"> <h1 class="icon ion-ios-paper" title="ion-ios-paper"></h1></li>
		<li class="text-center box" rel="ion-ios-paper-outline" tags="ion-ios-paper-outline feed, paper"> <h1 class="icon ion-ios-paper-outline" title="ion-ios-paper-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-list" tags="ion-ios-list todo, feed, paper"> <h1 class="icon ion-ios-list" title="ion-ios-list"></h1></li>
		<li class="text-center box" rel="ion-ios-list-outline" tags="ion-ios-list-outline todo, feed, paper"> <h1 class="icon ion-ios-list-outline" title="ion-ios-list-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-world" tags="ion-ios-world globe, earth"> <h1 class="icon ion-ios-world" title="ion-ios-world"></h1></li>
		<li class="text-center box" rel="ion-ios-world-outline" tags="ion-ios-world-outline globe, earth"> <h1 class="icon ion-ios-world-outline" title="ion-ios-world-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-alarm" tags="ion-ios-alarm wake, ring"> <h1 class="icon ion-ios-alarm" title="ion-ios-alarm"></h1></li>
		<li class="text-center box" rel="ion-ios-alarm-outline" tags="ion-ios-alarm-outline wake, ring"> <h1 class="icon ion-ios-alarm-outline" title="ion-ios-alarm-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-speedometer" tags="ion-ios-speedometer speed, drive, level"> <h1 class="icon ion-ios-speedometer" title="ion-ios-speedometer"></h1></li>
		<li class="text-center box" rel="ion-ios-speedometer-outline" tags="ion-ios-speedometer-outline speed, drive, level"> <h1 class="icon ion-ios-speedometer-outline" title="ion-ios-speedometer-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-stopwatch" tags="ion-ios-stopwatch time, speed"> <h1 class="icon ion-ios-stopwatch" title="ion-ios-stopwatch"></h1></li>
		<li class="text-center box" rel="ion-ios-stopwatch-outline" tags="ion-ios-stopwatch-outline time, speed"> <h1 class="icon ion-ios-stopwatch-outline" title="ion-ios-stopwatch-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-timer" tags="ion-ios-timer cooking, alarm, buzz"> <h1 class="icon ion-ios-timer" title="ion-ios-timer"></h1></li>
		<li class="text-center box" rel="ion-ios-timer-outline" tags="ion-ios-timer-outline cooking, alarm, buzz"> <h1 class="icon ion-ios-timer-outline" title="ion-ios-timer-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-clock" tags="ion-ios-clock time, date, hours, minutes, seconds, watch"> <h1 class="icon ion-ios-clock" title="ion-ios-clock"></h1></li>
		<li class="text-center box" rel="ion-ios-clock-outline" tags="ion-ios-clock-outline time, date, hours, minutes, seconds, watch"> <h1 class="icon ion-ios-clock-outline" title="ion-ios-clock-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-time" tags="ion-ios-time clock, watch, hour, minute, second"> <h1 class="icon ion-ios-time" title="ion-ios-time"></h1></li>
		<li class="text-center box" rel="ion-ios-time-outline" tags="ion-ios-time-outline clock, watch, hour, minute, second"> <h1 class="icon ion-ios-time-outline" title="ion-ios-time-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-calendar" tags="ion-ios-calendar date, time, month, year"> <h1 class="icon ion-ios-calendar" title="ion-ios-calendar"></h1></li>
		<li class="text-center box" rel="ion-ios-calendar-outline" tags="ion-ios-calendar-outline date, time, month, year"> <h1 class="icon ion-ios-calendar-outline" title="ion-ios-calendar-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-photos" tags="ion-ios-photos images, stills, square"> <h1 class="icon ion-ios-photos" title="ion-ios-photos"></h1></li>
		<li class="text-center box" rel="ion-ios-photos-outline" tags="ion-ios-photos-outline images, stills, square"> <h1 class="icon ion-ios-photos-outline" title="ion-ios-photos-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-albums" tags="ion-ios-albums square, boxes, slides"> <h1 class="icon ion-ios-albums" title="ion-ios-albums"></h1></li>
		<li class="text-center box" rel="ion-ios-albums-outline" tags="ion-ios-albums-outline square, boxes, slides"> <h1 class="icon ion-ios-albums-outline" title="ion-ios-albums-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-camera" tags="ion-ios-camera picture"> <h1 class="icon ion-ios-camera" title="ion-ios-camera"></h1></li>
		<li class="text-center box" rel="ion-ios-camera-outline" tags="ion-ios-camera-outline picture"> <h1 class="icon ion-ios-camera-outline" title="ion-ios-camera-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-reverse-camera" tags="ion-ios-reverse-camera picture"> <h1 class="icon ion-ios-reverse-camera" title="ion-ios-reverse-camera"></h1></li>
		<li class="text-center box" rel="ion-ios-reverse-camera-outline" tags="ion-ios-reverse-camera-outline picture"> <h1 class="icon ion-ios-reverse-camera-outline" title="ion-ios-reverse-camera-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-eye" tags="ion-ios-eye view, see, exposed, look"> <h1 class="icon ion-ios-eye" title="ion-ios-eye"></h1></li>
		<li class="text-center box" rel="ion-ios-eye-outline" tags="ion-ios-eye-outline view, see, exposed, look"> <h1 class="icon ion-ios-eye-outline" title="ion-ios-eye-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-bolt" tags="ion-ios-bolt flash, lightning"> <h1 class="icon ion-ios-bolt" title="ion-ios-bolt"></h1></li>
		<li class="text-center box" rel="ion-ios-bolt-outline" tags="ion-ios-bolt-outline flash, lightning"> <h1 class="icon ion-ios-bolt-outline" title="ion-ios-bolt-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-color-wand" tags="ion-ios-color-wand camera, picture, edit, magic"> <h1 class="icon ion-ios-color-wand" title="ion-ios-color-wand"></h1></li>
		<li class="text-center box" rel="ion-ios-color-wand-outline" tags="ion-ios-color-wand-outline camera, picture, edit, magic"> <h1 class="icon ion-ios-color-wand-outline" title="ion-ios-color-wand-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-color-filter" tags="ion-ios-color-filter camera, picture"> <h1 class="icon ion-ios-color-filter" title="ion-ios-color-filter"></h1></li>
		<li class="text-center box" rel="ion-ios-color-filter-outline" tags="ion-ios-color-filter-outline camera, picture"> <h1 class="icon ion-ios-color-filter-outline" title="ion-ios-color-filter-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-grid-view" tags="ion-ios-grid-view camera, picture"> <h1 class="icon ion-ios-grid-view" title="ion-ios-grid-view"></h1></li>
		<li class="text-center box" rel="ion-ios-grid-view-outline" tags="ion-ios-grid-view-outline camera, picture"> <h1 class="icon ion-ios-grid-view-outline" title="ion-ios-grid-view-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-crop-strong" tags="ion-ios-crop-strong camera, picture, edit"> <h1 class="icon ion-ios-crop-strong" title="ion-ios-crop-strong"></h1></li>
		<li class="text-center box" rel="ion-ios-crop" tags="ion-ios-crop camera, picture, edit"> <h1 class="icon ion-ios-crop" title="ion-ios-crop"></h1></li>
		<li class="text-center box" rel="ion-ios-barcode" tags="ion-ios-barcode reader, camera"> <h1 class="icon ion-ios-barcode" title="ion-ios-barcode"></h1></li>
		<li class="text-center box" rel="ion-ios-barcode-outline" tags="ion-ios-barcode-outline reader, camera"> <h1 class="icon ion-ios-barcode-outline" title="ion-ios-barcode-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-briefcase" tags="ion-ios-briefcase organize, folder"> <h1 class="icon ion-ios-briefcase" title="ion-ios-briefcase"></h1></li>
		<li class="text-center box" rel="ion-ios-briefcase-outline" tags="ion-ios-briefcase-outline organize, folder"> <h1 class="icon ion-ios-briefcase-outline" title="ion-ios-briefcase-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-medkit" tags="ion-ios-medkit health, case, first aid, sick, disease"> <h1 class="icon ion-ios-medkit" title="ion-ios-medkit"></h1></li>
		<li class="text-center box" rel="ion-ios-medkit-outline" tags="ion-ios-medkit-outline health, case, first aid, sick, disease"> <h1 class="icon ion-ios-medkit-outline" title="ion-ios-medkit-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-medical" tags="ion-ios-medical health, case, first aid, sick, disease"> <h1 class="icon ion-ios-medical" title="ion-ios-medical"></h1></li>
		<li class="text-center box" rel="ion-ios-medical-outline" tags="ion-ios-medical-outline health, case, first aid, sick, disease"> <h1 class="icon ion-ios-medical-outline" title="ion-ios-medical-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-infinite" tags="ion-ios-infinite forever, loop"> <h1 class="icon ion-ios-infinite" title="ion-ios-infinite"></h1></li>
		<li class="text-center box" rel="ion-ios-infinite-outline" tags="ion-ios-infinite-outline forever, loop"> <h1 class="icon ion-ios-infinite-outline" title="ion-ios-infinite-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-calculator" tags="ion-ios-calculator math, arithmatic"> <h1 class="icon ion-ios-calculator" title="ion-ios-calculator"></h1></li>
		<li class="text-center box" rel="ion-ios-calculator-outline" tags="ion-ios-calculator-outline math, arithmatic"> <h1 class="icon ion-ios-calculator-outline" title="ion-ios-calculator-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-keypad" tags="ion-ios-keypad type, grid, circle"> <h1 class="icon ion-ios-keypad" title="ion-ios-keypad"></h1></li>
		<li class="text-center box" rel="ion-ios-keypad-outline" tags="ion-ios-keypad-outline type, grid, circle"> <h1 class="icon ion-ios-keypad-outline" title="ion-ios-keypad-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-telephone" tags="ion-ios-telephone oldschool, call"> <h1 class="icon ion-ios-telephone" title="ion-ios-telephone"></h1></li>
		<li class="text-center box" rel="ion-ios-telephone-outline" tags="ion-ios-telephone-outline oldschool, call"> <h1 class="icon ion-ios-telephone-outline" title="ion-ios-telephone-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-drag" tags="ion-ios-drag reorder, move, drag"> <h1 class="icon ion-ios-drag" title="ion-ios-drag"></h1></li>
		<li class="text-center box" rel="ion-ios-location" tags="ion-ios-location navigation, map, gps, pin"> <h1 class="icon ion-ios-location" title="ion-ios-location"></h1></li>
		<li class="text-center box" rel="ion-ios-location-outline" tags="ion-ios-location-outline navigation, map, gps, pin"> <h1 class="icon ion-ios-location-outline" title="ion-ios-location-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-navigate" tags="ion-ios-navigate location, map, gps, pin"> <h1 class="icon ion-ios-navigate" title="ion-ios-navigate"></h1></li>
		<li class="text-center box" rel="ion-ios-navigate-outline" tags="ion-ios-navigate-outline location, map, gps, pin"> <h1 class="icon ion-ios-navigate-outline" title="ion-ios-navigate-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-locked" tags="ion-ios-locked security, padlock, safe"> <h1 class="icon ion-ios-locked" title="ion-ios-locked"></h1></li>
		<li class="text-center box" rel="ion-ios-locked-outline" tags="ion-ios-locked-outline security, padlock, safe"> <h1 class="icon ion-ios-locked-outline" title="ion-ios-locked-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-unlocked" tags="ion-ios-unlocked security, padlock, safe"> <h1 class="icon ion-ios-unlocked" title="ion-ios-unlocked"></h1></li>
		<li class="text-center box" rel="ion-ios-unlocked-outline" tags="ion-ios-unlocked-outline security, padlock, safe"> <h1 class="icon ion-ios-unlocked-outline" title="ion-ios-unlocked-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-monitor" tags="ion-ios-monitor thunderbolt, display, screen"> <h1 class="icon ion-ios-monitor" title="ion-ios-monitor"></h1></li>
		<li class="text-center box" rel="ion-ios-monitor-outline" tags="ion-ios-monitor-outline thunderbolt, display, screen"> <h1 class="icon ion-ios-monitor-outline" title="ion-ios-monitor-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-printer" tags="ion-ios-printer paper"> <h1 class="icon ion-ios-printer" title="ion-ios-printer"></h1></li>
		<li class="text-center box" rel="ion-ios-printer-outline" tags="ion-ios-printer-outline paper"> <h1 class="icon ion-ios-printer-outline" title="ion-ios-printer-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-game-controller-a" tags="ion-ios-game-controller-a gaming, nintendo, play"> <h1 class="icon ion-ios-game-controller-a" title="ion-ios-game-controller-a"></h1></li>
		<li class="text-center box" rel="ion-ios-game-controller-a-outline" tags="ion-ios-game-controller-a-outline gaming, nintendo, play"> <h1 class="icon ion-ios-game-controller-a-outline" title="ion-ios-game-controller-a-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-game-controller-b" tags="ion-ios-game-controller-b gaming, nintendo, play"> <h1 class="icon ion-ios-game-controller-b" title="ion-ios-game-controller-b"></h1></li>
		<li class="text-center box" rel="ion-ios-game-controller-b-outline" tags="ion-ios-game-controller-b-outline gaming, nintendo, play"> <h1 class="icon ion-ios-game-controller-b-outline" title="ion-ios-game-controller-b-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-americanfootball" tags="ion-ios-americanfootball nfl, games, sports, fun, play"> <h1 class="icon ion-ios-americanfootball" title="ion-ios-americanfootball"></h1></li>
		<li class="text-center box" rel="ion-ios-americanfootball-outline" tags="ion-ios-americanfootball-outline nfl, games, sports, fun, play"> <h1 class="icon ion-ios-americanfootball-outline" title="ion-ios-americanfootball-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-baseball" tags="ion-ios-baseball mlb, games, sports, fun, play"> <h1 class="icon ion-ios-baseball" title="ion-ios-baseball"></h1></li>
		<li class="text-center box" rel="ion-ios-baseball-outline" tags="ion-ios-baseball-outline mlb, games, sports, fun, play"> <h1 class="icon ion-ios-baseball-outline" title="ion-ios-baseball-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-basketball" tags="ion-ios-basketball nba, games, sports, fun, play"> <h1 class="icon ion-ios-basketball" title="ion-ios-basketball"></h1></li>
		<li class="text-center box" rel="ion-ios-basketball-outline" tags="ion-ios-basketball-outline nba, games, sports, fun, play"> <h1 class="icon ion-ios-basketball-outline" title="ion-ios-basketball-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-tennisball" tags="ion-ios-tennisball games, sports, fun, play"> <h1 class="icon ion-ios-tennisball" title="ion-ios-tennisball"></h1></li>
		<li class="text-center box" rel="ion-ios-tennisball-outline" tags="ion-ios-tennisball-outline games, sports, fun, play"> <h1 class="icon ion-ios-tennisball-outline" title="ion-ios-tennisball-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-football" tags="ion-ios-football mls, soccer, games, sports, fun, play"> <h1 class="icon ion-ios-football" title="ion-ios-football"></h1></li>
		<li class="text-center box" rel="ion-ios-football-outline" tags="ion-ios-football-outline mls, soccer, games, sports, fun, play"> <h1 class="icon ion-ios-football-outline" title="ion-ios-football-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-body" tags="ion-ios-body person, users, staff, head, human"> <h1 class="icon ion-ios-body" title="ion-ios-body"></h1></li>
		<li class="text-center box" rel="ion-ios-body-outline" tags="ion-ios-body-outline person, users, staff, head, human"> <h1 class="icon ion-ios-body-outline" title="ion-ios-body-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-person" tags="ion-ios-person users, staff, head, human"> <h1 class="icon ion-ios-person" title="ion-ios-person"></h1></li>
		<li class="text-center box" rel="ion-ios-person-outline" tags="ion-ios-person-outline users, staff, head, human"> <h1 class="icon ion-ios-person-outline" title="ion-ios-person-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-personadd" tags="ion-ios-personadd users, staff, head, human, new, invite"> <h1 class="icon ion-ios-personadd" title="ion-ios-personadd"></h1></li>
		<li class="text-center box" rel="ion-ios-personadd-outline" tags="ion-ios-personadd-outline users, staff, head, human, new, invite"> <h1 class="icon ion-ios-personadd-outline" title="ion-ios-personadd-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-people" tags="ion-ios-people stalker, person, users, head, human"> <h1 class="icon ion-ios-people" title="ion-ios-people"></h1></li>
		<li class="text-center box" rel="ion-ios-people-outline" tags="ion-ios-people-outline stalker, person, users, head, human"> <h1 class="icon ion-ios-people-outline" title="ion-ios-people-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-musical-notes" tags="ion-ios-musical-notes sound, noise, listening, play"> <h1 class="icon ion-ios-musical-notes" title="ion-ios-musical-notes"></h1></li>
		<li class="text-center box" rel="ion-ios-musical-note" tags="ion-ios-musical-note sound, noise, listening, play"> <h1 class="icon ion-ios-musical-note" title="ion-ios-musical-note"></h1></li>
		<li class="text-center box" rel="ion-ios-bell" tags="ion-ios-bell right, noise, alarm, sound, music"> <h1 class="icon ion-ios-bell" title="ion-ios-bell"></h1></li>
		<li class="text-center box" rel="ion-ios-bell-outline" tags="ion-ios-bell-outline right, noise, alarm, sound, music"> <h1 class="icon ion-ios-bell-outline" title="ion-ios-bell-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-mic" tags="ion-ios-mic sound, noise, speaker, talk"> <h1 class="icon ion-ios-mic" title="ion-ios-mic"></h1></li>
		<li class="text-center box" rel="ion-ios-mic-outline" tags="ion-ios-mic-outline sound, noise, speaker, talk"> <h1 class="icon ion-ios-mic-outline" title="ion-ios-mic-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-mic-off" tags="ion-ios-mic-off sound, noise, speaker, talk"> <h1 class="icon ion-ios-mic-off" title="ion-ios-mic-off"></h1></li>
		<li class="text-center box" rel="ion-ios-volume-high" tags="ion-ios-volume-high sound, noise, listen, music"> <h1 class="icon ion-ios-volume-high" title="ion-ios-volume-high"></h1></li>
		<li class="text-center box" rel="ion-ios-volume-low" tags="ion-ios-volume-low sound, noise, listen, music"> <h1 class="icon ion-ios-volume-low" title="ion-ios-volume-low"></h1></li>
		<li class="text-center box" rel="ion-ios-play" tags="ion-ios-play music, watch, arrow, right"> <h1 class="icon ion-ios-play" title="ion-ios-play"></h1></li>
		<li class="text-center box" rel="ion-ios-play-outline" tags="ion-ios-play-outline music, watch, arrow, right"> <h1 class="icon ion-ios-play-outline" title="ion-ios-play-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-pause" tags="ion-ios-pause music, break, hold, freeze"> <h1 class="icon ion-ios-pause" title="ion-ios-pause"></h1></li>
		<li class="text-center box" rel="ion-ios-pause-outline" tags="ion-ios-pause-outline music, break, hold, freeze"> <h1 class="icon ion-ios-pause-outline" title="ion-ios-pause-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-recording" tags="ion-ios-recording film, tape, voicemail"> <h1 class="icon ion-ios-recording" title="ion-ios-recording"></h1></li>
		<li class="text-center box" rel="ion-ios-recording-outline" tags="ion-ios-recording-outline film, tape, voicemail"> <h1 class="icon ion-ios-recording-outline" title="ion-ios-recording-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-fastforward" tags="ion-ios-fastforward next, skip, jump"> <h1 class="icon ion-ios-fastforward" title="ion-ios-fastforward"></h1></li>
		<li class="text-center box" rel="ion-ios-fastforward-outline" tags="ion-ios-fastforward-outline next, skip, jump"> <h1 class="icon ion-ios-fastforward-outline" title="ion-ios-fastforward-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-rewind" tags="ion-ios-rewind music, previous, back"> <h1 class="icon ion-ios-rewind" title="ion-ios-rewind"></h1></li>
		<li class="text-center box" rel="ion-ios-rewind-outline" tags="ion-ios-rewind-outline music, previous, back"> <h1 class="icon ion-ios-rewind-outline" title="ion-ios-rewind-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-skipbackward" tags="ion-ios-skipbackward music, previous"> <h1 class="icon ion-ios-skipbackward" title="ion-ios-skipbackward"></h1></li>
		<li class="text-center box" rel="ion-ios-skipbackward-outline" tags="ion-ios-skipbackward-outline music, previous"> <h1 class="icon ion-ios-skipbackward-outline" title="ion-ios-skipbackward-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-skipforward" tags="ion-ios-skipforward music, next"> <h1 class="icon ion-ios-skipforward" title="ion-ios-skipforward"></h1></li>
		<li class="text-center box" rel="ion-ios-skipforward-outline" tags="ion-ios-skipforward-outline music, next"> <h1 class="icon ion-ios-skipforward-outline" title="ion-ios-skipforward-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-shuffle-strong" tags="ion-ios-shuffle-strong music, next"> <h1 class="icon ion-ios-shuffle-strong" title="ion-ios-shuffle-strong"></h1></li>
		<li class="text-center box" rel="ion-ios-shuffle" tags="ion-ios-shuffle music, next"> <h1 class="icon ion-ios-shuffle" title="ion-ios-shuffle"></h1></li>
		<li class="text-center box" rel="ion-ios-videocam" tags="ion-ios-videocam film, movie, camera"> <h1 class="icon ion-ios-videocam" title="ion-ios-videocam"></h1></li>
		<li class="text-center box" rel="ion-ios-videocam-outline" tags="ion-ios-videocam-outline film, movie, camera"> <h1 class="icon ion-ios-videocam-outline" title="ion-ios-videocam-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-film" tags="ion-ios-film film, movie, camera"> <h1 class="icon ion-ios-film" title="ion-ios-film"></h1></li>
		<li class="text-center box" rel="ion-ios-film-outline" tags="ion-ios-film-outline film, movie, camera"> <h1 class="icon ion-ios-film-outline" title="ion-ios-film-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-flask" tags="ion-ios-flask options, mixer, liquid"> <h1 class="icon ion-ios-flask" title="ion-ios-flask"></h1></li>
		<li class="text-center box" rel="ion-ios-flask-outline" tags="ion-ios-flask-outline options, mixer, liquid"> <h1 class="icon ion-ios-flask-outline" title="ion-ios-flask-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-lightbulb" tags="ion-ios-lightbulb idea, new, bright, aha!"> <h1 class="icon ion-ios-lightbulb" title="ion-ios-lightbulb"></h1></li>
		<li class="text-center box" rel="ion-ios-lightbulb-outline" tags="ion-ios-lightbulb-outline idea, new, bright, aha!"> <h1 class="icon ion-ios-lightbulb-outline" title="ion-ios-lightbulb-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-wineglass" tags="ion-ios-wineglass alcohol, drink, food, glass, drunk, cheers"> <h1 class="icon ion-ios-wineglass" title="ion-ios-wineglass"></h1></li>
		<li class="text-center box" rel="ion-ios-wineglass-outline" tags="ion-ios-wineglass-outline alcohol, drink, food, glass, drunk, cheers"> <h1 class="icon ion-ios-wineglass-outline" title="ion-ios-wineglass-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-pint" tags="ion-ios-pint alcohol, drink, food, beer, drunk, cheers"> <h1 class="icon ion-ios-pint" title="ion-ios-pint"></h1></li>
		<li class="text-center box" rel="ion-ios-pint-outline" tags="ion-ios-pint-outline alcohol, drink, food, beer, drunk, cheers"> <h1 class="icon ion-ios-pint-outline" title="ion-ios-pint-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-nutrition" tags="ion-ios-nutrition health, carrot, food"> <h1 class="icon ion-ios-nutrition" title="ion-ios-nutrition"></h1></li>
		<li class="text-center box" rel="ion-ios-nutrition-outline" tags="ion-ios-nutrition-outline health, carrot, food"> <h1 class="icon ion-ios-nutrition-outline" title="ion-ios-nutrition-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-flower" tags="ion-ios-flower nature, spring, leaf, garden"> <h1 class="icon ion-ios-flower" title="ion-ios-flower"></h1></li>
		<li class="text-center box" rel="ion-ios-flower-outline" tags="ion-ios-flower-outline nature, spring, leaf, garden"> <h1 class="icon ion-ios-flower-outline" title="ion-ios-flower-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-rose" tags="ion-ios-rose nature, spring, leaf, garden, flower"> <h1 class="icon ion-ios-rose" title="ion-ios-rose"></h1></li>
		<li class="text-center box" rel="ion-ios-rose-outline" tags="ion-ios-rose-outline nature, spring, leaf, garden, flower"> <h1 class="icon ion-ios-rose-outline" title="ion-ios-rose-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-paw" tags="ion-ios-paw nature, animal, pet, outdoor, track"> <h1 class="icon ion-ios-paw" title="ion-ios-paw"></h1></li>
		<li class="text-center box" rel="ion-ios-paw-outline" tags="ion-ios-paw-outline nature, animal, pet, outdoor, track"> <h1 class="icon ion-ios-paw-outline" title="ion-ios-paw-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-flame" tags="ion-ios-flame fire, hot, burn"> <h1 class="icon ion-ios-flame" title="ion-ios-flame"></h1></li>
		<li class="text-center box" rel="ion-ios-flame-outline" tags="ion-ios-flame-outline fire, hot, burn"> <h1 class="icon ion-ios-flame-outline" title="ion-ios-flame-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-sunny" tags="ion-ios-sunny weather, whether, light, sky"> <h1 class="icon ion-ios-sunny" title="ion-ios-sunny"></h1></li>
		<li class="text-center box" rel="ion-ios-sunny-outline" tags="ion-ios-sunny-outline weather, whether, light, sky"> <h1 class="icon ion-ios-sunny-outline" title="ion-ios-sunny-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-partlysunny" tags="ion-ios-partlysunny light, weather, whether, cloudy"> <h1 class="icon ion-ios-partlysunny" title="ion-ios-partlysunny"></h1></li>
		<li class="text-center box" rel="ion-ios-partlysunny-outline" tags="ion-ios-partlysunny-outline light, weather, whether, cloudy"> <h1 class="icon ion-ios-partlysunny-outline" title="ion-ios-partlysunny-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-cloudy" tags="ion-ios-cloudy weather, whether, overcast"> <h1 class="icon ion-ios-cloudy" title="ion-ios-cloudy"></h1></li>
		<li class="text-center box" rel="ion-ios-cloudy-outline" tags="ion-ios-cloudy-outline weather, whether, overcast"> <h1 class="icon ion-ios-cloudy-outline" title="ion-ios-cloudy-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-rainy" tags="ion-ios-rainy whether, weather, water, cloud"> <h1 class="icon ion-ios-rainy" title="ion-ios-rainy"></h1></li>
		<li class="text-center box" rel="ion-ios-rainy-outline" tags="ion-ios-rainy-outline whether, weather, water, cloud"> <h1 class="icon ion-ios-rainy-outline" title="ion-ios-rainy-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-thunderstorm" tags="ion-ios-thunderstorm whether, weather, sky, lightning, rain, cloudy, overcast, storm"> <h1 class="icon ion-ios-thunderstorm" title="ion-ios-thunderstorm"></h1></li>
		<li class="text-center box" rel="ion-ios-thunderstorm-outline" tags="ion-ios-thunderstorm-outline whether, weather, sky, lightning, rain, cloudy, overcast, storm"> <h1 class="icon ion-ios-thunderstorm-outline" title="ion-ios-thunderstorm-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-snowy" tags="ion-ios-snowy cold, weather, whether, overcast"> <h1 class="icon ion-ios-snowy" title="ion-ios-snowy"></h1></li>
		<li class="text-center box" rel="ion-ios-moon" tags="ion-ios-moon sky, night, dark"> <h1 class="icon ion-ios-moon" title="ion-ios-moon"></h1></li>
		<li class="text-center box" rel="ion-ios-moon-outline" tags="ion-ios-moon-outline sky, night, dark"> <h1 class="icon ion-ios-moon-outline" title="ion-ios-moon-outline"></h1></li>
		<li class="text-center box" rel="ion-ios-cloudy-night" tags="ion-ios-cloudy-night weather, whether, overcast"> <h1 class="icon ion-ios-cloudy-night" title="ion-ios-cloudy-night"></h1></li>
		<li class="text-center box" rel="ion-ios-cloudy-night-outline" tags="ion-ios-cloudy-night-outline weather, whether, overcast"> <h1 class="icon ion-ios-cloudy-night-outline" title="ion-ios-cloudy-night-outline"></h1></li>
		<li class="text-center box" rel="ion-android-arrow-up" tags="ion-android-arrow-up chevron, navigation"> <h1 class="icon ion-android-arrow-up" title="ion-android-arrow-up"></h1></li>
		<li class="text-center box" rel="ion-android-arrow-forward" tags="ion-android-arrow-forward chevron, navigation"> <h1 class="icon ion-android-arrow-forward" title="ion-android-arrow-forward"></h1></li>
		<li class="text-center box" rel="ion-android-arrow-down" tags="ion-android-arrow-down chevron, navigation"> <h1 class="icon ion-android-arrow-down" title="ion-android-arrow-down"></h1></li>
		<li class="text-center box" rel="ion-android-arrow-back" tags="ion-android-arrow-back chevron, navigation"> <h1 class="icon ion-android-arrow-back" title="ion-android-arrow-back"></h1></li>
		<li class="text-center box" rel="ion-android-arrow-dropup" tags="ion-android-arrow-dropup chevron, navigation"> <h1 class="icon ion-android-arrow-dropup" title="ion-android-arrow-dropup"></h1></li>
		<li class="text-center box" rel="ion-android-arrow-dropup-circle" tags="ion-android-arrow-dropup-circle chevron, navigation"> <h1 class="icon ion-android-arrow-dropup-circle" title="ion-android-arrow-dropup-circle"></h1></li>
		<li class="text-center box" rel="ion-android-arrow-dropright" tags="ion-android-arrow-dropright chevron, navigation"> <h1 class="icon ion-android-arrow-dropright" title="ion-android-arrow-dropright"></h1></li>
		<li class="text-center box" rel="ion-android-arrow-dropright-circle" tags="ion-android-arrow-dropright-circle chevron, navigation"> <h1 class="icon ion-android-arrow-dropright-circle" title="ion-android-arrow-dropright-circle"></h1></li>
		<li class="text-center box" rel="ion-android-arrow-dropdown" tags="ion-android-arrow-dropdown chevron, navigation"> <h1 class="icon ion-android-arrow-dropdown" title="ion-android-arrow-dropdown"></h1></li>
		<li class="text-center box" rel="ion-android-arrow-dropdown-circle" tags="ion-android-arrow-dropdown-circle chevron, navigation"> <h1 class="icon ion-android-arrow-dropdown-circle" title="ion-android-arrow-dropdown-circle"></h1></li>
		<li class="text-center box" rel="ion-android-arrow-dropleft" tags="ion-android-arrow-dropleft chevron, navigation"> <h1 class="icon ion-android-arrow-dropleft" title="ion-android-arrow-dropleft"></h1></li>
		<li class="text-center box" rel="ion-android-arrow-dropleft-circle" tags="ion-android-arrow-dropleft-circle chevron, navigation"> <h1 class="icon ion-android-arrow-dropleft-circle" title="ion-android-arrow-dropleft-circle"></h1></li>
		<li class="text-center box" rel="ion-android-add" tags="ion-android-add plus, include, invite"> <h1 class="icon ion-android-add" title="ion-android-add"></h1></li>
		<li class="text-center box" rel="ion-android-add-circle" tags="ion-android-add-circle plus, include, invite"> <h1 class="icon ion-android-add-circle" title="ion-android-add-circle"></h1></li>
		<li class="text-center box" rel="ion-android-remove" tags="ion-android-remove minus, subtract, delete"> <h1 class="icon ion-android-remove" title="ion-android-remove"></h1></li>
		<li class="text-center box" rel="ion-android-remove-circle" tags="ion-android-remove-circle minus, subtract, delete"> <h1 class="icon ion-android-remove-circle" title="ion-android-remove-circle"></h1></li>
		<li class="text-center box" rel="ion-android-close" tags="ion-android-close delete, remove"> <h1 class="icon ion-android-close" title="ion-android-close"></h1></li>
		<li class="text-center box" rel="ion-android-cancel" tags="ion-android-cancel delete, remove"> <h1 class="icon ion-android-cancel" title="ion-android-cancel"></h1></li>
		<li class="text-center box" rel="ion-android-radio-button-off" tags="ion-android-radio-button-off options, menu"> <h1 class="icon ion-android-radio-button-off" title="ion-android-radio-button-off"></h1></li>
		<li class="text-center box" rel="ion-android-more-vertical" tags="ion-android-more-vertical options, menu"> <h1 class="icon ion-android-more-vertical" title="ion-android-more-vertical"></h1></li>
		<li class="text-center box" rel="ion-android-refresh" tags="ion-android-refresh internet,connection, bars"> <h1 class="icon ion-android-refresh" title="ion-android-refresh"></h1></li>
		<li class="text-center box" rel="ion-android-call" tags="ion-android-call telephone"> <h1 class="icon ion-android-call" title="ion-android-call"></h1></li>
		<li class="text-center box" rel="ion-android-apps" tags="ion-android-apps options"> <h1 class="icon ion-android-apps" title="ion-android-apps"></h1></li>
		<li class="text-center box" rel="ion-android-options" tags="ion-android-options settings, mixer"> <h1 class="icon ion-android-options" title="ion-android-options"></h1></li>
		<li class="text-center box" rel="ion-android-funnel" tags="ion-android-funnel magnifying glass"> <h1 class="icon ion-android-funnel" title="ion-android-funnel"></h1></li>
		<li class="text-center box" rel="ion-android-home" tags="ion-android-home favorite, like, rate"> <h1 class="icon ion-android-home" title="ion-android-home"></h1></li>
		<li class="text-center box" rel="ion-android-favorite" tags="ion-android-favorite favorite, like, rate"> <h1 class="icon ion-android-favorite" title="ion-android-favorite"></h1></li>
		<li class="text-center box" rel="ion-android-star-outline" tags="ion-android-star-outline favorite, like, rate"> <h1 class="icon ion-android-star-outline" title="ion-android-star-outline"></h1></li>
		<li class="text-center box" rel="ion-android-star-half" tags="ion-android-star-half favorite, like, rate"> <h1 class="icon ion-android-star-half" title="ion-android-star-half"></h1></li>
		<li class="text-center box" rel="ion-android-star" tags="ion-android-star favorite, like, rate"> <h1 class="icon ion-android-star" title="ion-android-star"></h1></li>
		<li class="text-center box" rel="ion-android-calendar" tags="ion-android-calendar clock"> <h1 class="icon ion-android-calendar" title="ion-android-calendar"></h1></li>
		<li class="text-center box" rel="ion-android-alarm-clock" tags="ion-android-alarm-clock clock"> <h1 class="icon ion-android-alarm-clock" title="ion-android-alarm-clock"></h1></li>
		<li class="text-center box" rel="ion-android-time" tags="ion-android-time clock"> <h1 class="icon ion-android-time" title="ion-android-time"></h1></li>
		<li class="text-center box" rel="ion-android-stopwatch" tags="ion-android-stopwatch move, bike, transportation, maps"> <h1 class="icon ion-android-stopwatch" title="ion-android-stopwatch"></h1></li>
		<li class="text-center box" rel="ion-android-car" tags="ion-android-car wine, drink, food, dinner"> <h1 class="icon ion-android-car" title="ion-android-car"></h1></li>
		<li class="text-center box" rel="ion-android-cart" tags="ion-android-cart talk, text"> <h1 class="icon ion-android-cart" title="ion-android-cart"></h1></li>
		<li class="text-center box" rel="ion-android-textsms" tags="ion-android-textsms talk, text"> <h1 class="icon ion-android-textsms" title="ion-android-textsms"></h1></li>
		<li class="text-center box" rel="ion-android-hangout" tags="ion-android-hangout recorder, speak, noise, music, sound"> <h1 class="icon ion-android-hangout" title="ion-android-hangout"></h1></li>
		<li class="text-center box" rel="ion-android-microphone-off" tags="ion-android-microphone-off recorder, speak, noise, music, sound, mute"> <h1 class="icon ion-android-microphone-off" title="ion-android-microphone-off"></h1></li>
		<li class="text-center box" rel="ion-android-notifications-none" tags="ion-android-notifications-none stop"> <h1 class="icon ion-android-notifications-none" title="ion-android-notifications-none"></h1></li>
		<li class="text-center box" rel="ion-android-desktop" tags="ion-android-desktop follow, post, share"> <h1 class="icon ion-android-desktop" title="ion-android-desktop"></h1></li>
		<li class="text-center box" rel="ion-social-twitter-outline" tags="ion-social-twitter-outline follow, post, share"> <h1 class="icon ion-social-twitter-outline" title="ion-social-twitter-outline"></h1></li>
		<li class="text-center box" rel="ion-social-facebook" tags="ion-social-facebook like, post, share"> <h1 class="icon ion-social-facebook" title="ion-social-facebook"></h1></li>
		<li class="text-center box" rel="ion-social-facebook-outline" tags="ion-social-facebook-outline like, post, share"> <h1 class="icon ion-social-facebook-outline" title="ion-social-facebook-outline"></h1></li>
		<li class="text-center box" rel="ion-social-googleplus" tags="ion-social-googleplus follow, post, share"> <h1 class="icon ion-social-googleplus" title="ion-social-googleplus"></h1></li>
		<li class="text-center box" rel="ion-social-googleplus-outline" tags="ion-social-googleplus-outline follow, post, share"> <h1 class="icon ion-social-googleplus-outline" title="ion-social-googleplus-outline"></h1></li>
		<li class="text-center box" rel="ion-social-google" tags="ion-social-google follow, post, share"> <h1 class="icon ion-social-google" title="ion-social-google"></h1></li>
		<li class="text-center box" rel="ion-social-google-outline" tags="ion-social-google-outline follow, post, share"> <h1 class="icon ion-social-google-outline" title="ion-social-google-outline"></h1></li>
		<li class="text-center box" rel="ion-social-dribbble" tags="ion-social-dribbble design"> <h1 class="icon ion-social-dribbble" title="ion-social-dribbble"></h1></li>
		<li class="text-center box" rel="ion-social-dribbble-outline" tags="ion-social-dribbble-outline design"> <h1 class="icon ion-social-dribbble-outline" title="ion-social-dribbble-outline"></h1></li>
		<li class="text-center box" rel="ion-social-octocat" tags="ion-social-octocat code, github, fork, merge, clone"> <h1 class="icon ion-social-octocat" title="ion-social-octocat"></h1></li>
		<li class="text-center box" rel="ion-social-github" tags="ion-social-github code, fork, merge, clone"> <h1 class="icon ion-social-github" title="ion-social-github"></h1></li>
		<li class="text-center box" rel="ion-social-github-outline" tags="ion-social-github-outline code, fork, merge, clone"> <h1 class="icon ion-social-github-outline" title="ion-social-github-outline"></h1></li>
		<li class="text-center box" rel="ion-social-instagram" tags="ion-social-instagram photo, camera, facebook"> <h1 class="icon ion-social-instagram" title="ion-social-instagram"></h1></li>
		<li class="text-center box" rel="ion-social-instagram-outline" tags="ion-social-instagram-outline photo, camera, facebook"> <h1 class="icon ion-social-instagram-outline" title="ion-social-instagram-outline"></h1></li>
		<li class="text-center box" rel="ion-social-whatsapp" tags="ion-social-whatsapp text, sharing, private, facebook"> <h1 class="icon ion-social-whatsapp" title="ion-social-whatsapp"></h1></li>
		<li class="text-center box" rel="ion-social-whatsapp-outline" tags="ion-social-whatsapp-outline text, sharing, private, facebook"> <h1 class="icon ion-social-whatsapp-outline" title="ion-social-whatsapp-outline"></h1></li>
		<li class="text-center box" rel="ion-social-snapchat" tags="ion-social-snapchat photos, app"> <h1 class="icon ion-social-snapchat" title="ion-social-snapchat"></h1></li>
		<li class="text-center box" rel="ion-social-snapchat-outline" tags="ion-social-snapchat-outline photos, app"> <h1 class="icon ion-social-snapchat-outline" title="ion-social-snapchat-outline"></h1></li>
		<li class="text-center box" rel="ion-social-foursquare" tags="ion-social-foursquare checkin"> <h1 class="icon ion-social-foursquare" title="ion-social-foursquare"></h1></li>
		<li class="text-center box" rel="ion-social-foursquare-outline" tags="ion-social-foursquare-outline checkin"> <h1 class="icon ion-social-foursquare-outline" title="ion-social-foursquare-outline"></h1></li>
		<li class="text-center box" rel="ion-social-pinterest" tags="ion-social-pinterest social"> <h1 class="icon ion-social-pinterest" title="ion-social-pinterest"></h1></li>
		<li class="text-center box" rel="ion-social-pinterest-outline" tags="ion-social-pinterest-outline social"> <h1 class="icon ion-social-pinterest-outline" title="ion-social-pinterest-outline"></h1></li>
		<li class="text-center box" rel="ion-social-rss" tags="ion-social-rss blogging"> <h1 class="icon ion-social-rss" title="ion-social-rss"></h1></li>
		<li class="text-center box" rel="ion-social-rss-outline" tags="ion-social-rss-outline blogging"> <h1 class="icon ion-social-rss-outline" title="ion-social-rss-outline"></h1></li>
		<li class="text-center box" rel="ion-social-tumblr" tags="ion-social-tumblr blogging"> <h1 class="icon ion-social-tumblr" title="ion-social-tumblr"></h1></li>
		<li class="text-center box" rel="ion-social-tumblr-outline" tags="ion-social-tumblr-outline blogging"> <h1 class="icon ion-social-tumblr-outline" title="ion-social-tumblr-outline"></h1></li>
		<li class="text-center box" rel="ion-social-wordpress" tags="ion-social-wordpress blogging"> <h1 class="icon ion-social-wordpress" title="ion-social-wordpress"></h1></li>
		<li class="text-center box" rel="ion-social-wordpress-outline" tags="ion-social-wordpress-outline blogging"> <h1 class="icon ion-social-wordpress-outline" title="ion-social-wordpress-outline"></h1></li>
		<li class="text-center box" rel="ion-social-reddit" tags="ion-social-reddit news, upvotes, karma"> <h1 class="icon ion-social-reddit" title="ion-social-reddit"></h1></li>
		<li class="text-center box" rel="ion-social-reddit-outline" tags="ion-social-reddit-outline news, upvotes, karma"> <h1 class="icon ion-social-reddit-outline" title="ion-social-reddit-outline"></h1></li>
		<li class="text-center box" rel="ion-social-hackernews" tags="ion-social-hackernews discuss, upvotes, karma"> <h1 class="icon ion-social-hackernews" title="ion-social-hackernews"></h1></li>
		<li class="text-center box" rel="ion-social-hackernews-outline" tags="ion-social-hackernews-outline discuss, upvotes, karma"> <h1 class="icon ion-social-hackernews-outline" title="ion-social-hackernews-outline"></h1></li>
		<li class="text-center box" rel="ion-social-designernews" tags="ion-social-designernews design, post"> <h1 class="icon ion-social-designernews" title="ion-social-designernews"></h1></li>
		<li class="text-center box" rel="ion-social-designernews-outline" tags="ion-social-designernews-outline design, post"> <h1 class="icon ion-social-designernews-outline" title="ion-social-designernews-outline"></h1></li>
		<li class="text-center box" rel="ion-social-yahoo" tags="ion-social-yahoo share"> <h1 class="icon ion-social-yahoo" title="ion-social-yahoo"></h1></li>
		<li class="text-center box" rel="ion-social-buffer-outline" tags="ion-social-buffer-outline share"> <h1 class="icon ion-social-buffer-outline" title="ion-social-buffer-outline"></h1></li>
		<li class="text-center box" rel="ion-social-skype" tags="ion-social-skype call"> <h1 class="icon ion-social-skype" title="ion-social-skype"></h1></li>
		<li class="text-center box" rel="ion-social-skype-outline" tags="ion-social-skype-outline call"> <h1 class="icon ion-social-skype-outline" title="ion-social-skype-outline"></h1></li>
		<li class="text-center box" rel="ion-social-linkedin" tags="ion-social-linkedin connect"> <h1 class="icon ion-social-linkedin" title="ion-social-linkedin"></h1></li>
		<li class="text-center box" rel="ion-social-linkedin-outline" tags="ion-social-linkedin-outline connect"> <h1 class="icon ion-social-linkedin-outline" title="ion-social-linkedin-outline"></h1></li>
		<li class="text-center box" rel="ion-social-vimeo" tags="ion-social-vimeo video, watch, share, view"> <h1 class="icon ion-social-vimeo" title="ion-social-vimeo"></h1></li>
		<li class="text-center box" rel="ion-social-vimeo-outline" tags="ion-social-vimeo-outline video, watch, share, view"> <h1 class="icon ion-social-vimeo-outline" title="ion-social-vimeo-outline"></h1></li>
		<li class="text-center box" rel="ion-social-twitch" tags="ion-social-twitch gaming, games, live, streaming, video, watch, share, view"> <h1 class="icon ion-social-twitch" title="ion-social-twitch"></h1></li>
		<li class="text-center box" rel="ion-social-twitch-outline" tags="ion-social-twitch-outline gaming, games, live, streaming, video, watch, share, view"> <h1 class="icon ion-social-twitch-outline" title="ion-social-twitch-outline"></h1></li>
		<li class="text-center box" rel="ion-social-youtube" tags="ion-social-youtube video, watch, share, view"> <h1 class="icon ion-social-youtube" title="ion-social-youtube"></h1></li>
		<li class="text-center box" rel="ion-social-youtube-outline" tags="ion-social-youtube-outline video, watch, share, view"> <h1 class="icon ion-social-youtube-outline" title="ion-social-youtube-outline"></h1></li>
		<li class="text-center box" rel="ion-social-dropbox" tags="ion-social-dropbox upload"> <h1 class="icon ion-social-dropbox" title="ion-social-dropbox"></h1></li>
		<li class="text-center box" rel="ion-social-dropbox-outline" tags="ion-social-dropbox-outline upload"> <h1 class="icon ion-social-dropbox-outline" title="ion-social-dropbox-outline"></h1></li>
		<li class="text-center box" rel="ion-social-apple" tags="ion-social-apple mac, mobile"> <h1 class="icon ion-social-apple" title="ion-social-apple"></h1></li>
		<li class="text-center box" rel="ion-social-apple-outline" tags="ion-social-apple-outline mac, mobile"> <h1 class="icon ion-social-apple-outline" title="ion-social-apple-outline"></h1></li>
		<li class="text-center box" rel="ion-social-android" tags="ion-social-android mobile"> <h1 class="icon ion-social-android" title="ion-social-android"></h1></li>
		<li class="text-center box" rel="ion-social-android-outline" tags="ion-social-android-outline mobile"> <h1 class="icon ion-social-android-outline" title="ion-social-android-outline"></h1></li>
		<li class="text-center box" rel="ion-social-windows" tags="ion-social-windows pc"> <h1 class="icon ion-social-windows" title="ion-social-windows"></h1></li>
		<li class="text-center box" rel="ion-social-windows-outline" tags="ion-social-windows-outline pc"> <h1 class="icon ion-social-windows-outline" title="ion-social-windows-outline"></h1></li>
		<li class="text-center box" rel="ion-social-html5" tags="ion-social-html5 code, html, css, js, developer"> <h1 class="icon ion-social-html5" title="ion-social-html5"></h1></li>
		<li class="text-center box" rel="ion-social-html5-outline" tags="ion-social-html5-outline code, html, css, js, developer"> <h1 class="icon ion-social-html5-outline" title="ion-social-html5-outline"></h1></li>
		<li class="text-center box" rel="ion-social-css3" tags="ion-social-css3 code, html, css, js, developer"> <h1 class="icon ion-social-css3" title="ion-social-css3"></h1></li>
		<li class="text-center box" rel="ion-social-css3-outline" tags="ion-social-css3-outline code, html, css, js, developer"> <h1 class="icon ion-social-css3-outline" title="ion-social-css3-outline"></h1></li>
		<li class="text-center box" rel="ion-social-javascript" tags="ion-social-javascript code, html, css, js, developer"> <h1 class="icon ion-social-javascript" title="ion-social-javascript"></h1></li>
		<li class="text-center box" rel="ion-social-javascript-outline" tags="ion-social-javascript-outline code, html, css, js, developer"> <h1 class="icon ion-social-javascript-outline" title="ion-social-javascript-outline"></h1></li>
		<li class="text-center box" rel="ion-social-angular" tags="ion-social-angular code, mobile, js, angularjs, ionic"> <h1 class="icon ion-social-angular" title="ion-social-angular"></h1></li>
		<li class="text-center box" rel="ion-social-angular-outline" tags="ion-social-angular-outline code, mobile, js, angularjs, ionic"> <h1 class="icon ion-social-angular-outline" title="ion-social-angular-outline"></h1></li>
		<li class="text-center box" rel="ion-social-nodejs" tags="ion-social-nodejs code, js, javascript, developer"> <h1 class="icon ion-social-nodejs" title="ion-social-nodejs"></h1></li>
		<li class="text-center box" rel="ion-social-sass" tags="ion-social-sass code, css"> <h1 class="icon ion-social-sass" title="ion-social-sass"></h1></li>
		<li class="text-center box" rel="ion-social-python" tags="ion-social-python code"> <h1 class="icon ion-social-python" title="ion-social-python"></h1></li>
		<li class="text-center box" rel="ion-social-chrome" tags="ion-social-chrome code, mobile, js, angularjs, ionic"> <h1 class="icon ion-social-chrome" title="ion-social-chrome"></h1></li>
		<li class="text-center box" rel="ion-social-chrome-outline" tags="ion-social-chrome-outline code, mobile, js, angularjs, ionic"> <h1 class="icon ion-social-chrome-outline" title="ion-social-chrome-outline"></h1></li>
		<li class="text-center box" rel="ion-social-codepen" tags="ion-social-codepen testing, js, developer"> <h1 class="icon ion-social-codepen" title="ion-social-codepen"></h1></li>
		<li class="text-center box" rel="ion-social-codepen-outline" tags="ion-social-codepen-outline testing, js, developer"> <h1 class="icon ion-social-codepen-outline" title="ion-social-codepen-outline"></h1></li>
		<li class="text-center box" rel="ion-social-markdown" tags="ion-social-markdown code, testing, text, developer"> <h1 class="icon ion-social-markdown" title="ion-social-markdown"></h1></li>
		<li class="text-center box" rel="ion-social-tux" tags="ion-social-tux code, linux, opensource"> <h1 class="icon ion-social-tux" title="ion-social-tux"></h1></li>
		<li class="text-center box" rel="ion-social-freebsd-devil" tags="ion-social-freebsd-devil code, opensource, unix"> <h1 class="icon ion-social-freebsd-devil" title="ion-social-freebsd-devil"></h1></li>
		<li class="text-center box" rel="ion-social-usd" tags="ion-social-usd currency, trade, money, cash"> <h1 class="icon ion-social-usd" title="ion-social-usd"></h1></li>
		<li class="text-center box" rel="ion-social-usd-outline" tags="ion-social-usd-outline currency, trade, money, cash"> <h1 class="icon ion-social-usd-outline" title="ion-social-usd-outline"></h1></li>
		<li class="text-center box" rel="ion-social-bitcoin" tags="ion-social-bitcoin currency, trade, money"> <h1 class="icon ion-social-bitcoin" title="ion-social-bitcoin"></h1></li>
		<li class="text-center box" rel="ion-social-bitcoin-outline" tags="ion-social-bitcoin-outline currency, trade, money"> <h1 class="icon ion-social-bitcoin-outline" title="ion-social-bitcoin-outline"></h1></li>
		<li class="text-center box" rel="ion-social-yen" tags="ion-social-yen currency, trade, money, japanese"> <h1 class="icon ion-social-yen" title="ion-social-yen"></h1></li>
		<li class="text-center box" rel="ion-social-yen-outline" tags="ion-social-yen-outline currency, trade, money, japanese"> <h1 class="icon ion-social-yen-outline" title="ion-social-yen-outline"></h1></li>
		<li class="text-center box" rel="ion-social-euro" tags="ion-social-euro currency, trade, money, europe"> <h1 class="icon ion-social-euro" title="ion-social-euro"></h1></li>
		<li class="text-center box" rel="ion-social-euro-outline" tags="ion-social-euro-outline currency, trade, money, europe"> <h1 class="icon ion-social-euro-outline" title="ion-social-euro-outline"></h1></li>
	</ul>
</div>
