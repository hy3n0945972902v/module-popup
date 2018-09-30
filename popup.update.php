<?php

/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.net)
 * @Copyright (C) 2016 mynukeviet. All rights reserved
 * @Createdate Fri, 30 Dec 2016 01:40:16 GMT
 */
define('NV_SYSTEM', true);

define('NV_ROOTDIR', pathinfo(str_replace(DIRECTORY_SEPARATOR, '/', __file__), PATHINFO_DIRNAME));

require NV_ROOTDIR . '/includes/mainfile.php';
require NV_ROOTDIR . '/includes/core/user_functions.php';

$array_database = array(
    $db_config['dbname']
);
if (defined('NV_CONFIG_DIR')) {
    $result = $db->query('SELECT dataname FROM ' . $db_config['prefix'] . '_site');
    while (list ($dataname) = $result->fetch(3)) {
        $array_database[] = $dataname;
    }
}

foreach ($array_database as $dataname) {
    $language_query = $db->query('SELECT lang FROM ' . $dataname . '.' . $db_config['prefix'] . '_setup_language WHERE setup = 1');
    while (list ($lang) = $language_query->fetch(3)) {
        $mquery = $db->query("SELECT title, module_data FROM " . $dataname . "." . $db_config['prefix'] . "_" . $lang . "_modules WHERE module_file = 'popup'");
        while (list ($mod, $mod_data) = $mquery->fetch(3)) {
            $_sql = array();

            $array_data = array(
                'all_func' => 1,
                'funcid' => ''
            );

            foreach ($array_data as $config_name => $config_value) {
                $_sql[] = "INSERT INTO " . $dataname . "." . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', " . $db->quote($mod) . ", " . $db->quote($config_name) . ", " . $db->quote($config_value) . ")";
            }

            if (!empty($_sql)) {
                foreach ($_sql as $sql) {
                    try {
                        $db->query($sql);
                    } catch (PDOException $e) {
                        //
                    }
                }
                $nv_Cache->delMod($mod);
                $nv_Cache->delMod('settings');
            }
        }
    }
}

die('OK');