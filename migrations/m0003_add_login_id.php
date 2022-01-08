<?php

use app\core\Application;

/**
 * User: TheCodeholic
 * Date: 7/10/2020
 * Time: 8:07 AM
 */

class m0003_add_login_id {
    public function up()
    {
        $db = Application::$app->db;
        $db->pdo->exec("ALTER TABLE users ADD COLUMN login_id VARCHAR(20) NOT NULL");
        $db->pdo->exec("ALTER TABLE users ADD COLUMN actived_flag tinyint DEFAULT 1");
        $db->pdo->exec("ALTER TABLE users ADD COLUMN updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP");
    }

    public function down()
    {
        $db = Application::$app->db;
 
    }
}