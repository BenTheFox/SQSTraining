<?php
/**
 * Created by PhpStorm.
 * User: connor
 * Date: 10/9/18
 * Time: 1:35 AM
 */

define('DB_SERVER', '10.163.140.98');

//define('DB_SERVER', 'localhost');

//define('DB_USER', 'dev');

define('DB_USER', 'remote');

define('DB_PASSWORD', 'password123');

define('DB_NAME', 'SQSTrainingDB');

define('DB_PORT', '3306');

//define('DB_DSN', 'mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER);
define('DB_DSN', 'mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';port=' . DB_PORT);

define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'].'/');