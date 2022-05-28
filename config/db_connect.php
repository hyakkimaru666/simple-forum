<?php
    $user = 'root';
    $password = '';
    $host = 'localhost';
    $database_name = 'simple_forum';

    $site_title = 'Simple forum';

    $db_connection = new mysqli ($host, $user, $password, $database_name);
    if ($db_connection -> connect_error) {
        die('Connection failed:' . $db_connection -> connect_error);
    }
?>