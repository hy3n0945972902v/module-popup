<!-- BEGIN: main -->

<div class="panel panel-default">
	<div class="panel-body">
		<form class="form-horizontal" action="{ACTION}" method="post" id="form">
			<div class="form-group">
				<label class="col-sm-5 col-md-3 text-right"><strong>{LANG.active}</strong></label>
				<div class="col-sm-19 col-md-21">
					<label><input type="checkbox" name="active" value="1" {DATA.ck_active} />{LANG.active_note}</label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-3 control-label"><strong>{LANG.size}</strong></label>
				<div class="col-sm-19 col-md-21">
					<div class="row">
						<div class="col-xs-24 col-sm-12">
							<div class="input-group">
								<div class="input-group-addon">{LANG.size_w}</div>
								<input class="form-control" type="text" name="size_w" value="{DATA.size_w}" />
								<div class="input-group-addon">px</div>
							</div>						
						</div>
						<div class="col-xs-24 col-sm-12">
							<div class="input-group">
								<div class="input-group-addon">{LANG.size_h}</div>
								<input class="form-control" type="text" name="size_h" value="{DATA.size_h}" />
								<div class="input-group-addon">px</div>
							</div>						
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-3 control-label"><strong>{LANG.timer_open}</strong></label>
				<div class="col-sm-19 col-md-21">
					<div class="input-group">
						<input class="form-control" type="text" name="timer_open" value="{DATA.timer_open}" />
						<div class="input-group-addon">{LANG.second}</div>
					</div>
					<em class="help-block">{LANG.timer_open_note}</em>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-3 control-label"><strong>{LANG.timer_close}</strong></label>
				<div class="col-sm-19 col-md-21">
					<div class="input-group">
						<input class="form-control" type="text" name="timer_close" value="{DATA.timer_close}" />
						<div class="input-group-addon">{LANG.second}</div>
					</div>
					<em class="help-block">{LANG.timer_close_note}</em>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-3 text-right"><strong>{LANG.popup_content}</strong></label>
				<div class="col-sm-19 col-md-21">{DATA.popup_content}</div>
			</div>
			<div class="text-center">
				<input class="btn btn-primary" type="submit" value="{LANG.save}" name="save" />
			</div>
		</form>
	</div>
</div>
<!-- END: main -->
