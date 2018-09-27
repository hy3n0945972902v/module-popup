<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.net)
 * @Copyright (C) 2012 VINADES.,JSC. All rights reserved
 * @Createdate 2-10-2010 20:59
 */
if (!defined('NV_SYSTEM')) die('Stop!!!');

if (!nv_function_exists('nv_popup')) {

    function nv_popup($block_config)
    {
        global $global_config, $site_mods, $nv_Cache, $module_config;

        $module = $block_config['module'];
        $row = $module_config[$module];

        if ($row['active']) {
            if (file_exists(NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module . "/block.popup.tpl")) {
                $block_theme = $global_config['module_theme'];
            } elseif (file_exists(NV_ROOTDIR . "/themes/" . $global_config['site_theme'] . "/modules/" . $module . "/block.popup.tpl")) {
                $block_theme = $global_config['site_theme'];
            } else {
                $block_theme = "default";
            }

            $popup_content_file = NV_ROOTDIR . '/' . NV_ASSETS_DIR . '/popup_content.txt';
            if (file_exists($popup_content_file)) {
                $row['popup_content'] = file_get_contents($popup_content_file);
            } else {
                return '';
            }

            $row['timer_open'] = $row['timer_open'] * 1000;
            if (!empty($row['timer_close'])) {
                $row['timer_close'] = $row['timer_close'] * 1000;
            }

            $xtpl = new XTemplate("block.popup.tpl", NV_ROOTDIR . "/themes/" . $block_theme . "/modules/" . $module);
            $xtpl->assign('TEMPLATE', $block_theme);
            $xtpl->assign('ROW', $row);

            if (!empty($row['timer_close'])) {
                $xtpl->parse('main.timer_close');
            }

            if ($row['develop_mode']) {
                $xtpl->parse('main');
            }

            $xtpl->parse('main');
            return $xtpl->text('main');
        }
    }
}

$content = nv_popup($block_config);