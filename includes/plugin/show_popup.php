<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 12/29/2009 20:7
 */
if (!defined('NV_MAINFILE')) {
    die('Stop!!!');
}

if (!defined('NV_ADMIN')) {
    $config = $module_config['popup'];
    $funcid = explode(',', $config['funcid']);
    if (in_array($module_info['funcs'][$op]['func_id'], $funcid)) {

        if ($config['active']) {

            if (file_exists(NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/popup/main.tpl")) {
                $block_theme = $global_config['module_theme'];
            } elseif (file_exists(NV_ROOTDIR . "/themes/" . $global_config['site_theme'] . "/modules/popup/main.tpl")) {
                $block_theme = $global_config['site_theme'];
            } else {
                $block_theme = "default";
            }

            $popup_content_file = NV_ROOTDIR . '/' . NV_FILES_DIR . '/popup_content.txt';
            if (file_exists($popup_content_file)) {
                $config['popup_content'] = file_get_contents($popup_content_file);
            } else {
                return '';
            }

            $config['timer_open'] = $config['timer_open'] * 1000;
            if (!empty($config['timer_close'])) {
                $config['timer_close'] = $config['timer_close'] * 1000;
            }

            $xtpl = new XTemplate("main.tpl", NV_ROOTDIR . "/themes/" . $block_theme . "/modules/popup");
            $xtpl->assign('TEMPLATE', $block_theme);
            $xtpl->assign('ROW', $config);

            if (!empty($config['timer_close'])) {
                $xtpl->parse('main.timer_close');
            }

            if ($config['develop_mode']) {
                $xtpl->parse('main');
            }

            $xtpl->parse('main');
            $contents .= $xtpl->text('main');
        }
    }
}
