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
$popup_content_file = NV_ROOTDIR . '/' . NV_ASSETS_DIR . '/popup_content.txt';

if ($nv_Request->isset_request('save', 'post')) {
    $popup['active'] = $nv_Request->get_bool('active', 'post', 0);
    $popup['timer_open'] = $nv_Request->get_int('timer_open', 'post', '');
    $popup['timer_close'] = $nv_Request->get_int('timer_close', 'post', '');
    $popup['size_w'] = $nv_Request->get_int('size_w', 'post', 600);
    $popup['size_h'] = $nv_Request->get_int('size_h', 'post', 400);
    $popup['popup_content'] = $_POST['popup_content'];
    
    $sth = $db->prepare("UPDATE " . NV_CONFIG_GLOBALTABLE . " SET config_value = :config_value WHERE lang = '" . NV_LANG_DATA . "' AND module = :module_name AND config_name = :config_name");
    $sth->bindParam(':module_name', $module_name, PDO::PARAM_STR);
    foreach ($popup as $config_name => $config_value) {
        $sth->bindParam(':config_name', $config_name, PDO::PARAM_STR);
        $sth->bindParam(':config_value', $config_value, PDO::PARAM_STR);
        $sth->execute();
    }
    
    if(!empty($popup['popup_content'])){
        file_put_contents($popup_content_file, $popup['popup_content']);
    }
    
    $nv_Cache->delMod('settings');
    
    Header("Location: " . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
    die();
}

$row = $module_config[$module_name];

if(file_exists($popup_content_file)){
    $row['popup_content'] = file_get_contents($popup_content_file);
}else{
    $row['popup_content'] = '';
}

$row['popup_content'] = nv_editor_br2nl($row['popup_content']);

if (! empty($row['popup_content'])) {
    $row['popup_content'] = nv_htmlspecialchars($row['popup_content']);
}

if (defined('NV_EDITOR')) {
    require_once (NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php');
}

if (defined('NV_EDITOR') and nv_function_exists('nv_aleditor')) {
    $row['popup_content'] = nv_aleditor("popup_content", '100%', '300px', $row['popup_content']);
} else {
    $row['popup_content'] = "<textarea style=\"width:100%;height:300px\" name=\"popup_content\">" . $row['popup_content'] . "</textarea>";
}

$row['ck_active'] = $row['active'] ? 'checked="checked"' : '';

$xtpl = new XTemplate("main.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('ACTION', NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name);
$xtpl->assign('DATA', $row);

$xtpl->parse('main');
$contents = $xtpl->text('main');

include (NV_ROOTDIR . "/includes/header.php");
echo nv_admin_theme($contents);
include (NV_ROOTDIR . "/includes/footer.php");