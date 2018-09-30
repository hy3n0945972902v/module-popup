<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.net)
 * @Copyright (C) 2012 VINADES.,JSC. All rights reserved
 * @Createdate 2-10-2010 20:59
 */
if (!defined('NV_IS_FILE_ADMIN')) die('Stop!!!');

$page_title = $lang_module['main'];
$popup_content_file = NV_ROOTDIR . '/' . NV_FILES_DIR . '/popup_content.txt';
$error = array();

if ($nv_Request->isset_request('save', 'post')) {
    $popup['active'] = $nv_Request->get_bool('active', 'post', 0);
    $popup['timer_open'] = $nv_Request->get_int('timer_open', 'post', '');
    $popup['timer_close'] = $nv_Request->get_int('timer_close', 'post', '');
    $popup['size_w'] = $nv_Request->get_int('size_w', 'post', 600);
    $popup['size_h'] = $nv_Request->get_int('size_h', 'post', 400);
    $popup['develop_mode'] = $nv_Request->get_int('develop_mode', 'post', 0);
    $popup['popup_content'] = $_POST['popup_content'];

    $popup['all_func'] = $nv_Request->get_int('all_func', 'post', 1);
    $popup['funcid'] = $nv_Request->get_array('func_id', 'post');

    if (empty($popup['all_func']) and empty($popup['funcid'])) {
        $error[] = $lang_module['block_no_func'];
    } else {
        $array_funcid_module = array();
        foreach ($site_mods as $mod => $_arr_mod) {
            foreach ($_arr_mod['funcs'] as $_func => $_row) {
                if ($_row['show_func']) {
                    $array_funcid_module[$_row['func_id']] = $mod;
                }
            }
        }

        if ($popup['all_func']) {
            $popup['funcid'] = array_keys($array_funcid_module);
        } else {
            $popup['funcid'] = array_intersect($popup['funcid'], array_keys($array_funcid_module));
        }
        $popup['funcid'] = implode(',', $popup['funcid']);

        $sth = $db->prepare("UPDATE " . NV_CONFIG_GLOBALTABLE . " SET config_value = :config_value WHERE lang = '" . NV_LANG_DATA . "' AND module = :module_name AND config_name = :config_name");
        $sth->bindParam(':module_name', $module_name, PDO::PARAM_STR);
        foreach ($popup as $config_name => $config_value) {
            $sth->bindParam(':config_name', $config_name, PDO::PARAM_STR);
            $sth->bindParam(':config_value', $config_value, PDO::PARAM_STR);
            $sth->execute();
        }

        if (!empty($popup['popup_content'])) {
            file_put_contents($popup_content_file, $popup['popup_content']);
        }

        $nv_Cache->delMod('settings');

        Header("Location: " . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
        die();
    }
}

if (file_exists($popup_content_file)) {
    $array_config['popup_content'] = file_get_contents($popup_content_file);
} else {
    $array_config['popup_content'] = '';
}

$array_config['popup_content'] = nv_editor_br2nl($array_config['popup_content']);

if (!empty($array_config['popup_content'])) {
    $array_config['popup_content'] = nv_htmlspecialchars($array_config['popup_content']);
}

if (defined('NV_EDITOR')) {
    require_once (NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php');
}

if (defined('NV_EDITOR') and nv_function_exists('nv_aleditor')) {
    $array_config['popup_content'] = nv_aleditor("popup_content", '100%', '300px', $array_config['popup_content']);
} else {
    $array_config['popup_content'] = "<textarea style=\"width:100%;height:300px\" name=\"popup_content\">" . $array_config['popup_content'] . "</textarea>";
}

$array_config['funcid'] = !empty($array_config['funcid']) ? explode(',', $array_config['funcid']) : array();

$sql = 'SELECT func_id, func_custom_name, in_module FROM ' . NV_MODFUNCS_TABLE . ' WHERE show_func=1 ORDER BY in_module ASC, subweight ASC';
$func_result = $db->query($sql);
$aray_mod_func = array();
while (list ($id_i, $func_custom_name_i, $in_module_i) = $func_result->fetch(3)) {
    $aray_mod_func[$in_module_i][] = array(
        'id' => $id_i,
        'func_custom_name' => $func_custom_name_i
    );
}

$array_config['ck_active'] = $array_config['active'] ? 'checked="checked"' : '';
$array_config['ck_develop_mode'] = $array_config['develop_mode'] ? 'checked="checked"' : '';

$xtpl = new XTemplate("main.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('ACTION', NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name);
$xtpl->assign('DATA', $array_config);
$xtpl->assign('SHOWS_ALL_FUNC', (intval($array_config['all_func'])) ? ' style="display:none" ' : '');

$add_block_module = array(
    1 => $lang_module['add_block_all_module'],
    0 => $lang_module['add_block_select_module']
);

$i = 1;
foreach ($add_block_module as $b_key => $b_value) {
    $xtpl->assign('I', $i);
    $xtpl->assign('B_KEY', $b_key);
    $xtpl->assign('B_VALUE', $b_value);
    $xtpl->assign('CK', ($array_config['all_func'] == $b_key) ? ' checked="checked"' : '');
    $xtpl->parse('main.add_block_module');
    $i++;
}

$sql = 'SELECT title, custom_title FROM ' . NV_MODULES_TABLE . ' ORDER BY weight ASC';
$result = $db->query($sql);
while (list ($m_title, $m_custom_title) = $result->fetch(3)) {
    if (isset($aray_mod_func[$m_title]) and sizeof($aray_mod_func[$m_title]) > 0) {
        $i = 0;
        foreach ($aray_mod_func[$m_title] as $aray_mod_func_i) {

            $sel = '';
            if (in_array($aray_mod_func_i['id'], $array_config['funcid'])) {
                ++$i;
                $sel = ' checked="checked"';
            }

            $xtpl->assign('SELECTED', $sel);
            $xtpl->assign('FUNCID', $aray_mod_func_i['id']);
            $xtpl->assign('FUNCNAME', $aray_mod_func_i['func_custom_name']);

            $xtpl->parse('main.loopfuncs.fuc');
        }

        $xtpl->assign('M_TITLE', $m_title);
        $xtpl->assign('M_CUSTOM_TITLE', $m_custom_title);
        $xtpl->assign('M_CHECKED', (sizeof($aray_mod_func[$m_title]) == $i) ? ' checked="checked"' : '');

        $xtpl->parse('main.loopfuncs');
    }
}

if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

include (NV_ROOTDIR . "/includes/header.php");
echo nv_admin_theme($contents);
include (NV_ROOTDIR . "/includes/footer.php");