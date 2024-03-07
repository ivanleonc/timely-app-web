<?php

require_once("global.php");

$connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

mysqli_query($connection, 'SET NAMES "' . DB_ENCODE . '"');

if (mysqli_connect_errno()) {
    printf('Parece que hay un error en la conexion de la base de datos: %s\n', mysqli_connect_error());
    exit();
}

if (!function_exists('executeConsult')) {
    function executeConsult($sql)
    {
        global $connection;
        $query = $connection->query($sql);
        return $query;
    }
    function executeConsultSingleRow($sql)
    {
        global $connection;

        $query = $connection->query($sql);
        $row = $query->fetch_assoc();
        return $row;
    }

    function executeConsultReturnID($sql)
    {
        global $connection;

        $query = $connection->query($sql);
        return $connection->insert_id;
    }

    function cleanString($str)
    {
        global $connection;
        $str = mysqli_real_escape_string($connection, trim($str));
        return htmlspecialchars($str);
    }
}
