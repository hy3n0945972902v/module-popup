<!-- BEGIN: main -->
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<form class="form-horizontal" action="{ACTION}" method="post" id="form">
    <div class="panel panel-default">
        <div class="panel-body">
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
            <div class="form-group">
                <label class="col-sm-5 col-md-3 control-label"><strong>{LANG.add_block_module}</strong></label>
                <div class="col-sm-19 col-md-21">
                    <div class="radio">
                        <!-- BEGIN: add_block_module -->
                        <label id="labelmoduletype{I}"> <input type="radio" name="all_func" class="moduletype" value="{B_KEY}" {CK}/> {B_VALUE}
                        </label>
                        <!-- END: add_block_module -->
                    </div>
                </div>
            </div>
            <div class="form-group" id="shows_all_func"{SHOWS_ALL_FUNC}>
                <label class="col-sm-5 col-md-3 text-right"></label>
                <div class="col-sm-19 col-md-21">
                    <div class="panel panel-default panel-block-content">
                        <div class="panel-heading">
                            {LANG.block_function}
                            <button type="button" name="checkallmod" class="btn btn-default btn-xs">
                                <i class="fa fa-check fa-fw"></i>{LANG.block_check}
                            </button>
                        </div>
                        <div class="list-group" style="max-height: 400px; overflow: scroll;">
                            <!-- BEGIN: loopfuncs -->
                            <div class="list-group-item funclist" id="idmodule_{M_TITLE}">
                                <dl class="dl-horizontal">
                                    <dt>
                                        <div class="ellipsis text-left">
                                            <label><input {M_CHECKED} type="checkbox" value="{M_TITLE}" class="checkmodule" /> <strong>{M_CUSTOM_TITLE}</strong></label>
                                        </div>
                                    </dt>
                                    <dd>
                                        <div class="row">
                                            <!-- BEGIN: fuc -->
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="ellipsis">
                                                    <label title="{FUNCNAME}"><input type="checkbox" {SELECTED} name="func_id[]" value="{FUNCID}" /> {FUNCNAME}</label>
                                                </div>
                                            </div>
                                            <!-- END: fuc -->
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                            <!-- END: loopfuncs -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-3 text-right"><strong>{LANG.develop_mode}</strong></label>
                <div class="col-sm-19 col-md-21">
                    <label><input type="checkbox" name="develop_mode" value="1" {DATA.ck_develop_mode} />{LANG.develop_mode_note}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <input class="btn btn-primary" type="submit" value="{LANG.save}" name="save" />
    </div>
</form>
<!-- END: main -->
