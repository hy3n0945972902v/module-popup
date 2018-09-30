<!-- BEGIN: main  -->
<link rel="StyleSheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/popup.css">
<div id='fanback'>
    <div id='fan-exit'></div>
    <div id='MorganAndMen'>
        <div id='TheBlogWidgets'></div>
        <div class='remove-borda'></div>
        <div class="popup_content" style="width: {ROW.size_w">{ROW.popup_content}</div>
    </div>
</div>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/popup.js"></script>
<script type='text/javascript'>
$(document).ready(function($){
	var timer_close = '{ROW.timer_close}';
	var develop_mode = {ROW.develop_mode};
	if($.cookie('popup_site') != 'yes' || develop_mode){
		$('#fanback').delay('{ROW.timer_open}').fadeIn('medium');
		$('#TheBlogWidgets, #fan-exit').click(function(){
			$('#fanback').stop().fadeOut('medium');
		});
		<!-- BEGIN: timer_close -->
		$('#fanback').delay(timer_close).fadeOut('medium');
		<!-- END: timer_close -->
		$.cookie('popup_site', 'yes', { path: '/', expires: 7 });
	}
});
</script>
<!-- END: main -->