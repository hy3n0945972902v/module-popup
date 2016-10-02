<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.net)
 * @Copyright (C) 2012 VINADES.,JSC. All rights reserved
 * @Createdate 2-10-2010 20:59
 */
if (! defined('NV_IS_FILE_MODULES'))
    die('Stop!!!');

$sql_create_module = array();

$config = array(
    'active' => 1,
    'timer_open' => 1,
    'timer_close' => 0,
    'size_w' => 600,
    'size_h' => 400,
    'develop_mode' => 0
);
foreach($config as $config_name => $config_value){
    $sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', " . $db->quote($module_name) . ", " . $db->quote($config_name) . ", " . $db->quote($config_value) . ")";
}