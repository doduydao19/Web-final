<?php

use app\core\Application;

/**
 * User: TheCodeholic
 * Date: 7/10/2020
 * Time: 8:07 AM
 */

class m0008_add_status_table_device {
    public function up()
    {
        $db = Application::$app->db;
        $db->pdo->exec("ALTER TABLE devices ADD COLUMN status tinyint DEFAULT 1");
    }

    public function down()
    {
 
    }
}