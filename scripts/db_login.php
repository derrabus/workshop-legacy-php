<?php

// database connection setup section

$username = 'user';
$password = 'seekrit';
$hostspec = 'localhost';
$database = 'phpbook';
$phptype = 'mysqli';

$dsn = "$phptype://$username:$password@$hostspec/$database";

// establish the connection

$db = DB::connect($dsn);
if (DB::isError($db)) {
    die ($db->getMessage( ));
}

$db->query('SET NAMES utf8mb4');
