<!-- BEGIN: main  -->
<script type='text/javascript'>
//<![CDATA[
jQuery.cookie = function (key, value, options) {

// key and at least value given, set cookie...
if (arguments.length > 1 && String(value) !== "[object Object]") {
options = jQuery.extend({}, options);

if (value === null || value === undefined) {
options.expires = -1;
}

if (typeof options.expires === 'number') {
var days = options.expires, t = options.expires = new Date();
t.setDate(t.getDate() + days);
}

value = String(value);

return (document.cookie = [
encodeURIComponent(key), '=',
options.raw ? value : encodeURIComponent(value),
options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
options.path ? '; path=' + options.path : '',
options.domain ? '; domain=' + options.domain : '',
options.secure ? '; secure' : ''
].join(''));
}

// key and possibly options given, get cookie...
options = value || {};
var result, decode = options.raw ? function (s) { return s; } : decodeURIComponent;
return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
};
//]]>
</script>

<script type='text/javascript'>
jQuery(document).ready(function($){
var timer_close = '{ROW.timer_close}';

if($.cookie('popup_site') != 'yes'){
$('#fanback').delay('{ROW.timer_open}').fadeIn('medium');
$('#TheBlogWidgets, #fan-exit').click(function(){
	$('#fanback').stop().fadeOut('medium');
});
<!-- BEGIN: timer_close -->
$('#fanback').delay(timer_close).fadeOut('medium');
<!-- END: timer_close -->
}
$.cookie('popup_site', 'yes', { path: '/', expires: 7 });
});
</script>

<div id='fanback'>
	<div id='fan-exit'>
	</div>
	<div id='MorganAndMen'>
		<div id='TheBlogWidgets'>
		</div>
		
		<div class='remove-borda'>
		</div>
		
		<div style="overflow:scroll; width:600px; height:435px; padding: 0 10px">
		{ROW.popup_content}
		</div>
	</div>
</div>
<!-- END: main -->
