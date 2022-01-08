<?php

use app\core\Application;

/**
 * User: TheCodeholic
 * Date: 7/10/2020
 * Time: 8:07 AM
 */

class m0007_create_table_device_transactions {

    public function up()
    {
        $db = Application::$app->db;
        $SQL = "CREATE TABLE device_transactions (
                id INT AUTO_INCREMENT PRIMARY KEY,
                comment TEXT,
                start_transaction_plan DATETIME,
                end_transaction_plan DATETIME,
                returned_date DATETIME,
                device_id INT,
                teacher_id INT,
                classroom_id INT,
                FOREIGN KEY (device_id)  REFERENCES devices(id),
                FOREIGN KEY (teacher_id)  REFERENCES teachers(id),
                FOREIGN KEY (classroom_id)  REFERENCES classrooms(id),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = Application::$app->db;
        $SQL = "DROP TABLE device_transactions;";
        $db->pdo->exec($SQL);
    }
}