<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.net)
 * @Copyright (C) 2012 VINADES.,JSC. All rights reserved
 * @Createdate 2-10-2010 20:59
 */
if (! defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');

$page_title = $lang_module['main'];

$xtpl = new XTemplate("main.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('ACTION', NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name);

if ($nv_Request->isset_request('save', 'post')) {
    $popup['active'] = $nv_Request->get_bool('active', 'post', 0);
    $popup['timer_open'] = $nv_Request->get_int('timer_open', 'post', '');
    $popup['timer_close'] = $nv_Request->get_int('timer_close', 'post', '');
    $popup['popup_content'] = $nv_Request->get_string('popup_content', 'post', '');
    $popup['popup_content'] = nv_editor_nl2br($popup['popup_content']);
    
    $sth = $db->prepare("UPDATE " . NV_PREFIXLANG . "_" . $module_data . " SET config_value = :config_value WHERE config_name = :config_name");
    
    foreach ($popup as $config_name => $config_value) {
        $sth->bindParam(':config_name', $config_name, PDO::PARAM_STR);
        $sth->bindParam(':config_value', $config_value, PDO::PARAM_STR);
        $sth->execute();
    }
    
    nv_del_moduleCache($module_name);
    
    Header("Location: " . NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name);
    die();
}

// Get value
$sql = "SELECT config_name, config_value FROM " . NV_PREFIXLANG . "_" . $module_data . "";
$list = nv_db_cache($sql);

$row = array();
foreach ($list as $values) {
    $row[$values['config_name']] = $values['config_value'];
}

$popup_content = nv_editor_br2nl($row['popup_content']);

if (! empty($popup_content))
    $bodytext = nv_htmlspecialchars($popup_content);

if (defined('NV_EDITOR'))
    require_once (NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php');

if (defined('NV_EDITOR') and nv_function_exists('nv_aleditor')) {
    $popup_content = nv_aleditor("popup_content", '100%', '300px', $popup_content);
} else {
    $popup_content = "<textarea style=\"width:100%;height:300px\" name=\"popup_content\">" . $popup_content . "</textarea>";
}

$xtpl->assign('ACTIVE', $row['active'] ? 'checked="checked"' : '');
$xtpl->assign('DATA', $row);
$xtpl->assign('POPUP_CONTENT', $popup_content);

$xtpl->parse('main');
$contents = $xtpl->text('main');

include (NV_ROOTDIR . "/includes/header.php");
echo nv_admin_theme($contents);
include (NV_ROOTDIR . "/includes/footer.php");

?>