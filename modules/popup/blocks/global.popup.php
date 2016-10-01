<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.net)
 * @Copyright (C) 2012 VINADES.,JSC. All rights reserved
 * @Createdate 2-10-2010 20:59
 */
if (! defined('NV_SYSTEM'))
    die('Stop!!!');

if (! nv_function_exists('nv_popup')) {

    /**
     * nv_popup()
     *
     * @return
     *
     */
    function nv_popup($block_config)
    {
        global $global_config, $site_mods, $my_head;
        $module = $block_config['module'];
        
        // Get value
        $sql = "SELECT config_name, config_value FROM " . NV_PREFIXLANG . "_" . $module;
        $list = nv_db_cache($sql, '', $module);
        
        foreach ($list as $values) {
            $row[$values['config_name']] = $values['config_value'];
        }
        
        if ($row['active']) {
            if (file_exists(NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module . "/block.popup.tpl")) {
                $block_theme = $global_config['module_theme'];
            } elseif (file_exists(NV_ROOTDIR . "/themes/" . $global_config['site_theme'] . "/modules/" . $module . "/block.popup.tpl")) {
                $block_theme = $global_config['site_theme'];
            } else {
                $block_theme = "default";
            }
            
            $my_head .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . NV_BASE_SITEURL . "themes/" . $block_theme . "/css/popup.css\" />";
            
            $xtpl = new XTemplate("block.popup.tpl", NV_ROOTDIR . "/themes/" . $block_theme . "/modules/" . $module);
            
            if ($row['timer_close']) {
                $row['timer_close'] = $row['timer_close'] * 1000;
                $xtpl->parse('main.timer_close');
            }
            
            $row['timer_open'] = $row['timer_open'] * 1000;
            
            $xtpl->assign('ROW', $row);
            
            $xtpl->parse('main');
            return $xtpl->text('main');
        }
    }
}

$content = nv_popup($block_config);

?>