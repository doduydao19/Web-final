<?php

use app\core\Application;

/**
 * User: TheCodeholic
 * Date: 7/10/2020
 * Time: 8:07 AM
 */

class m0006_create_table_devices {

    public function up()
    {
        $db = Application::$app->db;
        $SQL = "CREATE TABLE devices (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                avatar VARCHAR(255) DEFAULT NULL,
                description TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = Application::$app->db;
        $SQL = "DROP TABLE devices;";
        $db->pdo->exec($SQL);
    }
}