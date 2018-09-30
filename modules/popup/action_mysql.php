<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.net)
 * @Copyright (C) 2012 VINADES.,JSC. All rights reserved
 * @Createdate 2-10-2010 20:59
 */
if (!defined('NV_IS_FILE_MODULES')) die('Stop!!!');

$sql_create_module = array();

$config = array(
    'active' => 1,
    'timer_open' => 1,
    'timer_close' => 0,
    'size_w' => 600,
    'size_h' => 400,
    'develop_mode' => 0,
    'all_func' => 1,
    'funcid' => ''
);
foreach ($config as $config_name => $config_value) {
    $sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', " . $db->quote($module_name) . ", " . $db->quote($config_name) . ", " . $db->quote($config_value) . ")";
}

// thêm plugin
$plugin_file = 'show_popup.php';
$plugin_area = 4;

$_sql = 'SELECT max(weight) FROM ' . $db_config['prefix'] . '_plugin WHERE plugin_area=' . $plugin_area;
$weight = $db->query($_sql)->fetchColumn();
$weight = intval($weight) + 1;

try {
    $sth = $db->prepare('INSERT INTO ' . $db_config['prefix'] . '_plugin (plugin_file, plugin_area, weight) VALUES (:plugin_file, :plugin_area, :weight)');
    $sth->bindParam(':plugin_file', $plugin_file, PDO::PARAM_STR);
    $sth->bindParam(':plugin_area', $plugin_area, PDO::PARAM_INT);
    $sth->bindParam(':weight', $weight, PDO::PARAM_INT);
    $sth->execute();
    nv_save_file_config_global();
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}