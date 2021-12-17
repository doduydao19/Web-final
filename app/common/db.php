<?php 
// connect to MySQL
$db = array(
    'server' => 'localhost',
    'username' => 'root',
    'password' => '',
    'dbname' => 'final'
);
$conn =mysqli_connect( $db['server'],$db['username'], $db['password'] , $db['dbname']);
if (!$conn) {
    die('fail connect'). mysqli_connect_error($conn);
}
 ?>